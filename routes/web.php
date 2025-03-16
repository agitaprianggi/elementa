<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

Route::get('/search-address', function () {
    try {
        $search = request('search');
        if (!$search) {
            return response()->json(['error' => 'Search parameter is required'], 400);
        }

        $response = Http::withOptions([
            'verify' => false  // << Nonaktifkan SSL verification
        ])->withHeaders([
            'key' => '8ItJxI25b6412102861be883i4lqUm5c'
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/domestic-destination", [
            'limit' => 10,
            'offset' => 0,
            'search' => $search
        ]);

        return response()->json($response->json());
    } catch (\Exception $e) {
        Log::error('API Error:', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
});



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route::get('/', function () {
//     return view('welcome');
// });
