<?php

namespace App\Http\Controllers;

use App\Models\ProductSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductSaleController extends Controller
{

    public function index(Request $request)
    {
        $includes = [];
        if ($request->query('includeProductOuts')) $includes[] = 'productOuts';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        $data = ProductSale::with($includes)->get();
        return response()->json([
            "success" => true,
            "message" => "Recursos encontrados",
            "data" => $data
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            "date" => "required",
            "iva" => 'required|numeric',
            "client_id" => "required|exists:clients,id",
            "user_id" => "required|exists:users,id",
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

    public function show(ProductSale $productSale)
    {
        $includes = [];
        // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $productSale->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $productSale = ProductSale::find($id);
        if (!$productSale) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "date" => "required",
            "iva" => 'required|numeric',
            "client_id" => "required|exists:clients,id",
            "user_id" => "required|exists:users,id",
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

        $productSale->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $productSale,
            "token" => null
        ]);
    }


    public function destroy(ProductSale $productSale)
    {
        $productSale->load(['productOuts']);
        if ($productSale->productOuts->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }

        $productSale->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $productSale
        ]);
    }
}
