<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{

    private $PHOTO_PATH = "public/img_products";
    private $IMAGE_TYPE = "jpg,jpeg,png";

    public function index()
    {
        $includes = [];
        // if ($request->query('includeBusinesses')) $includes[] = 'businesses';
        // if ($request->query('includeCarts')) $includes[] = 'carts';

        $data = Info::with($includes)->get();
        return response()->json([
            "success" => true,
            "message" => "Recursos encontrados",
            "data" => $data[0]
        ]);
    }


    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(),  [
    //         "name" => "required|min:3|max:150",
    //         "logo" => "file|mimes:" . $this->IMAGE_TYPE,
    //         "icon" => "required|min:5|max:250",
    //         "city" => "required|min:5|max:250",
    //         "address" => "required|min:5|max:250",
    //         "phone" => "required|min:10|max:250",
    //         "cellphone" => "required|min:10|max:250",
    //         "email" => "required|email|unique:users,email",
    //         "tax" => "required|min:5|max:250",
    //     ], [
    //         "name.required" => "El campo nombre es requerido",
    //         "name.min" => "El campo nombre debe tener al menos 3 caracteres",
    //         "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
    //         "logo.file" => "El campo logo debe ser un archivo",
    //         "logo.mimes" => "El campo logo debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
    //         "icon.required" => "El campo icono es requerido",
    //         "icon.min" => "El campo icono debe tener al menos 10 caracteres",
    //         "icon.max" => "El campo icono debe tener como máximo 250 caracteres",
    //         "city.required" => "El campo icono es requerido",
    //         "city.min" => "El campo ciudad debe tener al menos 10 caracteres",
    //         "city.max" => "El campo ciudad debe tener como máximo 250 caracteres",
    //         "address.required" => "El campo dirección es requerido",
    //         "address.min" => "El campo dirección debe tener al menos 10 caracteres",
    //         "address.max" => "El campo dirección debe tener como máximo 250 caracteres",
    //         "phone.required" => "El campo telefono es requerido",
    //         "phone.min" => "El campo telefono debe tener al menos 10 caracteres",
    //         "phone.max" => "El campo telefono debe tener como máximo 250 caracteres",
    //         "cellphone.required" => "El campo celular es requerido",
    //         "cellphone.min" => "El campo celular debe tener al menos 10 caracteres",
    //         "cellphone.max" => "El campo celular debe tener como máximo 250 caracteres",
    //         "email.required" => "El campo email es requerido",
    //         "email.email" => "El campo email debe ser un correo electrónico válido",
    //         "email.unique" => "El campo email ya está en uso",
    //         "tax.required" => "El campo impuesto es requerido",
    //         "tax.min" => "El campo impuesto debe tener al menos 10 caracteres",
    //         "tax.max" => "El campo impuesto debe tener como máximo 250 caracteres",
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             "success" => false,
    //             "message" => $validator->errors()->first(),
    //             "errors" => $validator->errors(),
    //             "data" => null
    //         ]);
    //     }


    //     if ($request->file("logo")) {
    //         $fileName_photo = basename($request->file("logo")->store($this->PHOTO_PATH));
    //         $request = new Request($request->except(["logo"]) + ["logo" => $fileName_photo]);
    //     }


    //     $request->merge(["confirmation_code" => md5($request->email)]);

    //     $data = Info::create($request->all());

    //     $token = $data->createToken('authToken')->plainTextToken;
    //     $data->token = $token;

    //     return response()->json([
    //         "success" => true,
    //         "message" => "Recurso creado",
    //         "errors" => null,
    //         "data" => $data,
    //         "token" => $token,
    //     ]);
    // }


    // public function show(Request $request, Info $info)
    // {
    //     $includes = [];
    //     // if ($request->query('includeProductBuys')) $includes[] = 'product_buys';
    //     // if ($request->query('includeCarts')) $includes[] = 'carts';

    //     return response()->json([
    //         "success" => true,
    //         "message" => "Recurso encontrado",
    //         "errors" => null,
    //         "data" => $info->load($includes),
    //     ]);
    // }


    public function update(Request $request, $id)
    {
        $info = Info::find($id);
        if (!$info) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "logo" => "file|mimes:" . $this->IMAGE_TYPE,
            "icon" => "required|min:5|max:250",
            "city" => "required|min:5|max:250",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:250",
            "cellphone" => "required|min:10|max:250",
            "email" => "required|email|unique:users,email",
            "tax" => "required|min:5|max:250" . $id
        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "logo.file" => "El campo logo debe ser un archivo",
            "logo.mimes" => "El campo logo debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
            "icon.required" => "El campo icono es requerido",
            "icon.min" => "El campo icono debe tener al menos 10 caracteres",
            "icon.max" => "El campo icono debe tener como máximo 250 caracteres",
            "city.required" => "El campo icono es requerido",
            "city.min" => "El campo ciudad debe tener al menos 10 caracteres",
            "city.max" => "El campo ciudad debe tener como máximo 250 caracteres",
            "address.required" => "El campo dirección es requerido",
            "address.min" => "El campo dirección debe tener al menos 10 caracteres",
            "address.max" => "El campo dirección debe tener como máximo 250 caracteres",
            "phone.required" => "El campo telefono es requerido",
            "phone.min" => "El campo telefono debe tener al menos 10 caracteres",
            "phone.max" => "El campo telefono debe tener como máximo 250 caracteres",
            "cellphone.required" => "El campo celular es requerido",
            "cellphone.min" => "El campo celular debe tener al menos 10 caracteres",
            "cellphone.max" => "El campo celular debe tener como máximo 250 caracteres",
            "email.required" => "El campo email es requerido",
            "email.email" => "El campo email debe ser un correo electrónico válido",
            "email.unique" => "El campo email ya está en uso",
            "tax.required" => "El campo impuesto es requerido",
            "tax.min" => "El campo impuesto debe tener al menos 10 caracteres",
            "tax.max" => "El campo impuesto debe tener como máximo 250 caracteres",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        if ($request->file("photo")) {
            $fileName_photo = basename($request->file("logo")->store($this->PHOTO_PATH));
            $request = new Request($request->except(["logo"]) + ["logo" => $fileName_photo]);
            if (Storage::exists($this->PHOTO_PATH . "/" . $info->logo)) Storage::delete($this->PHOTO_PATH . "/" . $info->logo);
        }



        $info->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $info,
            "token" => null
        ]);
    }


    // public function destroy(Info $info)
    // {

    //     // eliminamos tambien el archivo
    //     if (Storage::exists($this->PHOTO_PATH . "/" . $info->logo)) Storage::delete($this->PHOTO_PATH . "/" . $info->logo);

    //     $info->delete();

    //     return response()->json([
    //         "success" => true,
    //         "message" => "Recurso eliminado",
    //         "errors" => null,
    //         "data" => $info
    //     ]);
    // }
}
