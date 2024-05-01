<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComboController extends Controller
{
    public function bulkSale(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            "iva" => 'required|numeric',
            "client_id" => "required|exists:clients,id",
            "user_id" => "required|exists:users,id",
            "products" => "required|array",
            "products.*.product_id" => "required|exists:products,id",
            "products.*.quantity" => "required|numeric"
        ], [
            "iva.required" => "El campo iva es requerido",
            'iva.numeric' => 'El campo iva debe ser un número',
            "client_id.required" => "El campo cliente es requerido",
            "client_id.exists" => "El cliente no existe",
            "user_id.required" => "El campo usuario es requerido",
            "user_id.exists" => "El usuario no existe",
            "products.required" => "El campo productos es requerido",
            "products.array" => "El campo productos debe ser un arreglo",
            "products.*.product_id.required" => "El campo producto id es requerido",
            "products.*.product_id.exists" => "El producto no existe",
            "products.*.quantity.required" => "El campo cantidad es requerido",
            "products.*.quantity.numeric" => "El campo cantidad debe ser un número",
            "products.*.price.required" => "El campo precio es requerido",
            "products.*.price.numeric" => "El campo precio debe ser un número",
            "products.*.product_id.distinct" => "El producto se repite"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $productSale = ProductSale::create($request->all());

        foreach ($request->products as $productOut) {
            $product = Product::find($productOut['product_id']);
            $productSale->productOuts()->create([
                "quantity" => $productOut['quantity'],
                "price" => $product['price'],
                "commission" => $product['commission'],
                "product_id" => $productOut['product_id']
            ]);
        }


        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $productSale->load('productOuts')
        ]);
    }
}
