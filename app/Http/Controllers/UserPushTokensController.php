<?php

namespace App\Http\Controllers;

use App\Models\UserPushToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPushTokensController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User Push Tokens
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create User Push Tokens
    |
    |   {
    |        "user_id": 1,
    |        "uuid" : "WGERGWER64546",
    |        "token" : "et45646sgsdgsrt45645"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Token creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Token recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "user_id": 1,
    |                        "uuid": "WGERGWER64546",
    |                        "token": "et45646sgsdgsrt45645",
    |                        "created_at": "2020-12-14T21:00:07.000000Z",
    |                        "updated_at": "2020-12-14T21:00:07.000000Z",
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
            $UserPushToken = UserPushToken::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Token creado satisfactoriamente.",
                "data" => $this->getByID($UserPushToken->id)
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
    | Get All User Push Tokens
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all User Push Tokens
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
    |                "uuid": "GAAD34534DS",
    |                "token": "opkasod3353dfkwes",
    |                "created_at": "2020-12-14T20:57:55.000000Z",
    |                "updated_at": "2020-12-14T20:57:55.000000Z",
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
    |                "uuid": "WERG4564EGF",
    |                "token": "54yrhgdf567575567fg",
    |                "created_at": "2020-12-14T20:58:37.000000Z",
    |                "updated_at": "2020-12-14T20:58:37.000000Z",
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
            $UserPushTokens = UserPushToken::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $UserPushTokens
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
    | Get User Push Token by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User Push Token
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the User Push   |
    |  |            |        |         | Token. Example : 2                 |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Token recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "user_id": 1,
    |                "uuid": "WERG4564EGF",
    |                "token": "54yrhgdf567575567fg",
    |                "created_at": "2020-12-14T20:58:37.000000Z",
    |                "updated_at": "2020-12-14T20:58:37.000000Z",
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
            $UserPushToken = UserPushToken::find($id);

            if (is_null($UserPushToken)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Token no encontrado.",
                    "data" => $UserPushToken
                ]);
            } else {
                $UserPushToken = $UserPushToken
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Token recuperado satisfactoriamente.",
                "data" => $UserPushToken
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
    | Update an UserPushToken
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an UserPushToken
    |
    |   {
    |        "id" : 3,
    |        "user_id" : 1,
    |        "uuid" : "WGERGWER64546",
    |        "token" : "et45646sgsdgsrt45645"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Token actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Token recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "user_id": 1,
    |                        "uuid": "WGERGWER64546",
    |                        "token": "et45646sgsdgsrt45645",
    |                        "created_at": "2020-12-14T21:00:07.000000Z",
    |                        "updated_at": "2020-12-14T21:00:07.000000Z",
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
            $UserPushToken = UserPushToken::findOrFail($request->id);

            $UserPushToken->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Token actualizado satisafactoriamente.",
                "data" => $this->getByID($UserPushToken->id)
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
    | Delete an UserPushToken
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific UserPushToken
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the User Push  |
    |  |            |        |          | Token. Example : 3                |
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
    |        "message": "Token eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "user_id": 1,
    |            "uuid": "WGERGWER64546",
    |            "token": "et45646sgsdgsrt45645",
    |            "created_at": "2020-12-14T21:00:07.000000Z",
    |            "updated_at": "2020-12-14T21:00:07.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserPushToken = UserPushToken::find($id);


            if (!is_null($UserPushToken)) {
                $UserPushToken->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Token eliminado satisfactoriamente.",
                    "data" => $UserPushToken
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Token no encontrado.",
                    "data" => $UserPushToken
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
    | Create or Update User Push Tokens Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an User Push Token
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'uuid' => 'required',
            'token' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Método.',
            'user_id.exists' => 'No existe el Método.',
            'uuid' => 'Debe escribir un UUID.',
            'token' => 'Debe escribir un Token.',
        ];
    }
}
