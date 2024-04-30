<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{

    public function index(Request $request)
    {
        $includes = [];
        if ($request->query('includeProductBuys')) $includes[] = 'productBuys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        $data = Suplier::with($includes)->get();
        return response()->json([
            "success" => true,
            "message" => "Recursos encontrados",
            "data" => $data
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "province" => "required|min:5|max:250",
            "city" => "required|min:5|max:250",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:15",
            "cellphone" => "required|min:10|max:15",
            "email" => "required|email|unique:users,email",
            "ruc" => "required|numeric",
        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "province.required" => "El campo provincia es requerido",
            "province.min" => "El campo provincia debe tener al menos 5 caracteres",
            "province.max" => "El campo provincia debe tener como máximo 250 caracteres",
            "city.required" => "El campo ciudad es requerido",
            "city.min" => "El campo ciudad debe tener al menos 5 caracteres",
            "city.max" => "El campo ciudad debe tener como máximo 250 caracteres",
            "address.required" => "El campo dirección es requerido",
            "address.min" => "El campo dirección debe tener al menos 10 caracteres",
            "address.max" => "El campo dirección debe tener como máximo 250 caracteres",
            "phone.required" => "El campo teléfono es requerido",
            "phone.min" => "El campo teléfono debe tener al menos 10 caracteres",
            "phone.max" => "El campo teléfono debe tener como máximo 15 caracteres",
            "cellphone.required" => "El campo celular es requerido",
            "cellphone.min" => "El campo celular debe tener al menos 10 caracteres",
            "cellphone.max" => "El campo celular debe tener como máximo 15 caracteres",
            "email.required" => "El campo email es requerido",
            "email.email" => "El campo email debe ser un correo electrónico válido",
            "email.unique" => "El campo email ya está en uso",
            'ruc.required' => 'El campo ruc es requerido',
            'ruc.numeric' => 'El campo ruc debe ser un número',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $data = Suplier::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }


    public function show(Suplier $suplier)
    {
        $includes = [];
        // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $suplier->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = Suplier::find($id);
        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "province" => "required|min:5|max:250",
            "city" => "required|min:5|max:250",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:15",
            "cellphone" => "required|min:10|max:15",
            "email" => "required|email|unique:users,email",
            "ruc" => "required|numeric",
        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "province.required" => "El campo provincia es requerido",
            "province.min" => "El campo provincia debe tener al menos 5 caracteres",
            "province.max" => "El campo provincia debe tener como máximo 250 caracteres",
            "city.required" => "El campo ciudad es requerido",
            "city.min" => "El campo ciudad debe tener al menos 5 caracteres",
            "city.max" => "El campo ciudad debe tener como máximo 250 caracteres",
            "address.required" => "El campo dirección es requerido",
            "address.min" => "El campo dirección debe tener al menos 10 caracteres",
            "address.max" => "El campo dirección debe tener como máximo 250 caracteres",
            "phone.required" => "El campo teléfono es requerido",
            "phone.min" => "El campo teléfono debe tener al menos 10 caracteres",
            "phone.max" => "El campo teléfono debe tener como máximo 15 caracteres",
            "cellphone.required" => "El campo celular es requerido",
            "cellphone.min" => "El campo celular debe tener al menos 10 caracteres",
            "cellphone.max" => "El campo celular debe tener como máximo 15 caracteres",
            "email.required" => "El campo email es requerido",
            "email.email" => "El campo email debe ser un correo electrónico válido",
            "email.unique" => "El campo email ya está en uso",
            'ruc.required' => 'El campo ruc es requerido',
            'ruc.numeric' => 'El campo ruc debe ser un número',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }


        $user->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $user,
            "token" => null
        ]);
    }


    public function destroy(Suplier $suplier)
    {
        $suplier->load(['productBuys']);
        if ($suplier->productBuys->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }

        $suplier->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $suplier
        ]);
    }
}
