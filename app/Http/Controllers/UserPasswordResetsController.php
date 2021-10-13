<?php

namespace App\Http\Controllers;

use App\Models\UserPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPasswordResetsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create UserPasswordReset
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an UserPasswordReset
    |
    |   {
    |        "user_id" : 2,
    |        "token" : "093osdfjaskjlsfau450439580rdfhskajflsdf0934843098",
    |        "expired_at" : "2020-11-24 23:09:39"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Restablecimiento de Contraseña creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Restablecimiento de Contraseña recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "user_id": 2,
    |                        "token": "093osdfjaskjlsfau450439580rdfhskajflsdf0934843098",
    |                        "expired_at": "2020-11-24 23:09:39",
    |                        "created_at": "2020-12-14T19:28:35.000000Z",
    |                        "updated_at": "2020-12-14T19:28:35.000000Z",
    |                        "deleted_at": null,
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
            $UserPasswordReset = UserPasswordReset::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Restablecimiento de Contraseña creada satisfactoriamente.",
                "data" => $this->getByID($UserPasswordReset->id)
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
    | Get All User Password Resets
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all User Password Resets
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
    |                "user_id": 2,
    |                "token": "093osdfjaskjlsfau450439580rdfhskajflsdf0934843098",
    |                "expired_at": "2020-11-24 23:09:39",
    |                "created_at": "2020-12-14T19:28:35.000000Z",
    |                "updated_at": "2020-12-14T19:28:35.000000Z",
    |                "deleted_at": null,
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
    |            },
    |            {
    |                "id": 2,
    |                "user_id": 1,
    |                "token": "ryiquweyrqiueyrqiuweryqiuweryqiuweyrqiuweryqiuwery",
    |                "expired_at": "2020-11-24 23:09:39",
    |                "created_at": "2020-12-14T19:42:11.000000Z",
    |                "updated_at": "2020-12-14T19:42:11.000000Z",
    |                "deleted_at": null,
    |                "user": {
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $UserPasswordResets = UserPasswordReset::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $UserPasswordResets
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
    | Get UserPasswordReset by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific UserPasswordReset
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the UserPasswordReset    |
    |  |            |        |          | Example : 2                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Restablecimiento de Contraseña recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "user_id": 1,
    |                "token": "ryiquweyrqiueyrqiuweryqiuweryqiuweyrqiuweryqiuwery",
    |                "expired_at": "2020-11-24 23:09:39",
    |                "created_at": "2020-12-14T19:42:11.000000Z",
    |                "updated_at": "2020-12-14T19:42:11.000000Z",
    |                "deleted_at": null,
    |                "user": {
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $UserPasswordReset = UserPasswordReset::find($id);

            if (is_null($UserPasswordReset)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Restablecimiento de Contraseña no encontrada.",
                    "data" => $UserPasswordReset
                ]);
            } else {
                $UserPasswordReset = $UserPasswordReset
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Restablecimiento de Contraseña recuperada satisfactoriamente.",
                "data" => $UserPasswordReset
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
    | Update User Password Resets
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update User Password Resets
    |
    |   {
    |        "id" : 2,
    |        "user_id" : 1,
    |        "token" : "ryiquweyrqiueyrqiuweryqiuweryqiuasdfasdfasdfuwery",
    |        "expired_at" : "2020-11-24 23:09:39"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Restablecimiento de Contraseña actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Restablecimiento de Contraseña recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "user_id": 1,
    |                        "token": "ryiquweyrqiueyrqiuweryqiuweryqiuasdfasdfasdfuwery",
    |                        "expired_at": "2020-12-14 13:44:08",
    |                        "created_at": "2020-12-14T19:42:11.000000Z",
    |                        "updated_at": "2020-12-14T19:44:08.000000Z",
    |                        "deleted_at": null,
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
            $UserPasswordReset = UserPasswordReset::findOrFail($request->id);

            $UserPasswordReset->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Restablecimiento de Contraseña actualizada satisafactoriamente.",
                "data" => $this->getByID($UserPasswordReset->id)
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
    | Delete User Password Resets
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Password Reset
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the UserPasswordReset    |
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
    |        "message": "Restablecimiento de Contraseña eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "user_id": 1,
    |            "token": "ugy3uyg5yu3gyu3g5uyg3y4uyguyuyg5ygu45g645uyg5uy563",
    |            "expired_at": "2020-11-24 23:09:39",
    |            "created_at": "2020-12-14T19:45:42.000000Z",
    |            "updated_at": "2020-12-14T19:45:42.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserPasswordReset = UserPasswordReset::find($id);


            if (!is_null($UserPasswordReset)) {
                $UserPasswordReset->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Restablecimiento de Contraseña eliminada satisfactoriamente.",
                    "data" => $UserPasswordReset
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Restablecimiento de Contraseña no encontrada.",
                    "data" => $UserPasswordReset
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
    | Create or Update User Password Resets Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update User Password Resets
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'token' => 'required',
            'expired_at' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Usuario',
            'user_id.exists' => 'No existe el Usuario',
            'token' => 'Debe escribir un Token',
            'expired_at' => 'Debe seleccionar una Fecha de Expiración',
        ];
    }
}
