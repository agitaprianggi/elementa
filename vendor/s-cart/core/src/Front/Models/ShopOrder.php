<?php
#S-Cart/Core/Front/Models/ShopOrder.php
namespace SCart\Core\Front\Models;

use DB;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\CoreApi;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use SCart\Core\Front\Models\ShopProduct;
use SCart\Core\Front\Models\ShopOrderTotal;
use SCart\Core\Front\Models\ShopOrderDetail;
use SCart\Core\Front\Models\ShopOrderHistory;


class ShopOrder extends Model
{
    use \SCart\Core\Front\Models\ModelTrait;
    use \SCart\Core\Front\Models\UuidTrait;

    public $table = SC_DB_PREFIX.'shop_order';
    protected $guarded = [];
    protected $connection = SC_CONNECTION;

    protected $sc_order_profile = 0; // 0: all, 1: only user's order
    public $sc_status = 1;
    
    public function details()
    {
        return $this->hasMany(ShopOrderDetail::class, 'order_id', 'id');
    }
    public function orderTotal()
    {
        return $this->hasMany(ShopOrderTotal::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo('SCart\Core\Front\Models\ShopCustomer', 'customer_id', 'id');
    }
    public function orderStatus()
    {
        return $this->hasOne(ShopOrderStatus::class, 'id', 'status');
    }
    public function paymentStatus()
    {
        return $this->hasOne(ShopPaymentStatus::class, 'id', 'payment_status');
    }
    public function history()
    {
        return $this->hasMany(ShopOrderHistory::class, 'order_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($order) {
            foreach ($order->details as $key => $orderDetail) {
                //Update stock, sold
                ShopProduct::updateStock($orderDetail->product_id, -$orderDetail->qty);
            }
            $order->details()->delete(); //delete order details
            $order->orderTotal()->delete(); //delete order total
            $order->history()->delete(); //delete history
        });

        //Uuid
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = sc_generate_id($type = 'shop_order');
            }
        });
    }


    /**
     * Update status order
     *
     * @param [type] $orderId
     * @param integer $status
     * @param array $history
     * @return void
     */
    public function updateStatus($orderId, $status = 0, $history = [])
    {
        $order = $this->find($orderId);
        if ($order) {
            //Update status
            $order->update(['status' => (int) $status]);

            //Add history
            $dataHistory = [
                'order_id' => $orderId,
                'customer_id' => $history['user_id'] ?? 0,
                'admin_id' => $history['admin_id'] ?? 0,
                'content' => $history['content'] ?? '',
                'order_status_id' => $status,
            ];
            $this->addOrderHistory($dataHistory);

            //Process event update status order
            sc_event_order_update_status($order);
        }
    }


    public function scopeSort($query, $sortBy = null, $sortOrder = 'asc')
    {
        $sortBy = $sortBy ?? 'sort';
        return $query->orderBy($sortBy, $sortOrder);
    }

    /**
     * Create new order
     * @param  [array] $dataOrder
     * @param  [array] $dataTotal
     * @param  [array] $arrCartDetail
     * @return [array]
     */
    public function createOrder($dataOrder, $dataTotal, $arrCartDetail)
    {
        //Process escape
        $dataOrder     = sc_clean($dataOrder);
        $dataTotal     = sc_clean($dataTotal);
        $arrCartDetail = sc_clean($arrCartDetail);
        try {
            DB::connection(SC_CONNECTION)->beginTransaction();
            $dataOrder['domain'] = url('/');
            $uID = $dataOrder['customer_id'] ?? 0;
            $adminID = $dataOrder['admin_id'] ?? 0;
            unset($dataOrder['admin_id']);
            unset($dataOrder['id_addr']);
            $currency = $dataOrder['currency'];
            $exchange_rate = $dataOrder['exchange_rate'];

            $shipping   = $dataOrder['shipping_method'];
            $ship       = explode('|', $shipping);
            $name       = $ship[0];
            $code       = $ship[1];
            $service    = $ship[2];
            $cost       = $ship[3];
            $dataOrder['shipping_method'] = $service;
            $dataOrder['shipping_name'] = $name;
            $dataOrder['shipping_code'] = $code;

            //Insert order
            $order = ShopOrder::create($dataOrder);
            $orderID = $order->id;
            //End insert order

            //Insert order total
            foreach ($dataTotal as $key => $row) {
                $row = sc_clean($row);
                $row['id'] = sc_generate_id($type = 'shop_order_total');
                $row['order_id'] = $orderID;
                $row['created_at'] = sc_time_now();
                $dataTotal[$key] = $row;
            }
            ShopOrderTotal::insert($dataTotal);
            //End order total

            //Order detail
            foreach ($arrCartDetail as $cartDetail) {
                $pID = $cartDetail['product_id'];
                $product = ShopProduct::find($pID);
                
                //Check product flash sale over stock
                if (function_exists('sc_product_flash_check_over') && !sc_product_flash_check_over($pID, $cartDetail['qty'])) {
                    return $return = ['error' => 1, 'msg' => sc_language_render('cart.item_over_qty', ['sku' => $product->sku, 'qty' => $cartDetail['qty']])];
                }

                //If product out of stock
                if (!sc_config('product_buy_out_of_stock') && $product->stock < $cartDetail['qty']) {
                    return $return = ['error' => 1, 'msg' => sc_language_render('cart.item_over_qty', ['sku' => $product->sku, 'qty' => $cartDetail['qty']])];
                }
                //
                $tax = (sc_tax_price($cartDetail['price'], $product->getTaxValue()) - $cartDetail['price']) *  $cartDetail['qty'];

                $cartDetail['order_id'] = $orderID;
                $cartDetail['currency'] = $currency;
                $cartDetail['exchange_rate'] = $exchange_rate;
                $cartDetail['sku'] = $product->sku;
                $cartDetail['tax'] = $tax;
                $cartDetail['store_id'] = $cartDetail['store_id'];
                $cartDetail['attribute'] = json_encode($cartDetail['attribute']);
                $this->addOrderDetail($cartDetail);

                //Update stock flash sale
                if (function_exists('sc_product_flash_update_stock')) {
                    sc_product_flash_update_stock($pID, $cartDetail['qty']);
                }

                //Update stock and sold
                ShopProduct::updateStock($pID, $cartDetail['qty']);
            }
            //End order detail

            //Add history
            $dataHistory = [
                'order_id' => $orderID,
                'content' => 'New order',
                'customer_id' => $uID,
                'admin_id' => $adminID,
                'order_status_id' => $order->status,
            ];
            $this->addOrderHistory($dataHistory);

            //Process Discount
            $totalMethod = session('totalMethod') ?? [];
            foreach ($totalMethod as $keyPlugin => $codeApply) {
                if ($codeApply) {
                    $moduleClass = sc_get_class_plugin_controller($code = 'Total', $key = $keyPlugin);
                    $arrReturnModuleDiscount = (new $moduleClass)->apply($codeApply, $uID, $msg = 'Order #' . $orderID);
                    if ($arrReturnModuleDiscount['error'] == 1) {
                        $msg = $arrReturnModuleDiscount['msg'];
                        DB::connection(SC_CONNECTION)->rollBack();
                        $return = ['error' => 1, 'msg' => $msg];
                        return $return;
                    }
                }
            }
            // End process Discount

            //Create midtrans transaction
            $va_number = '';
            try{
                $va_number = $this->createMidtransTransaction($orderID, $dataOrder, $arrCartDetail, $dataTotal);
                if($va_number!=''){
                    $order = $this->find($orderID);
                    if ($order) {
                        $order->update(['virtual_account' => $va_number]);
                    }
                }else{
                    DB::connection(SC_CONNECTION)->rollBack();
                    Log::error('Error create midtrans transaction:', ['message' => "Virtual Acount $va_number"]);
                    $return = ['error' => 1, 'msg' => 'Error create transaction'];
                    return $return;
                }
            } catch (\Throwable $e) {
                DB::connection(SC_CONNECTION)->rollBack();
                Log::error('Error create midtrans transaction:', ['message' => $e->getMessage()]);
                $return = ['error' => 1, 'msg' => 'Error create transaction'];
                return $return;
            }
            //Create midtrans transaction

            DB::connection(SC_CONNECTION)->commit();

            // Process event created
            sc_event_order_created($order);

            $return = ['error' => 0, 'orderID' => $orderID, 'msg' => "", 'detail' => $order, 'va_number' => $va_number];
        } catch (\Throwable $e) {
            DB::connection(SC_CONNECTION)->rollBack();
            $return = ['error' => 1, 'msg' => $e->getMessage()];
        }
        return $return;
    }

    /**
     * Add order history
     * @param [array] $dataHistory
     */
    public function addOrderHistory($dataHistory)
    {
        return ShopOrderHistory::create($dataHistory);
    }

    /**
     * Add order detail
     * @param [type] $dataDetail [description]
     */
    public function addOrderDetail($dataDetail)
    {
        return ShopOrderDetail::create($dataDetail);
    }


    /**
     * Start new process get data
     *
     * @return  new model
     */
    public function start()
    {
        if ($this->sc_order_profile) {
            $obj = (new ShopOrder);
            $obj->sc_order_profile = 1;
            return $obj;
        } else {
            return new ShopOrder;
        }
    }

    /**
     * Get order detail
     *
     * @param   [int]  $orderID
     *
     */
    public function getDetail($orderID)
    {
        if (empty($orderID)) {
            return null;
        }
        $customer = auth()->user();
        if ($customer) {
            return $this->where('id', $orderID)
                ->where('customer_id', $customer->id)
                ->first();
        } else {
            return null;
        }
    }

    /**
     * Disable only user's order mode
     */
    public function setOrderProfile()
    {
        $this->sc_order_profile = 1;
        $this->sc_status = 'all' ;
        return $this;
    }

    public function profile()
    {
        $this->setOrderProfile();
        return $this;
    }

    /**
     * Get list order new
     */
    public function getOrderNew()
    {
        $this->sc_status = 1;
        return $this;
    }

    /**
     * Get list order processing
     */
    public function getOrderProcessing()
    {
        $this->sc_status = 2;
        return $this;
    }

    /**
     * Get list order hold
     */
    public function getOrderHold()
    {
        $this->sc_status = 3;
        return $this;
    }

    /**
     * Get list order canceld
     */
    public function getOrderCanceled()
    {
        $this->sc_status = 4;
        return $this;
    }

    /**
     * Get list order done
     */
    public function getOrderDone()
    {
        $this->sc_status = 5;
        return $this;
    }

    /**
     * Get list order failed
     */
    public function getOrderFailed()
    {
        $this->sc_status = 6;
        return $this;
    }

    /**
     * build Query
     */
    public function buildQuery()
    {
        $customer = auth()->user();
        if ($this->sc_order_profile == 1) {
            if (!$customer) {
                return null;
            }
            $uID = $customer->id;
            $query = $this->with('orderTotal')->where('customer_id', $uID);
        } else {
            $query = $this->with('orderTotal')->with('details');
        }

        if ($this->sc_status !== 'all') {
            $query = $query->where('status', $this->sc_status);
        }

        $query = $this->processMoreQuery($query);
        

        if ($this->random) {
            $query = $query->inRandomOrder();
        } else {
            if (is_array($this->sc_sort) && count($this->sc_sort)) {
                foreach ($this->sc_sort as  $rowSort) {
                    if (is_array($rowSort) && count($rowSort) == 2) {
                        $query = $query->sort($rowSort[0], $rowSort[1]);
                    }
                }
            }
        }

        return $query;
    }

    /**
     * Update value balance, received when order capture full money with payment method
     *
     * @return  [type]  [return description]
     */
    public function processPaymentPaid()
    {
        $total = $this->total;
        $this->balance = 0;
        $this->received = -$total;
        $this->save();
        (new ShopOrderTotal)
            ->where('order_id', $this->id)
            ->where('code', 'received')
            ->update(['value' =>  -$total]);
    }

    /**
     * Update value balance, received when order capture full money with payment method
     *
     * @return  [type]  [return description]
     */
    public function createMidtransTransaction($orderID, $dataOrder, $arrCartDetail, $dataTotal)
    {
        $customer = auth()->user();
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_ENVIRONMENT') == 'production' ? true : false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Mendapatkan order_id dan gross_amount dari argumen
        $now = Carbon::now()->setTimezone('Asia/Jakarta');

        // Item details
        $item_details[0] = [
            "id" => 'ongkir',
            "name" => 'Ongkos Kirim',
            "price" => $dataOrder['shipping'],
            "quantity" => 1,
        ];
        $item_details[1] = [
            "id" => 'tax',
            "name" => 'Pajak',
            "price" => $dataOrder['tax'],
            "quantity" => 1,
        ];
        $grossAmount = $dataOrder['shipping']+$dataOrder['tax'];
        foreach($arrCartDetail as $key => $row) {
            $item_details[$key+2]['id'] = $row['product_id'];
            $item_details[$key+2]['name'] = $row['name'];
            $item_details[$key+2]['price'] = $row['price'];
            $item_details[$key+2]['quantity'] = $row['qty'];

            $grossAmount += $row['price'] * $row['qty'];
        }

        // Data transaksi
        $transaction_details = [
            'order_id' => $orderID,
            'gross_amount' => $grossAmount,
        ];

        // Customer details
        $billing_address = [
            'first_name' => $dataOrder['first_name'],
            'last_name' => $dataOrder['last_name'],
            'address' => $dataOrder['address1'],
            'city' => $customer->regency,
            'postal_code' => $dataOrder['postcode'],
            'phone' => $dataOrder['phone'],
            'country_code' => ($customer->country=='ID') ? 'IDN' : $customer->country,
        ];

        $shipping_address = [
            'first_name' => $dataOrder['first_name'],
            'last_name' => $dataOrder['last_name'],
            'phone' => $dataOrder['phone'],
            'address' => $dataOrder['address1'],
            'city' => $customer->regency,
            'postal_code' => $dataOrder['postcode'],
            'country_code' => ($customer->country=='ID') ? 'IDN' : $customer->country,
        ];

        $customer_details = [
            'first_name' => $dataOrder['first_name'],
            'last_name' => $dataOrder['last_name'],
            'email' => $dataOrder['email'],
            'phone' => $dataOrder['phone'],
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address,
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'payment_type' => 'bank_transfer',
            'bank_transfer' => [
                'bank' => $dataOrder['payment_method'],
            ],
        ];

        try {
            // $response = Snap::createTransaction($transaction_data);
            // $this->info('Response: ' . print_r($response, true));

            $response = CoreApi::charge($transaction_data);
            return $response->va_numbers[0]->va_number;
            // $this->info('Response: ' . print_r($response, true));
            // $this->info('Response: ' . $response->va_numbers[0]->va_number);
        } catch (\Midtrans\MidtransException $e) {
            return '';
            Log::error('Error: ' . $e->getMessage());
        }
    }
}
