<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemperatureController extends Controller
{
    function getTemperature()
    {
        // variabel di php tidak perlu tipe data,
        // nama variable diawali tanda $
        // mengambil semua data temperature
        $temperature = Temperature::all();
        // mengambalikan response dalam bentuk JSON
        // dan status code 200 
        return response()->json([
            "message"   => "Data temeperature berhasil diambil",
            "data"      => $temperature
        ], 200);
    }

    function insertTemperature(Request $request)
    {
        //1. Mengambil data request
        $value = $request->temperature;

        //2.Menyimpan data requeat ke database
        $temperature = Temperature::create([
            'value' => $value
        ]);

        //3. Mengembalikan response json
        //dengan status code 200/201
        return response()->json([
            "message" => "Data temperature berhasil ditambahkan",
            "data"    => $temperature
        ], 201);
    }

    public function deleteTemperature(Request $request)
    {
        Temperature::findorfail($request->id)->delete();

        return response()->json([
            'success' => true,
            "message" => "Data berhasil dihapus"
        ], 201);
    }

    public function putTemperature(Request $request)
    {
        $temperature = Temperature::findOrFail($request->id);

        $temperature->value = $request->value;

        $temperature->update();

        return response()->json([
            "message" => "Data berhasil diubah",
            "data"    => $temperature
        ], 201);
    }
}
