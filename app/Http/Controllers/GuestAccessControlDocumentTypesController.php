<?php

namespace App\Http\Controllers;

use App\Models\GuestAccessControlDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestAccessControlDocumentTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Document Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Document Type
    |
    |    {
    |        "name" : "INE",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Documento creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Documento recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "INE",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:15:55.000000Z",
    |                    "updated_at": "2020-12-21T03:15:55.000000Z",
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
            $GuestAccessControlDocumentType = GuestAccessControlDocumentType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Documento creado satisfactoriamente.",
                "data" => $this->getByID($GuestAccessControlDocumentType->id)
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
    | Get All Document Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Document Types
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
    |                "name": "INE",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-21T03:15:55.000000Z",
    |                "updated_at": "2020-12-21T03:15:55.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Foto Invitado",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-21T03:17:28.000000Z",
    |                "updated_at": "2020-12-21T03:17:28.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Placa Vehicular",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-21T03:19:47.000000Z",
    |                "updated_at": "2020-12-21T03:19:47.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $GuestAccessControlDocumentTypes = GuestAccessControlDocumentType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $GuestAccessControlDocumentTypes
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
    | Get Document Type by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Document Type
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                              |
    |  |----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Document Type|
    |  |            |        |          | Example : 2                         |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Documento recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Foto Invitado",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-21T03:17:28.000000Z",
    |            "updated_at": "2020-12-21T03:17:28.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $GuestAccessControlDocumentType = GuestAccessControlDocumentType::find($id);

            if (is_null($GuestAccessControlDocumentType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Documento no encontrado.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Documento recuperado satisfactoriamente.",
                "data" => $GuestAccessControlDocumentType
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
    | Update a Document Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Document Type
    |
    |    {
    |        "id" : 1,
    |        "name" : "I.N.E",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Documento actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Documento recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "I.N.E",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:15:55.000000Z",
    |                    "updated_at": "2020-12-21T03:22:20.000000Z",
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
            $GuestAccessControlDocumentType = GuestAccessControlDocumentType::findOrFail($request->id);

            $GuestAccessControlDocumentType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Documento actualizado satisafactoriamente.",
                "data" => $this->getByID($GuestAccessControlDocumentType->id)
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
    | Delete a Document Type
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Document Type
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Document Type|
    |  |            |        |          | Example : 3                         |
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
    |        "message": "Tipo de Documento eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "name": "Placa Vehicular",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-21T03:19:47.000000Z",
    |            "updated_at": "2020-12-21T03:19:47.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $GuestAccessControlDocumentType = GuestAccessControlDocumentType::find($id);

            if (!is_null($GuestAccessControlDocumentType)) {
                $GuestAccessControlDocumentType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Documento eliminado satisfactoriamente.",
                    "data" => $GuestAccessControlDocumentType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Documento no encontrada.",
                    "data" => $GuestAccessControlDocumentType
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
