<?php

namespace App\Http\Controllers;

use App\Models\ProductOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductOutController extends Controller
{

    public function index(Request $request)
    {
        $includes = [];
        // if ($request->query('includeCategory')) $includes[] = 'category';
        // if ($request->query('includeBusiness')) $includes[] = 'category.business';
        // if ($request->query('includeProductCarts')) $includes[] = 'productCarts';

        $data = ProductOut::with($includes)->get();
        return response()->json([
            "success" => true,
            "message" => "Recursos encontrados",
            "data" => $data
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            "quantity" => 'required|numeric',
            "price" => 'required|numeric',
            "commission" => 'required|numeric',
            "product_id" => "required|exists:products,id",
            "product_sale_id" => "required|exists:product_sales,id"
        ], [
            'quantity.required' => 'El campo cantidad es requerido',
            'quantity.numeric' => 'El campo cantidad debe ser un número',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio debe ser un número',
            'commision.required' => 'El campo comisión es requerido',
            'commision.numeric' => 'El campo comisión debe ser un número',
            "product_id.required" => "El campo producto es requerido",
            "product_id.exists" => "El producto no existe",
            "product_sale_id.required" => "El campo producto en venta es requerido",
            "product_sale_id.exists" => "El producto en venta no existe"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $data = ProductOut::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data
        ]);
    }


    public function show(ProductOut $productOut)
    {
        $includes = [];
        // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $productOut->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $productOut = ProductOut::find($id);
        if (!$productOut) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "date" => 'required',
            "quantity" => 'required|numeric',
            "price" => 'required|numeric',
            "commission" => 'required|numeric',
            "product_id" => "required|exists:products,id",
            "product_buy_id" => "required|exists:product_buys,id"
        ], [
            'date.required' => 'El campo fecha es requerido',
            'quantity.required' => 'El campo cantidad es requerido',
            'quantity.numeric' => 'El campo cantidad debe ser un número',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio debe ser un número',
            'commision.required' => 'El campo comisión es requerido',
            'commision.numeric' => 'El campo comisión debe ser un número',
            "product_id.required" => "El campo producto es requerido",
            "product_id.exists" => "El producto no existe",
            "product_buy_id.required" => "El campo producto en venta es requerido",
            "product_buy_id.exists" => "El producto en venta no existe"
        ]);


        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }


        $productOut->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $productOut,
            "token" => null
        ]);
    }


    public function destroy(ProductOut $productOut)
    {
        $productOut->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $productOut
        ]);
    }
}
