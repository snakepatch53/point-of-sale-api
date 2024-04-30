<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LockerController extends Controller
{

    public function index(Request $request)
    {
        $includes = [];
        if ($request->query('includeProducts')) $includes[] = 'products';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        $data = Locker::with($includes)->get();
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
            "description" => "required|min:5|max:250",
        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "description.required" => "El campo descripción es requerido",
            "description.min" => "El campo descripción debe tener al menos 5 caracteres",
            "description.max" => "El campo descripción debe tener como máximo 250 caracteres",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $data = Locker::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }


    public function show(Request $request, Locker $locker)
    {
        $includes = [];
        // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $locker->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $locker = Locker::find($id);
        if (!$locker) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "description" => "required|min:5|max:250",
        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "description.required" => "El campo descripción es requerido",
            "description.min" => "El campo descripción debe tener al menos 5 caracteres",
            "description.max" => "El campo descripción debe tener como máximo 250 caracteres",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $locker->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $locker,
            "token" => null
        ]);
    }


    public function destroy(Locker $locker)
    {
        $locker->load(['products']);
        if ($locker->products->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }


        $locker->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $locker
        ]);
    }
}
