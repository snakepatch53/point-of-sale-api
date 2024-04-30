<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    private $PHOTO_PATH = "public/img_users";
    private $IMAGE_TYPE = "jpg,jpeg,png";

    public function index(Request $request)
    {
        $includes = [];
        if ($request->query('includeProductIns')) $includes[] = 'productIns';
        if ($request->query('includeProductOuts')) $includes[] = 'productOuts';

        $data = Product::with($includes)->get();
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
            "code" => "required|min:3|max:150",
            "mark" => "required|min:3|max:150",
            "model" => "required|min:3|max:150",
            "elaboration" => "required|min:3|max:150",
            "expiration" => "required|min:3|max:150",
            'description' => 'required|min:10',
            "photo" => "file|mimes:" . $this->IMAGE_TYPE,
            "locker_id" => "required|exists:lockers,id"

        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "code.required" => "El campo codigo es requerido",
            "code.min" => "El campo codigo debe tener al menos 3 caracteres",
            "code.max" => "El campo codigo debe tener como máximo 150 caracteres",
            "mark.required" => "El campo marca es requerido",
            "mark.min" => "El campo marca debe tener al menos 3 caracteres",
            "mark.max" => "El campo marca debe tener como máximo 150 caracteres",
            "model.required" => "El campo modelo es requerido",
            "model.min" => "El campo modelo debe tener al menos 3 caracteres",
            "model.max" => "El campo modelo debe tener como máximo 150 caracteres",
            "elaboration.required" => "El campo elaboración es requerido",
            "elaboration.min" => "El campo elaboración debe tener al menos 3 caracteres",
            "elaboration.max" => "El campo elaboración debe tener como máximo 150 caracteres",
            "expiration.required" => "El campo expiración es requerido",
            "expiration.min" => "El campo expiración debe tener al menos 3 caracteres",
            "expiration.max" => "El campo expiración debe tener como máximo 150 caracteres",
            'description.required' => 'El campo descripción es requerido',
            'description.min' => 'El campo descripción debe tener al menos 10 caracteres',
            "photo.file" => "El campo foto debe ser un archivo",
            "photo.mimes" => "El campo foto debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
            "locker_id.required" => "El campo bodega es requerido",
            "locker_id.exists" => "La bodega no existe"

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
            $fileName_photo = basename($request->file("photo")->store($this->PHOTO_PATH));
            $request = new Request($request->except(["photo"]) + ["photo" => $fileName_photo]);
        }

        $data = Product::create($request->all());


        return response()->json([
            "success" => true,
            "message" => "Recurso creado",
            "errors" => null,
            "data" => $data,
        ]);
    }


    public function show(Request $request, Product $product)
    {
        $includes = [];
        // if ($request->query('includeCategory')) $includes[] = 'category';
        // if ($request->query('includeProductCarts')) $includes[] = 'productCarts';

        return response()->json([
            "success" => true,
            "message" => "Recurso encontrado",
            "errors" => null,
            "data" => $product->load($includes),
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Recurso no encontrado",
                "data" => null
            ]);
        }

        $validator = Validator::make($request->all(),  [
            "name" => "required|min:3|max:150",
            "code" => "required|min:3|max:150",
            "mark" => "required|min:3|max:150",
            "model" => "required|min:3|max:150",
            "elaboration" => "required|min:3|max:150",
            "expiration" => "required|min:3|max:150",
            'description' => 'required|min:10',
            "photo" => "file|mimes:" . $this->IMAGE_TYPE,
            "locker_id" => "required|exists:lockers,id"

        ], [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El campo nombre debe tener al menos 3 caracteres",
            "name.max" => "El campo nombre debe tener como máximo 150 caracteres",
            "code.required" => "El campo codigo es requerido",
            "code.min" => "El campo codigo debe tener al menos 3 caracteres",
            "code.max" => "El campo codigo debe tener como máximo 150 caracteres",
            "mark.required" => "El campo marca es requerido",
            "mark.min" => "El campo marca debe tener al menos 3 caracteres",
            "mark.max" => "El campo marca debe tener como máximo 150 caracteres",
            "model.required" => "El campo modelo es requerido",
            "model.min" => "El campo modelo debe tener al menos 3 caracteres",
            "model.max" => "El campo modelo debe tener como máximo 150 caracteres",
            "elaboration.required" => "El campo elaboración es requerido",
            "elaboration.min" => "El campo elaboración debe tener al menos 3 caracteres",
            "elaboration.max" => "El campo elaboración debe tener como máximo 150 caracteres",
            "expiration.required" => "El campo expiración es requerido",
            "expiration.min" => "El campo expiración debe tener al menos 3 caracteres",
            "expiration.max" => "El campo expiración debe tener como máximo 150 caracteres",
            'description.required' => 'El campo descripción es requerido',
            'description.min' => 'El campo descripción debe tener al menos 10 caracteres',
            "photo.file" => "El campo foto debe ser un archivo",
            "photo.mimes" => "El campo foto debe ser un archivo de tipo: " . $this->IMAGE_TYPE,
            "locker_id.required" => "El campo bodega es requerido",
            "locker_id.exists" => "La bodega no existe"

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
            $fileName_photo = basename($request->file("photo")->store($this->PHOTO_PATH));
            $request = new Request($request->except(["photo"]) + ["photo" => $fileName_photo]);
            if (Storage::exists($this->PHOTO_PATH . "/" . $product->photo)) Storage::delete($this->PHOTO_PATH . "/" . $product->photo);
        }

        $product->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Recurso actualizado",
            "errors" => null,
            "data" => $product,
            "token" => null
        ]);
    }


    public function destroy(Product $product)
    {
        $product->load(['productIns', 'productOuts']);
        if ($product->productIns->count() > 0 || $product->productOuts->count() > 0) {
            return response()->json([
                "success" => false,
                "message" => "No se puede eliminar el recurso, tiene otros recursos asociados",
                "data" => null
            ]);
        }

        // eliminamos tambien el archivo
        if (Storage::exists($this->PHOTO_PATH . "/" . $product->photo)) Storage::delete($this->PHOTO_PATH . "/" . $product->photo);

        $product->delete();

        return response()->json([
            "success" => true,
            "message" => "Recurso eliminado",
            "errors" => null,
            "data" => $product
        ]);
    }
}
