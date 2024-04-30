<?php

namespace App\Http\Controllers;

use App\Models\ProductBuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductBuyController extends Controller
{


    public function index(Request $request)
    {
        $includes = [];
        if ($request->query('includeProductIns')) $includes[] = 'productIns';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        $data = ProductBuy::with($includes)->get();
        return response()->json([
            "success" => true,
            "message" => "Recursos encontrados",
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            "date_buy" => "required",
            "iva_buy" => "required|numeric",
            "suplier_id" => "required|exists:supliers,id",
            "user_id" => "required|exists:users,id"
        ], [
            "date_buy.required" => "La fecha de venta es requerida",
            "iva_buy.required" => "El precio es requerido",
            'iva.numeric' => 'El campo iva debe ser un número',
            "suplier_id.required" => "El campo proveedor es requerido",
            "suplier_id.exists" => "El proveedor no existe",
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

        $data = ProductBuy::create($request->all());


        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }


    public function show(Request $request, ProductBuy $productBuy)
    {
        $includes = [];
        // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $productBuy->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $productBuy = ProductBuy::find($id);
        if (!$productBuy) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "date_buy" => "required",
            "iva_buy" => "required|numeric",
            "suplier_id" => "required|exists:supliers,id",
            "user_id" => "required|exists:users,id"

        ], [
            "date_buy.required" => "La fecha de venta es requerida",
            "iva_buy.required" => "El precio es requerido",
            'iva.numeric' => 'El campo iva debe ser un número',
            "suplier_id.required" => "El campo proveedor es requerido",
            "suplier_id.exists" => "El proveedor no existe",
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


        $productBuy->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $productBuy,
            "token" => null
        ]);
    }

    public function destroy(ProductBuy $productBuy)
    {
        $productBuy->load(['productIns']);
        if ($productBuy->productIns->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }

        $productBuy->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $productBuy
        ]);
    }
}
