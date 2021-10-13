<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Guests
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Guest
    |
    |
    |    {
    |        "uuid" : "987654321123456789",
    |        "names" : "Grinderman",
    |        "surnames" : "Bad Seeds",
    |        "email" : "guest@wobosoft.com",
    |        "mobile": "8954256321",
    |        "created_by" : 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "uuid": "123456789123456789",
    |                        "names": "Cyberio",
    |                        "surnames": "Lopez",
    |                        "email": "development2@wobosoft.com",
    |                        "mobile": "9841360125",
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
    |                        "created_at": "2020-12-20T07:40:21.000000Z",
    |                        "updated_at": "2020-12-20T07:40:21.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    {
    |                        "id": 2,
    |                        "uuid": "987654321123456789",
    |                        "names": "Grinderman",
    |                        "surnames": "Bad Seeds",
    |                        "email": "guest@wobosoft.com",
    |                        "mobile": "8954256321",
    |                        "created_by": {
    |                            "id": 2,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Jorge",
    |                            "surnames": "Laravel",
    |                            "username": "develop1",
    |                            "email": "develop1@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "created_at": "2020-12-20T07:45:42.000000Z",
    |                        "updated_at": "2020-12-20T07:45:42.000000Z",
    |                        "deleted_at": null
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
            $Guest = Guest::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Invitado creado satisfactoriamente.",
                "data" => $this->getByID($Guest->id)
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
    | Get All Guests
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Guests
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    |    {
    |        "response": "success",
    |        "message": "Lista recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "uuid": "123456789123456789",
    |                "names": "Cyberio",
    |                "surnames": "Lopez",
    |                "email": "development2@wobosoft.com",
    |                "mobile": "9841360125",
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
    |                "created_at": "2020-12-20T07:40:21.000000Z",
    |                "updated_at": "2020-12-20T07:40:21.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "uuid": "987654321123456789",
    |                "names": "Grinderman",
    |                "surnames": "Bad Seeds",
    |                "email": "guest@wobosoft.com",
    |                "mobile": "8954256321",
    |                "created_by": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "created_at": "2020-12-20T07:45:42.000000Z",
    |                "updated_at": "2020-12-20T07:45:42.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $Guests = Guest::with("created_by")->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Guests
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
    | Get Guest by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Guest
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                              |
    |  |----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Guest        |
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
    |        "message": "Invitado recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "uuid": "123456789123456789",
    |                "names": "Cyberio",
    |                "surnames": "Lopez",
    |                "email": "development2@wobosoft.com",
    |                "mobile": "9841360125",
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
    |                "created_at": "2020-12-20T07:40:21.000000Z",
    |                "updated_at": "2020-12-20T07:40:21.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "uuid": "987654321123456789",
    |                "names": "Grinderman",
    |                "surnames": "Bad Seeds",
    |                "email": "guest@wobosoft.com",
    |                "mobile": "8954256321",
    |                "created_by": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "created_at": "2020-12-20T07:45:42.000000Z",
    |                "updated_at": "2020-12-20T07:45:42.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $Guest = Guest::find($id);

            if (is_null($Guest)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Invitado no encontrado.",
                ]);
            } else {
                $Guest = $Guest
                    ->with('created_by')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Invitado recuperado satisfactoriamente.",
                "data" => $Guest
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
    | Update a Guest
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Guest
    |
    |    {
    |        "id" : "4",
    |        "uuid" : "111111111111111111",
    |        "names" : "Polly",
    |        "surnames" : "Jean H.",
    |        "email" : "guest2@wobosoft.com",
    |        "mobile": "8521436795",
    |        "created_by" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 4,
    |                        "uuid": "111111111111111111",
    |                        "names": "Polly",
    |                        "surnames": "Jean H.",
    |                        "email": "guest2@wobosoft.com",
    |                        "mobile": "8521436795",
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
    |                        "created_at": "2020-12-20T08:00:35.000000Z",
    |                        "updated_at": "2020-12-20T08:01:46.000000Z",
    |                        "deleted_at": null
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
            $Guest = Guest::findOrFail($request->id);

            $Guest->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Invitado actualizado satisafactoriamente.",
                "data" => $this->getByID($Guest->id)
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
    | Delete a Guest
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Guest
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Guest |
    |  |            |        |          | Example : 3                         |
    |  |            |        |          |                                     |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "uuid": "111111111111111111",
    |            "names": "Polly",
    |            "surnames": "Jean H.",
    |            "email": "guest2@wobosoft.com",
    |            "mobile": "8521436795",
    |            "created_by": 1,
    |            "created_at": "2020-12-20T08:00:35.000000Z",
    |            "updated_at": "2020-12-20T08:01:46.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $Guest = Guest::find($id);


            if (!is_null($Guest)) {
                $Guest->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Invitado eliminado satisfactoriamente.",
                    "data" => $Guest
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Invitado no encontrado.",
                    "data" => $Guest
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
            "uuid" => "required|size:18|unique:guests",
            "names" => "required",
            "surnames" => "required",
            "email" => "required",
            "mobile" => "required",
            "created_by" => "required|exists:users,id",

        ];
    }

    public function getMessages() {
        return [
            'uuid.required' => 'Debe escribirun UUID.',
            'uuid.unique' => 'El UUID ya existe.',
            'uuid.size' => 'El UUID debe ser de 18 caracteres.',
            'names' => 'Debe escribir Nombre(s)',
            'surnames' => 'Debe escribir Apellido(s)',
            'email' => 'Debe escribir un Correo Electrónico',
            'mobile' => 'Debe escribir un Número de Celular',
            'created_by.required' => 'Debe seleccionar un Creador.',
            'created_by.exists' => 'El Creador no existe.',
        ];
    }
}
