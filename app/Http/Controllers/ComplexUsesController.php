<?php

namespace App\Http\Controllers;

use App\Models\ComplexUse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexUsesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Uses
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Complex Uses
    |
    |   {
    |        "name" : "Before Party",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Uso del Complejo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Uso del Complejo recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Before Party",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T15:28:32.000000Z",
    |                    "updated_at": "2020-12-11T15:28:32.000000Z",
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
            $ComplexUse = ComplexUse::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Uso del Complejo creado satisfactoriamente.",
                "data" => $this->getByID($ComplexUse->id)
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
    | Get All Complex Uses
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Uses
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
    |                "name": "Vacations",
    |                "description": "Lorem Ipsum dolor",
    |                "created_at": "2020-11-24T23:09:39.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "After Party",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T15:27:10.000000Z",
    |                "updated_at": "2020-12-11T15:27:10.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Before Party",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T15:28:32.000000Z",
    |                "updated_at": "2020-12-11T15:28:32.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $ComplexUses = ComplexUse::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexUses
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
    | Get Complex Uses by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Uses
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    |Indicate the ID of the Complex Uses|
    |  |            |        |          |Example : 2                        |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Uso del Complejo recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "After Party",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-11T15:27:10.000000Z",
    |            "updated_at": "2020-12-11T15:27:10.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $ComplexUse = ComplexUse::find($id);

            if (is_null($ComplexUse)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Uso del Complejo no encontrado.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Uso del Complejo recuperado satisfactoriamente.",
                "data" => $ComplexUse
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
    | Update a Complex Use
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex Use
    |
    |   {
    |       "id" : 1,
    |       "name" : "Hollidays",
    |       "description" : "Lorem Ipsum Dolor"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Uso del Complejo actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Uso del Complejo recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "Hollidays",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-12-11T15:31:53.000000Z",
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
            $ComplexUse = ComplexUse::findOrFail($request->id);

            $ComplexUse->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Uso del Complejo actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexUse->id)
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
    | Delete a Complex Uses
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Uses
    |   using the following parameter:
    |
    |   _____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                            |
    |  |---------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex Uses|
    |  |            |        |          | Example : 4                        |
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
    |        "message": "Uso del Complejo eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "name": "Use 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-11T15:33:14.000000Z",
    |            "updated_at": "2020-12-11T15:33:14.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $ComplexUse = ComplexUse::find($id);


            if (!is_null($ComplexUse)) {
                $ComplexUse->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Uso del Complejo eliminada satisfactoriamente.",
                    "data" => $ComplexUse
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Uso del Complejo no encontrada.",
                    "data" => $ComplexUse
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
    | Create or Update Complex Uses Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Complex Uses
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
