<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Property Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Property Type
    |
    |   {
    |        "name" : "Sonic Youth",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Propiedad creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Propiedad recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Sonic Youth",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-12T18:27:46.000000Z",
    |                    "updated_at": "2020-12-12T18:27:46.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
    |
    |
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
            $PropertyType = PropertyType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Propiedad creada satisfactoriamente.",
                "data" => $this->getByID($PropertyType->id)
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
    | Get All Property Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Property Types
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Lista recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "name": "Vacational",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T19:59:32.000000Z",
    |                "updated_at": "2020-12-11T19:59:32.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Sonic Youth",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-12T18:27:46.000000Z",
    |                "updated_at": "2020-12-12T18:27:46.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Migala",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-12T18:29:36.000000Z",
    |                "updated_at": "2020-12-12T18:29:36.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $PropertyTypes = PropertyType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $PropertyTypes
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
    | Get Property Types by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Property Types
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                              |
    |  |----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Property Type|
    |  |            |        |          | Example : 3                         |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Propiedad recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Sonic Youth",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T18:27:46.000000Z",
    |            "updated_at": "2020-12-12T18:27:46.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $PropertyType = PropertyType::find($id);

            if (is_null($PropertyType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Propiedad no encontrada.",
                ]);
            }
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Propiedad recuperada satisfactoriamente.",
                "data" => $PropertyType
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
    | Update Property Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Property Type
    |
    |   {
    |        "id" : 3,
    |        "name" : "Migala II",
    |        "description" : "Lorem Ipsum Dolor"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Propiedad actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Propiedad recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Migala II",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-12T18:29:36.000000Z",
    |                    "updated_at": "2020-12-12T18:34:49.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
    |
    |
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
            $PropertyType = PropertyType::findOrFail($request->id);

            $PropertyType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Propiedad actualizada satisafactoriamente.",
                "data" => $this->getByID($PropertyType->id)
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
    | Delete PropertyType
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Property Type
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Property Type|
    |  |            |        |          | Example : 4                         |
    |  |            |        |          |                                     |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Propiedad eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "name": "Type 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T18:36:20.000000Z",
    |            "updated_at": "2020-12-12T18:36:20.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $PropertyType = PropertyType::find($id);

            if (!is_null($PropertyType)) {
                $PropertyType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Propiedad eliminada satisfactoriamente.",
                    "data" => $PropertyType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Propiedad no encontrada.",
                    "data" => $PropertyType
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
    | Create or Update Property Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Property Types
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:property_types',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre',
            'name.unique' => 'El Nombre ya esiste',
            'description.required' => 'Debe escribir una Descripción',
        ];
    }
}
