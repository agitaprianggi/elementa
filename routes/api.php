<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

Route::post('/calculate-ship-cost', function (Request $request) {
    try {
        $data = $request->validate([
            'destination' => 'required|string',
            'weight'      => 'required|numeric'
        ]);

        $data['origin'] = "31513";
        $data['courier'] = "jne:pos";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 60,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                "key: 8ItJxI25b6412102861be883i4lqUm5c",
                "Content-Type: application/x-www-form-urlencoded"
            ]
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error('cURL Error:', ['message' => $err]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        return response()->json(json_decode($response, true));
    } catch (\Exception $e) {
        Log::error('API Error:', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });