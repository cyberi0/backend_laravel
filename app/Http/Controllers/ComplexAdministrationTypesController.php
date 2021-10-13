<?php

namespace App\Http\Controllers;

use App\Models\ComplexAdministrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexAdministrationTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Administration Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Complex Administration Type
    |
    |   {
    |       "name" : "Admin Type Two",
    |       "description" : "Lorem Ipsum Dolor"
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo Administración del Complejo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo Administración del Complejo recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Admin Type Two",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-09T22:29:29.000000Z",
    |                    "updated_at": "2020-12-09T22:29:29.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
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
            $ComplexAdministrationType = ComplexAdministrationType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo Administración del Complejo creado satisfactoriamente.",
                "data" => $this->getByID($ComplexAdministrationType->id)
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
    | Get All Complex Administration Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Administration Types
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
    |                "name": "Admin Type One",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-09T22:28:04.000000Z",
    |                "updated_at": "2020-12-09T22:28:04.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Admin Type Two",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-09T22:29:29.000000Z",
    |                "updated_at": "2020-12-09T22:29:29.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    */
    public function getAll() {
        try {
            $ComplexAdministrationTypes = ComplexAdministrationType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexAdministrationTypes
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
    | Get a Complex Administration Type by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Administration Type
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Administration Type Example : 2   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo Administración del Complejo recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Admin Type Two",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-09T22:29:29.000000Z",
    |            "updated_at": "2020-12-09T22:29:29.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function getByID($id) {
        try{
            $ComplexAdministrationType = ComplexAdministrationType::find($id);

            if (is_null($ComplexAdministrationType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo Administración del Complejo no encontrado.",
                    "data" => $ComplexAdministrationType
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo Administración del Complejo recuperada satisfactoriamente.",
                "data" => $ComplexAdministrationType
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
    | Update a Complex Administration Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex Administration Type
    |
    |   {
    |       "id" : 2,
    |       "name" : "Admin Type Twin Peaks",
    |       "description" : "Lorem Ipsum Dolor"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo Administración del Complejo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo Administración del Complejo recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Admin Type Twin Peaks",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-09T22:29:29.000000Z",
    |                    "updated_at": "2020-12-09T22:35:42.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
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
            $ComplexAdministrationType = ComplexAdministrationType::findOrFail($request->id);

            $ComplexAdministrationType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo Administración del Complejo actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexAdministrationType->id)
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
    | Delete a Complex Administration Type
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Administration Type
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | AdministrationType  Example : 1   |
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
    |        "message": "Tipo Administración del Complejo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "name": "Admin Type One",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-09T22:28:04.000000Z",
    |            "updated_at": "2020-12-09T22:28:04.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($type_id)
    {
        try {
            $ComplexAdministrationType = ComplexAdministrationType::find($type_id);


            if (!is_null($ComplexAdministrationType)) {
                $ComplexAdministrationType->destroy($type_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo Administración del Complejo eliminado satisfactoriamente.",
                    "data" => $ComplexAdministrationType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo Administración del Complejo no encontrado.",
                    "data" => $ComplexAdministrationType
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
    | Create or Update Complex Administration Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Complex Administration Type
    |
    */
    public function getRules() {
        return [
            'name' => 'required',
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
