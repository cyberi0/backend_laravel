<?php

namespace App\Http\Controllers;

use App\Models\ComplexType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Complex Types
    |
    |   {
    |        "name" : "Akufen",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Complejo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Complejo recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Akufen",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T14:20:56.000000Z",
    |                    "updated_at": "2020-12-11T14:20:56.000000Z",
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
            $ComplexType = ComplexType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Complejo creado satisfactoriamente.",
                "data" => $this->getByID($ComplexType->id)
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
    | Get All Accounts
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Accounts
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
    |                "name": "Cluster",
    |                "description": "Lorem ipsum dolor",
    |                "created_at": "2020-11-24T23:09:39.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Vacations",
    |                "description": "Lorem ipsum dolor",
    |                "created_at": "2020-11-24T23:09:39.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Akufen",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T14:20:56.000000Z",
    |                "updated_at": "2020-12-11T14:20:56.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $ComplexTypes = ComplexType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexTypes
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
    | Get ComplexType by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific ComplexType
    |   using the following parameter:
    |
    |   _____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                             |
    |  |---------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Complex Type |
    |  |            |        |         | Example : 2                         |
    |  |____________|________|_________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Complejo recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Vacations",
    |            "description": "Lorem ipsum dolor",
    |            "created_at": "2020-11-24T23:09:39.000000Z",
    |            "updated_at": null,
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $ComplexType = ComplexType::find($id);

            if (is_null($ComplexType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Complejo no encontrado.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Complejo recuperado satisfactoriamente.",
                "data" => $ComplexType
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
    | Update a Complex Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex Type
    |
    |   {
    |        "id": 3,
    |        "name" : "Akufen Private",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Complejo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Complejo recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Akufen Private",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T14:20:56.000000Z",
    |                    "updated_at": "2020-12-11T14:26:20.000000Z",
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
            $ComplexType = ComplexType::findOrFail($request->id);

            $ComplexType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Complejo actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexType->id)
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
    | Delete a Complex Type
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Type
    |   using the following parameter:
    |
    |   _____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                            |
    |  |---------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex Type|
    |  |            |        |          | Example : 3                        |
    |  |            |        |          |                                    |
    |  |____________|________|__________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Complejo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "name": "Akufen Private",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-11T14:20:56.000000Z",
    |            "updated_at": "2020-12-11T14:26:20.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $ComplexType = ComplexType::find($id);

            if (!is_null($ComplexType)) {
                $ComplexType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Complejo eliminado satisfactoriamente.",
                    "data" => $ComplexType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Complejo no encontrada.",
                    "data" => $ComplexType
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
    | Create or Update Complex Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Complex Types
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:complex_types',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [

            'name.required' => 'Debe escribir un Nombre',
            'name.unique' => 'El Nombre ya existe',
            'description.required' => 'Debe escribir una Descripción',
        ];
    }
}
