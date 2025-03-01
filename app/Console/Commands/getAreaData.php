<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class getAreaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elementa:get-area-data {BLOCKID=province}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jobs untuk mengambil data provinsi, kabupaten, kecamatan, dan kelurahan dari API Binderbyte';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $BLOCKID = $this->argument('BLOCKID') ?? 'province';
        $this->info("Fetching data for $BLOCKID");

        $apiKey = $value = env('BINDERBYTE_API_KEY');

        if (!$apiKey) {
            $this->error('API Key is missing. Please set BINDERBYTE_API_KEY in .env file.');
            return;
        }

        switch ($BLOCKID) {
            case 'province':
                $this->fetchProvince($apiKey);
                break;
            case 'regency':
                $this->fetchCity($apiKey);
                break;
            case 'district':
                $this->fetchDistrict($apiKey);
                break;
            case 'subdistrict':
                $this->fetchVillage($apiKey);
                break;
            default:
                $this->error('Invalid BLOCKID');
                break;
        }
    }

    private function fetchProvince($apiKey)
    {
        $url = "https://api.binderbyte.com/wilayah/provinsi?api_key=$apiKey";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            $this->error("Failed to fetch data. HTTP Code: $httpCode");
            return;
        }

        $data = json_decode($response, true);

        if (!isset($data['value'])) {
            $this->error("Invalid response format.");
            return;
        }

        try {
            DB::table('sc_binderbyte_province')->truncate();

            $insertedRow = 0;
            foreach ($data['value'] as $province) {
                DB::table('sc_binderbyte_province')->insert([
                    'id' => $province['id'],
                    'name' => $province['name'],
                ]);

                $insertedRow++;
            }
            
            $this->info("Inserted Province : ".$insertedRow." rows");

            return "Success";
        } catch (\Exception $e) {
            $this->error("Inserted Province failed : " . $e->getMessage());
            return "failed.";
        }

    }

    private function fetchCity($apiKey)
    {
        $province = DB::table('sc_binderbyte_province')->get();

        try {
            DB::table('sc_binderbyte_regency')->truncate();

            $insertedRow = 0;
            foreach ($province as $key => $value) {
                $error = false;

                $provinceId     = $value->id;
                $provinceName   = $value->name;

                $url = "https://api.binderbyte.com/wilayah/kabupaten?api_key=$apiKey&id_provinsi=$provinceId";

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                if ($httpCode !== 200 || !$response) {
                    $this->error("Failed to fetch data. HTTP Code: $httpCode");
                    return;
                }

                $data = json_decode($response, true);

                if (!isset($data['value'])) {
                    $this->error("Invalid response format.");
                    return;
                }

                try {
                    $inserted = 0;
                    foreach ($data['value'] as $city) {
                        DB::table('sc_binderbyte_regency')->insert([
                            'id' => $city['id'],
                            'name' => $city['name'],
                            'id_province' => $provinceId
                        ]);

                        $inserted++;
                    }
                    
                    $insertedRow += $inserted;
                    $this->info("Successfully Inserted Regency for province : ".$provinceName."  => ".$inserted." rows");
                } catch (\Exception $e) {
                    $this->error("Failed Inserted Regency for province : ".$provinceName."  => ". $e->getMessage());
                }
            }

            $this->info("Inserted Regency : ".$insertedRow." rows");
            return true;
        } catch (\Exception $e) {
            $this->error("Failed Inserted Regency : " . $e->getMessage());
            return false;
        }
    }

    private function fetchDistrict($apiKey)
    {
        $province = DB::table('sc_binderbyte_regency')->get();

        try {
            DB::table('sc_binderbyte_district')->truncate();

            $insertedRow = 0;
            foreach ($province as $key => $value) {
                $error = false;

                $regencyId     = $value->id;
                $regencyName   = $value->name;

                $url = "https://api.binderbyte.com/wilayah/kecamatan?api_key=$apiKey&id_kabupaten=$regencyId";

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                if ($httpCode !== 200 || !$response) {
                    $this->error("Failed to fetch data. HTTP Code: $httpCode");
                    return;
                }

                $data = json_decode($response, true);

                if (!isset($data['value'])) {
                    $this->error("Invalid response format.");
                    return;
                }

                try {
                    $inserted = 0;
                    foreach ($data['value'] as $city) {
                        DB::table('sc_binderbyte_district')->insert([
                            'id' => $city['id'],
                            'name' => $city['name'],
                            'id_regency' => $regencyId
                        ]);

                        $inserted++;
                    }
                    
                    $insertedRow += $inserted;
                    $this->info("Successfully Inserted District for Regency : ".$regencyName."  => ".$inserted." rows");
                } catch (\Exception $e) {
                    $this->error("Failed Inserted District for Regency : ".$regencyName."  => ". $e->getMessage());
                }
            }

            $this->info("Inserted District : ".$insertedRow." rows");
            return true;
        } catch (\Exception $e) {
            $this->error("Failed Inserted District : " . $e->getMessage());
            return false;
        }
    }

    private function fetchVillage($apiKey)
    {
        $province = DB::table('sc_binderbyte_district')->get();

        try {
            DB::table('sc_binderbyte_subdistrict')->truncate();

            $insertedRow = 0;
            foreach ($province as $key => $value) {
                $error = false;

                $regencyId      = $value->id_regency;
                $districtId     = $value->id;
                $districtName   = $value->name;

                $url = "https://api.binderbyte.com/wilayah/kecamatan?api_key=$apiKey&id_kabupaten=$regencyId&id_kecamatan=$districtId";

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                if ($httpCode !== 200 || !$response) {
                    $this->error("Failed to fetch data. HTTP Code: $httpCode");
                    return;
                }

                $data = json_decode($response, true);

                if (!isset($data['value'])) {
                    $this->error("Invalid response format.");
                    return;
                }

                try {
                    $inserted = 0;
                    foreach ($data['value'] as $city) {
                        DB::table('sc_binderbyte_subdistrict')->insert([
                            'id' => $city['id'],
                            'name' => $city['name'],
                            'id_district' => $districtId
                        ]);

                        $inserted++;
                    }
                    
                    $insertedRow += $inserted;
                    $this->info("Successfully Inserted Sub District for district : ".$districtName."  => ".$inserted." rows");
                } catch (\Exception $e) {
                    $this->error("Failed Inserted Sub District for district : ".$districtName."  => ". $e->getMessage());
                }
            }

            $this->info("Inserted Sub District : ".$insertedRow." rows");
            return true;
        } catch (\Exception $e) {
            $this->error("Failed Inserted Sub District : " . $e->getMessage());
            return false;
        }
    }
}
