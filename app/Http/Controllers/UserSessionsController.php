<?php

namespace App\Http\Controllers;

use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSessionsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User Sessions
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an User Sessions
    |
    |   {
    |        "user_id" : 2,
    |        "token" : "8092345JGOAIJGOIDRS9085DJGD",
    |        "uuid" : "943IJDSFLS",
    |        "platform" : "Windows",
    |        "ip" : "127.0.0.2",
    |        "device" : "PC"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Sesión del Usuario creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Sesión del Usuario recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "user_id": 2,
    |                        "token": "8092345JGOAIJGOIDRS9085DJGD",
    |                        "uuid": "943IJDSFLS",
    |                        "platform": "Windows",
    |                        "ip": "127.0.0.2",
    |                        "device": "PC",
    |                        "created_at": "2020-12-14T21:26:06.000000Z",
    |                        "updated_at": "2020-12-14T21:26:06.000000Z",
    |                        "expired_at": null,
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
            $UserSession = UserSession::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Sesión del Usuario creada satisfactoriamente.",
                "data" => $this->getByID($UserSession->id)
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
    | Get All User Sessions
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all User Sessions
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
    |                "user_id": 1,
    |                "token": "JFOASDOFIWEIOAJ234234JOI234O",
    |                "uuid": "OWIFE05349",
    |                "platform": "Unix",
    |                "ip": "127.0.0.1",
    |                "device": "NoteBook",
    |                "created_at": "2020-12-14T21:23:08.000000Z",
    |                "updated_at": "2020-12-14T21:23:08.000000Z",
    |                "expired_at": null,
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
    |            },
    |            {
    |                "id": 2,
    |                "user_id": 2,
    |                "token": "8092345JGOAIJGOIDRS9085DJGD",
    |                "uuid": "943IJDSFLS",
    |                "platform": "Windows",
    |                "ip": "127.0.0.2",
    |                "device": "PC",
    |                "created_at": "2020-12-14T21:24:58.000000Z",
    |                "updated_at": "2020-12-14T21:24:58.000000Z",
    |                "expired_at": null,
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
    |                "id": 3,
    |                "user_id": 2,
    |                "token": "8092345JGOAIJGOIDRS9085DJGD",
    |                "uuid": "943IJDSFLS",
    |                "platform": "Windows",
    |                "ip": "127.0.0.2",
    |                "device": "PC",
    |                "created_at": "2020-12-14T21:26:06.000000Z",
    |                "updated_at": "2020-12-14T21:26:06.000000Z",
    |                "expired_at": null,
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
    */
    public function getAll() {
        try {
            $UserSessions = UserSession::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $UserSessions
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
    | Get User Session by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User Session
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the User Session|
    |  |            |        |         | Example : 2                        |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Sesión del Usuario recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "user_id": 2,
    |                "token": "8092345JGOAIJGOIDRS9085DJGD",
    |                "uuid": "943IJDSFLS",
    |                "platform": "Windows",
    |                "ip": "127.0.0.2",
    |                "device": "PC",
    |                "created_at": "2020-12-14T21:24:58.000000Z",
    |                "updated_at": "2020-12-14T21:24:58.000000Z",
    |                "expired_at": null,
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
            $UserSession = UserSession::find($id);

            if (is_null($UserSession)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Sesión del Usuario no encontrada.",
                    "data" => $UserSession
                ]);
            } else {
                $UserSession = $UserSession
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Sesión del Usuario recuperada satisfactoriamente.",
                "data" => $UserSession
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
    | Update an User Session
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an User Session
    |
    |   {
            "id" : 2,
            "user_id" : 2,
            "token" : "8092345JGOAIJGOIDRS9085DJGD",
            "uuid" : "943IJDSFLS",
            "platform" : "Windows",
            "ip" : "127.0.0.2",
            "device" : "PC"
        }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Sesión del Usuario actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Sesión del Usuario recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "user_id": 2,
    |                        "token": "8092345JGOAIJGOIDRS9085DJGD",
    |                        "uuid": "943IJDSFLS",
    |                        "platform": "Windows",
    |                        "ip": "127.0.0.2",
    |                        "device": "PC",
    |                        "created_at": "2020-12-14T21:24:58.000000Z",
    |                        "updated_at": "2020-12-14T21:24:58.000000Z",
    |                        "expired_at": null,
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
            $UserSession = UserSession::findOrFail($request->id);

            $UserSession->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Sesión del Usuario actualizada satisafactoriamente.",
                "data" => $this->getByID($UserSession->id)
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
    | Delete an User Session
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Session
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the User Session |
    |  |            |        |          | Example : 2                         |
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
    |        "message": "Sesión del Usuario eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "user_id": 2,
    |            "token": "8092345JGOAIJGOIDRS9085DJGD",
    |            "uuid": "943IJDSFLS",
    |            "platform": "Windows",
    |            "ip": "127.0.0.2",
    |            "device": "PC",
    |            "created_at": "2020-12-14T21:24:58.000000Z",
    |            "updated_at": "2020-12-14T21:24:58.000000Z",
    |            "expired_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserSession = UserSession::find($id);


            if (!is_null($UserSession)) {
                $UserSession->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Sesión del Usuario eliminada satisfactoriamente.",
                    "data" => $UserSession
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Sesión del Usuario no encontrada.",
                    "data" => $UserSession
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
    | Create or Update User Session Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an User Session
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'uuid' => 'required',
            'token' => 'required',
            'platform' => 'required',
            'ip' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Usuario.',
            'user_id.exists' => 'No existe el Usuario.',
            'uuid' => 'Debe escribir un UUID.',
            'token' => 'Debe escribir un Token.',
            'platform' => 'Debe escribir una Plataforma.',
            'ip' => 'Debe escribir una Plataforma.',
        ];
    }
}
