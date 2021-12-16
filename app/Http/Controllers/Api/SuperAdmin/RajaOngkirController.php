<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    protected $API_KEY = '12702fd83b0deca04b259899de0a9409';

    public function getProvinces()
    {

        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://pro.rajaongkir.com/api/province');

        $provinces = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get All Provinces',
            'data'    => $provinces
        ]);
    }

    public function getCities($id)
    {

        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://pro.rajaongkir.com/api/city?province='.$id.'');

        $cities = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get City By ID Provinces : '.$id,
            'data'    => $cities
        ]);
    }

    public function getDistricts($id)
    {

        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://pro.rajaongkir.com/api/subdistrict?city='.$id.'');

        $districts = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get District By ID Cities : '.$id,
            'data'    => $districts
        ]);
    }

    public function checkOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin'            => 252,
            'originType'        => 'city',
            'destination'       => $request->destination,
            'destinationType'   => 'subdistrict',
            'weight'            => $request->weight,
            'courier'           => $request->courier
        ]);

        $ongkir = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Result Cost Ongkir',
            'data'    => $ongkir[0]['costs'][0]['cost'][0]['value']
        ]);
    }
}
