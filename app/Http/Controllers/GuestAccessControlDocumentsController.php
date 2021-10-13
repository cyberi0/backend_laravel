<?php

namespace App\Http\Controllers;

use App\Models\GuestAccessControlDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestAccessControlDocumentsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Guest Documents
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Guest Document
    |
    |    {
    |        "guest_id" : 1,
    |        "identification" : "./perfil.png",
    |        "type_id" : 2,
    |        "created_by" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Documento del Invitado creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Documento del Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "guest_id": 1,
    |                        "type_id": 2,
    |                        "identification": "./perfil.png",
    |                        "created_by": {
    |                            "id": 1,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Carlos",
    |                            "surnames": "Laravel",
    |                            "username": "develop2",
    |                            "email": "develop2@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "deleted_at": null,
    |                        "created_at": "2020-12-21T03:47:45.000000Z",
    |                        "updated_at": "2020-12-21T03:47:45.000000Z",
    |                        "guest": {
    |                            "id": 1,
    |                            "uuid": "123456789123456789",
    |                            "names": "Cyberio",
    |                            "surnames": "Lopez",
    |                            "email": "development2@wobosoft.com",
    |                            "mobile": "9841360125",
    |                            "created_by": 1,
    |                            "created_at": "2020-12-20T07:40:21.000000Z",
    |                            "updated_at": "2020-12-20T07:40:21.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "document_type": {
    |                            "id": 2,
    |                            "name": "Foto Invitado",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-21T03:17:28.000000Z",
    |                            "updated_at": "2020-12-21T03:17:28.000000Z",
    |                            "deleted_at": null
    |                        }
    |                    }
    |                ]
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
            $GuestAccessControlDocument = GuestAccessControlDocument::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Documento del Invitado creado satisfactoriamente.",
                "data" => $this->getByID($GuestAccessControlDocument->id)
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
    | Get All Guests Documents
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Guests Documents
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
    |                "guest_id": 1,
    |                "type_id": 2,
    |                "identification": "./perfil.png",
    |                "created_by": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "deleted_at": null,
    |                "created_at": "2020-12-21T03:47:45.000000Z",
    |                "updated_at": "2020-12-21T03:47:45.000000Z",
    |                "guest": {
    |                    "id": 1,
    |                    "uuid": "123456789123456789",
    |                    "names": "Cyberio",
    |                    "surnames": "Lopez",
    |                    "email": "development2@wobosoft.com",
    |                    "mobile": "9841360125",
    |                    "created_by": 1,
    |                    "created_at": "2020-12-20T07:40:21.000000Z",
    |                    "updated_at": "2020-12-20T07:40:21.000000Z",
    |                    "deleted_at": null
    |                },
    |                "document_type": {
    |                    "id": 2,
    |                    "name": "Foto Invitado",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:17:28.000000Z",
    |                    "updated_at": "2020-12-21T03:17:28.000000Z",
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $GuestAccessControlDocuments = GuestAccessControlDocument::with('guest')
                ->with('document_type')
                ->with('created_by')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $GuestAccessControlDocuments
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
    | Get Guest Documents by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Guest Documents
    |   using the following parameter:
    |
    |   _______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                               |
    |  |-----------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Guest Documents|
    |  |            |        |         | Example : 2                           |
    |  |____________|________|_________|_______________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Documento del Invitado recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "guest_id": 1,
    |                "type_id": 2,
    |                "identification": "./perfil.png",
    |                "created_by": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "deleted_at": null,
    |                "created_at": "2020-12-21T03:47:45.000000Z",
    |                "updated_at": "2020-12-21T03:47:45.000000Z",
    |                "guest": {
    |                    "id": 1,
    |                    "uuid": "123456789123456789",
    |                    "names": "Cyberio",
    |                    "surnames": "Lopez",
    |                    "email": "development2@wobosoft.com",
    |                    "mobile": "9841360125",
    |                    "created_by": 1,
    |                    "created_at": "2020-12-20T07:40:21.000000Z",
    |                    "updated_at": "2020-12-20T07:40:21.000000Z",
    |                    "deleted_at": null
    |                },
    |                "document_type": {
    |                    "id": 2,
    |                    "name": "Foto Invitado",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:17:28.000000Z",
    |                    "updated_at": "2020-12-21T03:17:28.000000Z",
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $GuestAccessControlDocument = GuestAccessControlDocument::find($id);

            if (is_null($GuestAccessControlDocument)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Documento del Invitado no encontrado.",
                ]);
            } else {
                $GuestAccessControlDocument = $GuestAccessControlDocument
                    ->with('guest')
                    ->with('document_type')
                    ->with('created_by')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Documento del Invitado recuperado satisfactoriamente.",
                "data" => $GuestAccessControlDocument
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
    | Update a Guest Document
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Guest Document
    |
    |    {
    |        "id" : 1,
    |        "guest_id" : 1,
    |        "identification" : "./perfil_invitado.png",
    |        "type_id" : 2,
    |        "created_by" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    |    {
    |        "response": "success",
    |        "message": "Documento del Invitado actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Documento del Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "guest_id": 1,
    |                        "type_id": 2,
    |                        "identification": "./perfil_invitado.png",
    |                        "created_by": {
    |                            "id": 1,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Carlos",
    |                            "surnames": "Laravel",
    |                            "username": "develop2",
    |                            "email": "develop2@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "deleted_at": null,
    |                        "created_at": "2020-12-21T03:47:45.000000Z",
    |                        "updated_at": "2020-12-21T04:18:22.000000Z",
    |                        "guest": {
    |                            "id": 1,
    |                            "uuid": "123456789123456789",
    |                            "names": "Cyberio",
    |                            "surnames": "Lopez",
    |                            "email": "development2@wobosoft.com",
    |                            "mobile": "9841360125",
    |                            "created_by": 1,
    |                            "created_at": "2020-12-20T07:40:21.000000Z",
    |                            "updated_at": "2020-12-20T07:40:21.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "document_type": {
    |                            "id": 2,
    |                            "name": "Foto Invitado",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-21T03:17:28.000000Z",
    |                            "updated_at": "2020-12-21T03:17:28.000000Z",
    |                            "deleted_at": null
    |                        }
    |                    }
    |                ]
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
            $GuestAccessControlDocument = GuestAccessControlDocument::findOrFail($request->id);

            $GuestAccessControlDocument->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Documento del Invitado actualizado satisafactoriamente.",
                "data" => $this->getByID($GuestAccessControlDocument->id)
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
    | Delete a Guest Document
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Guest Document
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Guest        |
    |  |            |        |          | Documents. Example : 3              |
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
    |        "message": "Documento del Invitado eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "guest_id": 1,
    |            "type_id": 2,
    |            "identification": "./delete.png",
    |            "created_by": 2,
    |            "deleted_at": null,
    |            "created_at": "2020-12-21T04:19:02.000000Z",
    |            "updated_at": "2020-12-21T04:19:02.000000Z"
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $GuestAccessControlDocument = GuestAccessControlDocument::find($id);

            if (!is_null($GuestAccessControlDocument)) {
                $GuestAccessControlDocument->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Documento del Invitado eliminado satisfactoriamente.",
                    "data" => $GuestAccessControlDocument
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Documento del Invitado no encontrado.",
                    "data" => $GuestAccessControlDocument
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
    | Create or Update Guests Documents Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Guests Documents
    |
    */
    public function getRules() {
        return [
            "guest_id" => "required|exists:guests,id",
            "identification" => "required",
            "type_id" => "required|exists:guest_access_control_document_types,id",
            "created_by" => "required|exists:users,id"
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
