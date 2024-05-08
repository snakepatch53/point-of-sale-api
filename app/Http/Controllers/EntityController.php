<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EntityController extends Controller
{
    private $PHOTO_PATH = "public/entity_logo";
    private $ICON_PATH = "public/entity_icon";
    private $IMAGE_TYPE = "jpg,jpeg,png";

    public function index(Request $request)
    {
        $includes = [];
        // if ($request->query('includeSupliers')) $includes[] = 'supliers';
        // if ($request->query('includeUsers')) $includes[] = 'users';
        // if ($request->query('includeClients')) $includes[] = 'clients';
        // if ($request->query('includeProducts')) $includes[] = 'products';
        // if ($request->query('includeLockers')) $includes[] = 'lockers';

        $data = Entity::with($includes)->get();
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
            "logo" => "file|mimes:" . $this->IMAGE_TYPE,
            "icon" => "file|mimes:" . $this->IMAGE_TYPE,
            "city" => "required|min:3|max:150",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:15",
            "cellphone" => "required|min:10|max:15",
            'email' => "required|email|unique:users,email",
            "tax" => 'required|numeric',

        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "logo.file" => "El campo logo debe ser un archivo",
            "logo.mimes" => "El campo logo debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
            "icon.file" => "El campo icono debe ser un archivo",
            "icon.mimes" => "El campo icono debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
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
            'tax.numeric' => 'El campo tax debe ser un número',

        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        $except = [];
        $field_file = [];

        // eliminamos el archivo anterior
        if ($request->file("logo")) {
            $field_file["logo"] = basename($request->file("logo")->store($this->PHOTO_PATH));
            $except[] = "logo";
        }

        if ($request->file("icon")) {
            $field_file["icon"] = basename($request->file("icon")->store($this->ICON_PATH));
            $except[] = "icon";
        }

        $data = Entity::create($request->except($except) + $field_file);

        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }


    public function find($name)
    {
        $entityName = $name;
        if (!$entityName) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "errors" => null,
                "data" => null
            ]);
        }

        $entity = Entity::where('name', 'like', '%' . $entityName . '%')->first();

        $includes = [];
        // if ($request->query('includeCategory')) $includes[] = 'category';
        // if ($request->query('includeProductCarts')) $includes[] = 'productCarts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $entity->load($includes),
        ]);
    }

    public function show(Request $request, Entity $entity)
    {
        $includes = [];
        // if ($request->query('includeCategory')) $includes[] = 'category';
        // if ($request->query('includeProductCarts')) $includes[] = 'productCarts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $entity->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Entity::find($id);
        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "logo" => "file|mimes:" . $this->IMAGE_TYPE,
            "icon" => "file|mimes:" . $this->IMAGE_TYPE,
            "city" => "required|min:3|max:150",
            "address" => "required|min:5|max:250",
            "phone" => "required|min:10|max:15",
            "cellphone" => "required|min:10|max:15",
            'email' => "required|email|unique:users,email",
            "tax" => 'required|numeric',

        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "logo.file" => "El campo logo debe ser un archivo",
            "logo.mimes" => "El campo logo debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
            "icon.file" => "El campo icono debe ser un archivo",
            "icon.mimes" => "El campo icono debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
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
            'tax.numeric' => 'El campo tax debe ser un número',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "errors" => $validator->errors(),
                "data" => null
            ]);
        }

        // if (Storage::exists($this->SIGNATURE_PATH . "/" . $user->signature)) Storage::delete($this->SIGNATURE_PATH . "/" . $user->signature);

        $except = [];
        $field_file = [];


        if ($request->file("logo")) {
            // eliminamos el archivo anterior
            if (Storage::exists($this->PHOTO_PATH . "/" . $product->logo)) Storage::delete($this->PHOTO_PATH . "/" . $product->logo);
            $field_file["logo"] = basename($request->file("logo")->store($this->PHOTO_PATH));
            $except[] = "logo";
        }

        if ($request->file("icon")) {
            if (Storage::exists($this->ICON_PATH . "/" . $product->icon)) Storage::delete($this->ICON_PATH . "/" . $product->icon);
            $field_file["icon"] = basename($request->file("icon")->store($this->ICON_PATH));
            $except[] = "icon";
        }

        // $data = Entity::create($request->except($except) + $field_file);
        $product->update($request->except($except) + $field_file);

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $product,
            "token" => null
        ]);
    }


    public function destroy(Entity $entity)
    {
        $entity->load(['products', 'users', 'clients', 'supliers', 'lockers']);
        if ($entity->products->count() > 0 || $entity->users->count() > 0 || $entity->clients->count() > 0 || $entity->supliers->count() > 0 || $entity->lockers->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }

        // eliminamos tambien el archivo
        if (Storage::exists($this->PHOTO_PATH . "/" . $entity->logo)) Storage::delete($this->PHOTO_PATH . "/" . $entity->logo);

        $entity->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $entity
        ]);
    }
}
