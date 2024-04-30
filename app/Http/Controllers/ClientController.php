<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $includes = [];
        if ($request->query('includeProductSales')) $includes[] = 'productSales';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        $data = Client::with($includes)->get();
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
            "name2" => "required|min:3|max:150",
            "lastname" => "required|min:3|max:150",
            "lastname2" => "required|min:3|max:150",
            "dni" => "required|min:10|max:10",
            "ruc" => "required|min:3|max:150",
            "city" => "required|min:3|max:150",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:15",
            "cellphone" => "required|min:10|max:15",
            "email" => "required|email|unique:users,email",

        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "name2.required" => "El campo nombre 2 es requerido",
            "name2.min" => "El campo nombre 2 debe tener al menos 3 caracteres",
            "name2.max" => "El campo nombre 2 debe tener como máximo 150 caracteres",
            "lastname.required" => "El campo apellido es requerido",
            "lastname.min" => "El campo apellido debe tener al menos 3 caracteres",
            "lastname.max" => "El campo apellido debe tener como máximo 150 caracteres",
            "lastname2.required" => "El campo apellido 2 es requerido",
            "lastname2.min" => "El campo apellido 2 debe tener al menos 3 caracteres",
            "lastname2.max" => "El campo apellido 2 debe tener como máximo 150 caracteres",
            "dni.required" => "El campo cedula es requerido",
            "dni.min" => "El campo cedula debe tener al menos 10 caracteres",
            "dni.max" => "El campo cedula debe tener como máximo 15 caracteres",
            "ruc.required" => "El campo ruc es requerido",
            "ruc.min" => "El campo ruc debe tener al menos 10 caracteres",
            "ruc.max" => "El campo ruc debe tener como máximo 15 caracteres",
            "city.required" => "El campo ciudad es requerido",
            "city.min" => "El campo ciudad debe tener al menos 10 caracteres",
            "city.max" => "El campo ciudad debe tener como máximo 15 caracteres",
            "address.required" => "El campo dirección es requerido",
            "address.min" => "El campo dirección debe tener al menos 10 caracteres",
            "address.max" => "El campo dirección debe tener como máximo 250 caracteres",
            "phone.required" => "El campo teléfono es requerido",
            "phone.min" => "El campo teléfono debe tener al menos 10 caracteres",
            "phone.max" => "El campo teléfono debe tener como máximo 15 caracteres",
            "cellphone.required" => "El campo celular es requerido",
            "cellphone.min" => "El campo clular debe tener al menos 10 caracteres",
            "cellphone.max" => "El campo celular debe tener como máximo 15 caracteres",
            "email.required" => "El campo email es requerido",
            "email.email" => "El campo email debe ser un correo electrónico válido",
            "email.unique" => "El campo email ya está en uso",

        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }



        $request->merge(["confirmation_code" => md5($request->email)]);

        $data = Client::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }


    public function show(Request $request, Client $client)
    {
        $includes = [];
        // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $client->load($includes),
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "name2" => "required|min:3|max:150",
            "lastname" => "required|min:3|max:150",
            "lastname2" => "required|min:3|max:150",
            "dni" => "required|min:10|max:10",
            "ruc" => "required|min:3|max:150",
            "city" => "required|min:3|max:150",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:15",
            "cellphone" => "required|min:10|max:15",
            "email" => "required|email|unique:users,email"
        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "name2.required" => "El campo nombre 2 es requerido",
            "name2.min" => "El campo nombre 2 debe tener al menos 3 caracteres",
            "name2.max" => "El campo nombre 2 debe tener como máximo 150 caracteres",
            "lastname.required" => "El campo apellido es requerido",
            "lastname.min" => "El campo apellido debe tener al menos 3 caracteres",
            "lastname.max" => "El campo apellido debe tener como máximo 150 caracteres",
            "lastname2.required" => "El campo apellido 2 es requerido",
            "lastname2.min" => "El campo apellido 2 debe tener al menos 3 caracteres",
            "lastname2.max" => "El campo apellido 2 debe tener como máximo 150 caracteres",
            "dni.required" => "El campo cedula es requerido",
            "dni.min" => "El campo cedula debe tener al menos 10 caracteres",
            "dni.max" => "El campo cedula debe tener como máximo 15 caracteres",
            "ruc.required" => "El campo ruc es requerido",
            "ruc.min" => "El campo ruc debe tener al menos 10 caracteres",
            "ruc.max" => "El campo ruc debe tener como máximo 15 caracteres",
            "city.required" => "El campo ciudad es requerido",
            "city.min" => "El campo ciudad debe tener al menos 10 caracteres",
            "city.max" => "El campo ciudad debe tener como máximo 15 caracteres",
            "address.required" => "El campo dirección es requerido",
            "address.min" => "El campo dirección debe tener al menos 10 caracteres",
            "address.max" => "El campo dirección debe tener como máximo 250 caracteres",
            "phone.required" => "El campo teléfono es requerido",
            "phone.min" => "El campo teléfono debe tener al menos 10 caracteres",
            "phone.max" => "El campo teléfono debe tener como máximo 15 caracteres",
            "cellphone.required" => "El campo celular es requerido",
            "cellphone.min" => "El campo clular debe tener al menos 10 caracteres",
            "cellphone.max" => "El campo celular debe tener como máximo 15 caracteres",
            "email.required" => "El campo email es requerido",
            "email.email" => "El campo email debe ser un correo electrónico válido",
            "email.unique" => "El campo email ya está en uso",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }


        $client->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $client,
            "token" => null
        ]);
    }


    public function destroy(Client $client)
    {
        $client->load(['productSales']);
        if ($client->productSales->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }


        $client->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $client
        ]);
    }
}
