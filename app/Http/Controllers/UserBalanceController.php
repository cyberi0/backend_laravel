<?php

namespace App\Http\Controllers;

use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBalanceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User Balance
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an User Balance
    |
    |    {
    |       "user_id" : 1,
    |       "balance" : 2000
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Balance del Usuario creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos de la Balance del Usuario recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "user_id": 1,
    |                        "balance": "2000.00",
    |                        "created_at": "2020-11-30T21:20:07.000000Z",
    |                        "updated_at": "2020-11-30T21:20:07.000000Z",
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

        if($validatedData->fails()) {
            return response()->json([
                "response" => "error",
                "message" => $validatedData->errors()->first(),
                "code" => 400
            ]);
        }

        try {
            $userBalance = UserBalance::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Balance del Usuario creado satisfactoriamente.",
                "data" => $this->getByID($userBalance->id)
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
    | Get All User Balances
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all User Balances
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Lista de Balances del Usuario recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "user_id": 1,
    |                "balance": "2000.00",
    |                "created_at": "2020-11-30T21:16:37.000000Z",
    |                "updated_at": "2020-11-30T21:16:37.000000Z",
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
    |            },
    |            {
    |                "id": 2,
    |                "user_id": 1,
    |                "balance": "2000.00",
    |                "created_at": "2020-11-30T21:17:37.000000Z",
    |                "updated_at": "2020-11-30T21:17:37.000000Z",
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
    |            },
    |            {
    |                "id": 3,
    |                "user_id": 1,
    |                "balance": "2000.00",
    |                "created_at": "2020-11-30T21:20:07.000000Z",
    |                "updated_at": "2020-11-30T21:20:07.000000Z",
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
            $UserBalances = UserBalance::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista de Balances del Usuario recuperada satisfactoriamente.",
                "data" => $UserBalances
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
    | Get User Balance by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Notification
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the            |
    |  |            |        |          | User Balance. Example : 1         |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Datos de la Balance del Usuario recuperados satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "user_id": 1,
    |                "balance": "2000.00",
    |                "created_at": "2020-11-30T21:16:37.000000Z",
    |                "updated_at": "2020-11-30T21:16:37.000000Z",
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
        try {
            $userBalance = UserBalance::find($id);

            if (is_null($userBalance)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Balance del Usuario no encontrada.",
                    "data" => $userBalance
                ]);
            } else {
                $userBalance = $userBalance->with('user')->where('id', $id)->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Datos de la Balance del Usuario recuperados satisfactoriamente.",
                "data" => $userBalance
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
    | Update User Balance
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a User Balance
    |
    |   {
    |       "id" : 3,
    |       "user_id" : 1,
    |       "balance" : 1800
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Balance del Usuario actualizado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos de la Balance del Usuario recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "user_id": 1,
    |                        "balance": "1800.00",
    |                        "created_at": "2020-11-30T21:20:07.000000Z",
    |                        "updated_at": "2020-11-30T21:58:14.000000Z",
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
            $Notification= UserBalance::findOrFail($request->id);
            $Notification->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Balance del Usuario actualizado satisfactoriamente.",
                "data" => $this->getByID($request->id)
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
    | Delete an User Balance
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Balance
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the            |
    |  |            |        |          | User Balance. Example : 3         |
    |  |____________|________|__________|___________________________________|
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |     {
    |        "response": "success",
    |        "message": "Balance del Usuario eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "user_id": 1,
    |            "balance": "1800.00",
    |            "created_at": "2020-11-30T21:20:07.000000Z",
    |            "updated_at": "2020-11-30T21:58:14.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($userBalance_id)
    {
        try {
            $UserBalance= UserBalance::find($userBalance_id);

            if (!is_null($UserBalance)) {
                $UserBalance->destroy($userBalance_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Balance del Usuario eliminado satisfactoriamente.",
                    "data" => $UserBalance
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Balance del Usuario no encontrado.",
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
   | Create or Update User Balance Validations
   |--------------------------------------------------------------------------
   |   With The following methods just get de rules and custom messages
   |    for validations when you create or update a Notification
   |
   */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'balance' => 'required'
        ];
    }
    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir el Ocupante para la Notificación.',
            'user_id.exists' => 'Debe elegir el Ocupante para la Notificación.',
            'balance.required' => 'Debe ingresar el Balance.'
        ];
    }
}
