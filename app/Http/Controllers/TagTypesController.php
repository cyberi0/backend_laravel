<?php

namespace App\Http\Controllers;

use App\Models\TagType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Tag Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Tag Types
    |
    |   {
            "name" : "Massive Attack",
            "description" : "Lorem Ipsum Dolor"
        }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
            "response": "success",
            "message": "Tipo de Etiqueta creada satisfactoriamente.",
            "data": {
                "headers": {},
                "original": {
                    "response": "success",
                    "message": "Tipo de Etiqueta recuperada satisfactoriamente.",
                    "data": {
                        "id": 1,
                        "name": "Massive Attack",
                        "description": "Lorem Ipsum Dolor",
                        "created_at": "2020-12-12T19:28:23.000000Z",
                        "updated_at": "2020-12-12T19:28:23.000000Z",
                        "deleted_at": null
                    }
                },
                "exception": null
            }
        }
    */
    public function create(Request $request) {
        $input = $request->all();
        $validatedData = Validator::make($request->all(), $this->getRules(), $this->getMessages());

        if ($validatedData->fails()) {
            return response()->json([
                "response" => "error",
                "message" => $validatedData->errors()->first(),
                "code" => 400
            ]);
        }

        try {
            $TagType = TagType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Etiqueta creada satisfactoriamente.",
                "data" => $this->getByID($TagType->id)
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "response" => "error",
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Get All Tag Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Tag Types
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
        {
            "response": "success",
            "message": "Lista recuperada satisfactoriamente.",
            "data": [
                {
                    "id": 1,
                    "name": "Massive Attack",
                    "description": "Lorem Ipsum Dolor",
                    "created_at": "2020-12-12T19:28:23.000000Z",
                    "updated_at": "2020-12-12T19:28:23.000000Z",
                    "deleted_at": null
                },
                {
                    "id": 2,
                    "name": "Depeche Mode",
                    "description": "Lorem Ipsum Dolor",
                    "created_at": "2020-12-12T19:29:12.000000Z",
                    "updated_at": "2020-12-12T19:29:12.000000Z",
                    "deleted_at": null
                }
            ]
        }
    */
    public function getAll() {
        try {
            $TagTypes = TagType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $TagTypes
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "response" => "error",
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Get Tag Type by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific TagType
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Tag Type   |
    |  |            |        |          | Example : 2                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
            "response": "success",
            "message": "Tipo de Etiqueta recuperada satisfactoriamente.",
            "data": {
                "id": 2,
                "name": "Depeche Mode",
                "description": "Lorem Ipsum Dolor",
                "created_at": "2020-12-12T19:29:12.000000Z",
                "updated_at": "2020-12-12T19:29:12.000000Z",
                "deleted_at": null
            }
        }
    */
    public function getByID($id) {
        try{
            $TagType = TagType::find($id);

            if (is_null($TagType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Etiqueta no encontrada.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Etiqueta recuperada satisfactoriamente.",
                "data" => $TagType
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "response" => "error",
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update Tag Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Tag Type
    |
    |   {
            "id" : 2,
            "name" : "Depeche Mode Sync",
            "description" : "Lorem Ipsum Dolor"
        }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
        {
            "response": "success",
            "message": "Tipo de Etiqueta actualizada satisafactoriamente.",
            "data": {
                "headers": {},
                "original": {
                    "response": "success",
                    "message": "Tipo de Etiqueta recuperada satisfactoriamente.",
                    "data": {
                        "id": 2,
                        "name": "Depeche Mode Sync",
                        "description": "Lorem Ipsum Dolor",
                        "created_at": "2020-12-12T19:29:12.000000Z",
                        "updated_at": "2020-12-12T19:31:28.000000Z",
                        "deleted_at": null
                    }
                },
                "exception": null
            }
        }
    */
    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), $this->getRules(), $this->getMessages());
        if ($validatedData->fails()) {
            return response()->json([
                "response" => "error",
                "message" => $validatedData->errors()->first(),
                "code" => 400
            ]);
        }

        try {
            $input = $request->all();
            $TagType = TagType::findOrFail($request->id);

            $TagType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Etiqueta actualizada satisafactoriamente.",
                "data" => $this->getByID($TagType->id)
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "response" => "error",
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Tag Types
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Tag Type
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Tag Type   |
    |  |            |        |          | Example : 3                       |
    |  |            |        |          |                                   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Etiqueta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "name": "Tag 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T19:33:22.000000Z",
    |            "updated_at": "2020-12-12T19:33:22.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $TagType = TagType::find($id);

            if (!is_null($TagType)) {
                $TagType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Etiqueta eliminada satisfactoriamente.",
                    "data" => $TagType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Etiqueta no encontrada.",
                    "data" => $TagType
                ]);
            }

        } catch (\Exception $e) {
            return response()->json(
                [
                    "response" => "error",
                    "message" => $e->getMessage()
                ]
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Create or Update Tag Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Tag Types
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:tag_types',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre',
            'description.required' => 'Debe escribir una Descripción',
        ];
    }
}
