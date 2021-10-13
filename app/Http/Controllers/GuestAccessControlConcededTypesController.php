<?php

namespace App\Http\Controllers;

use App\Models\GuestAccessControlConcededType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestAccessControlConcededTypesController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Create Conceded Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Conceded Type
    |
    |    {
    |        "name" : "Operador",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Acceso Concedido creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Acceso Concedido recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "Operador",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:07:33.000000Z",
    |                    "updated_at": "2020-12-21T03:07:33.000000Z",
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
            $GuestAccessControlConcededType = GuestAccessControlConcededType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Acceso Concedido creado satisfactoriamente.",
                "data" => $this->getByID($GuestAccessControlConcededType->id)
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
    | Get All Conceded Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Conceded Types
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
    |                "name": "Operador",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-21T03:07:33.000000Z",
    |                "updated_at": "2020-12-21T03:07:33.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Barra Vehicular",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-21T03:09:03.000000Z",
    |                "updated_at": "2020-12-21T03:09:03.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $GuestAccessControlConcededTypes = GuestAccessControlConcededType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $GuestAccessControlConcededTypes
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
    | Get Conceded Types by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Conceded Types
    |   using the following parameter:
    |
    |   _______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                               |
    |  |-----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Conceded Types|
    |  |            |        |          | Example : 2                          |
    |  |____________|________|__________|______________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Acceso Concedido recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Barra Vehicular",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-21T03:09:03.000000Z",
    |            "updated_at": "2020-12-21T03:09:03.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $GuestAccessControlConcededType = GuestAccessControlConcededType::find($id);

            if (is_null($GuestAccessControlConcededType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Acceso Concedido no encontrado.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Acceso Concedido recuperado satisfactoriamente.",
                "data" => $GuestAccessControlConcededType
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
    | Update a Conceded Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Conceded Types
    |
    |    {
    |        "id" : 2,
    |        "name" : "Barra Vehicular Automática",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Acceso Concedido actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Acceso Concedido recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Barra Vehicular Automática",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:09:03.000000Z",
    |                    "updated_at": "2020-12-21T03:11:08.000000Z",
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
            $GuestAccessControlConcededType = GuestAccessControlConcededType::findOrFail($request->id);

            $GuestAccessControlConcededType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Acceso Concedido actualizado satisafactoriamente.",
                "data" => $this->getByID($GuestAccessControlConcededType->id)
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
    | Delete a Conceded Type
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Conceded Type
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Conceded     |
    |  |            |        |          | Types. Example : 3                  |
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
    |        "message": "Tipo de Acceso Concedido eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "name": "Type 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-21T03:12:01.000000Z",
    |            "updated_at": "2020-12-21T03:12:01.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $GuestAccessControlConcededType = GuestAccessControlConcededType::find($id);

            if (!is_null($GuestAccessControlConcededType)) {
                $GuestAccessControlConcededType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Acceso Concedido eliminado satisfactoriamente.",
                    "data" => $GuestAccessControlConcededType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Acceso Concedido no encontrada.",
                    "data" => $GuestAccessControlConcededType
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
    | Create or Update Guests Accesses Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Guests Accesses
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:guest_access_control_document_types',
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
