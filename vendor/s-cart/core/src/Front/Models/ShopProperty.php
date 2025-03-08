<?php
namespace SCart\Core\Front\Models;

use SCart\Core\Front\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use SCart\Core\Front\Models\ShopStore;


class ShopProperty extends Model
{
    use \SCart\Core\Front\Models\ModelTrait;
    use \SCart\Core\Front\Models\UuidTrait;

    public $table = SC_DB_PREFIX.'shop_product_property';
    protected $guarded = [];
    private static $getList = null;
    protected $connection = SC_CONNECTION;


    public static function getListAll()
    {
        if (self::$getList === null) {
            self::$getList = self::get()->keyBy('id');
        }
        return self::$getList;
    }

    public function products()
    {
        return $this->hasMany(ShopProduct::class, 'property', 'code');
    }

    // public function stores()
    // {
    //     return $this->belongsToMany(ShopStore::class, ShopBrandStore::class, 'brand_id', 'store_id');
    // }

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($property) {
            $property->stores()->detach();

            //Delete custom field
            (new ShopCustomFieldDetail)
            ->join(SC_DB_PREFIX.'shop_custom_field', SC_DB_PREFIX.'shop_custom_field.id', SC_DB_PREFIX.'shop_custom_field_detail.custom_field_id')
            ->where(SC_DB_PREFIX.'shop_custom_field_detail.rel_id', $property->code)
            // ->where(SC_DB_PREFIX.'shop_custom_field.type', 'shop_brand')
            ->delete();
        });

        //Uuid
        // static::creating(function ($model) {
        //     if (empty($model->{$model->getKeyName()})) {
        //         $model->{$model->getKeyName()} = sc_generate_id($type = 'shop_brand');
        //     }
        // });
    }

    /**
     * [getUrl description]
     * @return [type] [description]
     */
    public function getUrl($lang = null)
    {
        return sc_route('property.detail', ['alias' => $this->alias, 'lang' => $lang ?? app()->getLocale()]);
    }

    // /*
    // Get thumb
    // */
    // public function getThumb()
    // {
    //     return sc_image_get_path_thumb($this->image);
    // }

    // /*
    // Get image
    // */
    // public function getImage()
    // {
    //     return sc_image_get_path($this->image);
    // }


    // public function scopeSort($query, $sortBy = null, $sortOrder = 'asc')
    // {
    //     $sortBy = $sortBy ?? 'sort';
    //     return $query->orderBy($sortBy, $sortOrder);
    // }
    

    // /**
    //  * Get page detail
    //  *
    //  * @param   [string]  $key     [$key description]
    //  * @param   [string]  $type  [id, alias]
    //  * @param   [int]  $checkActive
    //  *
    //  */
    // public function getDetail($key, $type = null, $checkActive = 1)
    // {
    //     if (empty($key)) {
    //         return null;
    //     }
    //     $storeId = config('app.storeId');
    //     $dataSelect = $this->getTable().'.*';
    //     $data = $this->selectRaw($dataSelect);
    //     if ($type === null) {
    //         $data = $data->where($this->getTable().'.id', $key);
    //     } else {
    //         $data = $data->where($type, $key);
    //     }
    //     if (sc_check_multi_shop_installed()) {
    //         $tableBrandStore = (new ShopBrandStore)->getTable();
    //         $tableStore = (new ShopStore)->getTable();
    //         $data = $data->join($tableBrandStore, $tableBrandStore.'.brand_id', $this->getTable() . '.id');
    //         $data = $data->join($tableStore, $tableStore . '.id', $tableBrandStore.'.store_id');
    //         $data = $data->where($tableStore . '.status', '1');
    //         $data = $data->where($tableBrandStore.'.store_id', $storeId);
    //     }
    //     if ($checkActive) {
    //         $data = $data->where($this->getTable() .'.status', 1);
    //     }
    //     return $data->first();
    // }


    /**
     * Start new process get data
     *
     * @return  new model
     */
    public function start()
    {
        return new ShopProperty;
    }

    /**
     * build Query
     */
    public function buildQuery()
    {
        $storeId = config('app.storeId');
        $dataSelect = $this->getTable().'.*';
        $query = $this->selectRaw($dataSelect);
            // ->where($this->getTable().'.status', 1);

        if (sc_check_multi_shop_installed()) {
            $tableProperty = (new ShopProperty)->getTable();
            $tableStore = (new ShopStore)->getTable();
            // $query = $query->join($tableBrandStore, $tableBrandStore.'.brand_id', $this->getTable() . '.id');
            // $query = $query->join($tableStore, $tableStore . '.id', $tableBrandStore.'.store_id');
            // $query = $query->where($tableStore . '.status', '1');
            // $query = $query->where($tableBrandStore.'.store_id', $storeId);
        }

        $query = $this->processMoreQuery($query);
        
        if ($this->sc_random) {
            $query = $query->inRandomOrder();
        } else {
            //Default, will sort id
            $query = $query->orderBy($this->getTable().'.id', 'desc');
        }

        return $query;
    }
}
