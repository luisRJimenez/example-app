<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prueba;

class PruebaController extends Controller
{
    public function __invoke(Request $request ) {
        
        //dd($request->data);
        $jsonData = $request->json()->all();
        // $jsonData1 = $request->input('data'); //$request->json()->all();
        // $dataArray = json_decode($jsonData1, true);
        // var_dump($jsonData[0]['name']);
        //var_dump($dataArray);
        if (!empty($jsonData) ) {

            //Codigo para insertar todos los registros a la BD

            // $dataToInsert = [];

            // foreach ($jsonData as $data) {
            //     $dataToInsert[] = [
            //         'name' => $data["name"],
            //         'email' => $data['email'],
            //         'password' => $data['password'],
            //         'miembros' => json_encode($data['miembros']),
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ];
            // }

            // Prueba::insert($dataToInsert);

            // Codigo para insertar un solo registro

            //$ArrayData = json_decode($jsonData, true);

            $primerDato = reset($jsonData);
           // $primerDato1 = reset($dataArray); //dataarray
            //dd($primerDato1["name"]);
            Prueba::create([
                'name' => $primerDato["1"],
                'email' => $primerDato['2'],
                'password' => $primerDato['3'],
                'miembros' => json_encode($primerDato['miembros']),
            ]);
            return response()->json($primerDato);
        } else {
            return response()->json(['message' => 'El JSON está vacío'], 400);
        }
        
        return Inertia::render('Encuestas/create', ['phpVersion' => PHP_VERSION,]);
    }
}
