<?php

namespace App\Http\Controllers;

use App\Models\ProductSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComboController extends Controller
{

    public function bulkSale(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            "date" => "required",
            "iva" => 'required|numeric',
            "client_id" => "required|exists:clients,id",
            "user_id" => "required|exists:users,id",
            "products" => "required|exist:products[].id,id"
        ], [
            "date.required" => "El campo fecha es requerido",
            "iva.required" => "El campo iva es requerido",
            'iva.numeric' => 'El campo iva debe ser un número',
            "client_id.required" => "El campo cliente es requerido",
            "client_id.exists" => "El cliente no existe",
            "user_id.required" => "El campo usuario es requerido",
            "user_id.exists" => "El usuario no existe"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $data = ProductSale::create($request->all());


        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }
}
