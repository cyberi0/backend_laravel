<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an User
    |
    |   {
    |        "user_id" : 2,
    |        "type_id" : 2,
    |        "created_by" : 2,
    |        "names" : "Leonard",
    |        "surnames" : "Cohen",
    |        "username" : "l.cohen",
    |        "password" : "pas123",
    |        "email" : "development3@wobisoft.com",
    |        "mobile" : "2548963547",
    |        "curp" : "LOOC800210HVRPD02",
    |        "email_verified_at" : "2020-12-14 22:22:30"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Usuario creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Usuario recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 4,
    |                        "user_id": 2,
    |                        "type_id": 2,
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
    |                        "names": "Leonard",
    |                        "surnames": "Cohen",
    |                        "username": "l.cohen",
    |                        "email": "development3@wobisoft.com",
    |                        "mobile": "2548963547",
    |                        "curp": "LOOC800210HVRPD02",
    |                        "email_verified_at": "2020-12-14T22:22:30.000000Z",
    |                        "created_at": "2020-12-14T22:48:03.000000Z",
    |                        "updated_at": "2020-12-14T22:48:03.000000Z",
    |                        "deleted_at": null,
    |                        "user_type": {
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
    |                        "user": {
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
            $User = User::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Usuario creado satisfactoriamente.",
                "data" => $this->getByID($User->id)
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
    | Get All Users
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Users
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
    |                "user_id": null,
    |                "type_id": null,
    |                "created_by": null,
    |                "names": "Carlos",
    |                "surnames": "Laravel",
    |                "username": "develop2",
    |                "email": "develop2@wobisoft.com",
    |                "mobile": "9797968543",
    |                "curp": null,
    |                "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                "created_at": "2020-11-24T23:09:39.000000Z",
    |                "updated_at": "2020-11-24T23:09:39.000000Z",
    |                "deleted_at": null,
    |                "user_type": null,
    |                "user": null
    |            },
    |            {
    |                "id": 2,
    |                "user_id": null,
    |                "type_id": null,
    |                "created_by": null,
    |                "names": "Jorge",
    |                "surnames": "Laravel",
    |                "username": "develop1",
    |                "email": "develop1@wobisoft.com",
    |                "mobile": "9797968543",
    |                "curp": null,
    |                "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                "created_at": "2020-11-24T23:09:39.000000Z",
    |                "updated_at": "2020-11-24T23:09:39.000000Z",
    |                "deleted_at": null,
    |                "user_type": null,
    |                "user": null
    |            },
    |            {
    |                "id": 4,
    |                "user_id": 2,
    |                "type_id": 2,
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
    |                "names": "Leonard",
    |                "surnames": "Cohen",
    |                "username": "l.cohen",
    |                "email": "development3@wobisoft.com",
    |                "mobile": "2548963547",
    |                "curp": "LOOC800210HVRPD02",
    |                "email_verified_at": "2020-12-14T22:22:30.000000Z",
    |                "created_at": "2020-12-14T22:48:03.000000Z",
    |                "updated_at": "2020-12-14T22:48:03.000000Z",
    |                "deleted_at": null,
    |                "user_type": {
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
    |                "user": {
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $Users = User::with('created_by')
                ->with('user_type')
                ->with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Users
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
    | Get User by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the User    |
    |  |            |        |          | Example : 2                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Usuario recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 4,
    |                "user_id": 2,
    |                "type_id": 2,
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
    |                "names": "Leonard",
    |                "surnames": "Cohen",
    |                "username": "l.cohen",
    |                "email": "development3@wobisoft.com",
    |                "mobile": "2548963547",
    |                "curp": "LOOC800210HVRPD02",
    |                "email_verified_at": "2020-12-14T22:22:30.000000Z",
    |                "created_at": "2020-12-14T22:48:03.000000Z",
    |                "updated_at": "2020-12-14T22:48:03.000000Z",
    |                "deleted_at": null,
    |                "user_type": {
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
    |                "user": {
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $User = User::find($id);

            if (is_null($User)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Usuario no encontrado.",
                    "data" => $User
                ]);
            } else {
                $User = $User
                    ->with('created_by')
                    ->with('user_type')
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Usuario recuperada satisfactoriamente.",
                "data" => $User
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
    | Update an User
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an User
    |
    |   {
    |        "id" : 4,
    |        "user_id" : 1,
    |        "type_id" : 2,
    |        "created_by" : 1,
    |        "names" : "Leonard",
    |        "surnames" : "Cohen",
    |        "username" : "l.cohen",
    |        "password" : "pas123",
    |        "email" : "development3@wobisoft.com",
    |        "mobile" : "42342345668",
    |        "curp" : "LOOC800210HVRPD02",
    |        "email_verified_at" : "2020-12-14 22:22:30"
    |    }
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Usuario actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Usuario recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 4,
    |                        "user_id": 1,
    |                        "type_id": 2,
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
    |                        "names": "Leonard",
    |                        "surnames": "Cohen",
    |                        "username": "l.cohen",
    |                        "email": "development3@wobisoft.com",
    |                        "mobile": "42342345668",
    |                        "curp": "LOOC800210HVRPD02",
    |                        "email_verified_at": "2020-12-14T22:22:30.000000Z",
    |                        "created_at": "2020-12-14T22:48:03.000000Z",
    |                        "updated_at": "2020-12-14T22:52:36.000000Z",
    |                        "deleted_at": null,
    |                        "user_type": {
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
    |                        "user": {
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
            $User = User::findOrFail($request->id);

            $User->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Usuario actualizada satisafactoriamente.",
                "data" => $this->getByID($User->id)
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
    | Delete an User
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the User    |
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
    |        "message": "Usuario eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "user_id": 2,
    |            "type_id": 2,
    |            "created_by": 2,
    |            "names": "Leonard",
    |            "surnames": "Cohen",
    |            "username": "l.cohen",
    |            "email": "development3@wobisoft.com",
    |            "mobile": "2548963547",
    |            "curp": "LOOC800210HVRPD02",
    |            "email_verified_at": "2020-12-14T22:22:30.000000Z",
    |            "created_at": "2020-12-14T22:40:45.000000Z",
    |            "updated_at": "2020-12-14T22:40:45.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $User = User::find($id);


            if (!is_null($User)) {
                $User->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Usuario eliminado satisfactoriamente.",
                    "data" => $User
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Usuario no encontrado.",
                    "data" => $User
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
    | Create or Update Users Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Users
    |
    */
    public function getRules() {
        return [
            "user_id" => "required|exists:users,id",
            "type_id" => "required|exists:user_types,id",
            "created_by" => "required|exists:users,id",
            "names" => "required",
            "surnames" => "required",
            "username" => "required",
            "password" => "required",
            "email" => "required",
            "mobile" => "required",
            "email_verified_at" => "required"
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe seleccionar un Usuario.',
            'user_id.exists' => 'El Usuario no existe.',
            'type_id.required' => 'Debe seleccionar un Tipo de Usuario',
            'type_id.exists' => 'El Tipo de Usuario no existe.',
            'created_by.required' => 'Debe seleccionar un Creador.',
            'created_by.exists' => 'El Creador no existe.',
            'names' => 'Debe escribir Nombre(s)',
            'surnames' => 'Debe escribir Apellido(s)',
            'username' => 'Debe escribir un Nombre de Usuario',
            'password' => 'Debe escribir una Contraseña',
            'email' => 'Debe escribir un Correo Electrónico',
            'mobile' => 'Debe escribir un Número de Celular',
            'email_verified_at' => 'Debe seleccionar la Fecha de Verificación del Email',
        ];
    }
}
