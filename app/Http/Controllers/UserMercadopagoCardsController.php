<?php

namespace App\Http\Controllers;

use App\Models\UserMercadopagoCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMercadopagoCardsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Users Mercado Pago
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an User Mercado Pago
    |
    |    {
    |         "user_id" : 1,
    |         "user_card_id" : 2,
    |         "card_id" : "987423592"
    |     }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |         "response": "success",
    |         "message": "Cuenta creada satisfactoriamente.",
    |         "data": {
    |             "headers": {},
    |             "original": {
    |                 "response": "success",
    |                 "message": "Cuenta recuperada satisfactoriamente.",
    |                 "data": [
    |                     {
    |                         "id": 1,
    |                         "user_id": 1,
    |                         "user_card_id": 2,
    |                         "card_id": "987423592",
    |                         "created_at": "2020-12-14T18:28:19.000000Z",
    |                         "updated_at": "2020-12-14T18:28:19.000000Z",
    |                         "deleted_at": null,
    |                         "user": {
    |                             "id": 1,
    |                             "user_id": null,
    |                             "type_id": null,
    |                             "created_by": null,
    |                             "names": "Carlos",
    |                             "surnames": "Laravel",
    |                             "username": "develop2",
    |                             "email": "develop2@wobisoft.com",
    |                             "mobile": "9797968543",
    |                             "curp": null,
    |                             "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                             "created_at": "2020-11-24T23:09:39.000000Z",
    |                             "updated_at": "2020-11-24T23:09:39.000000Z",
    |                             "deleted_at": null
    |                         }
    |                     }
    |                 ]
    |             },
    |             "exception": null
    |         }
    |     }
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
            $UserMercadopagoCard = UserMercadopagoCard::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuenta creada satisfactoriamente.",
                "data" => $this->getByID($UserMercadopagoCard->id)
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
    | Get All Users Mercado Pago
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Users Mercado Pago
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
    |                "user_card_id": 2,
    |                "card_id": "987423592",
    |                "created_at": "2020-12-14T18:28:19.000000Z",
    |                "updated_at": "2020-12-14T18:28:19.000000Z",
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
    |                "user_id": 2,
    |                "user_card_id": 1,
    |                "card_id": "974543592",
    |                "created_at": "2020-12-14T18:29:46.000000Z",
    |                "updated_at": "2020-12-14T18:29:46.000000Z",
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
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $UserMercadopagoCards = UserMercadopagoCard::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $UserMercadopagoCards
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
    | Get User Mercado Pago by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User Mercado Pago
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the User       |
    |  |            |        |          | Mercado Pago Example : 2          |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuenta recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "user_id": 2,
    |                "user_card_id": 1,
    |                "card_id": "974543592",
    |                "created_at": "2020-12-14T18:29:46.000000Z",
    |                "updated_at": "2020-12-14T18:29:46.000000Z",
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
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $UserMercadopagoCard = UserMercadopagoCard::find($id);

            if (is_null($UserMercadopagoCard)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $UserMercadopagoCard
                ]);
            } else {
                $UserMercadopagoCard = $UserMercadopagoCard
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Cuenta recuperada satisfactoriamente.",
                "data" => $UserMercadopagoCard
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
    | Update an User Mercado Pago
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an User Mercado Pago
    |
    |   {
    |        "id" : 2,
    |        "user_id" : 2,
    |        "user_card_id" : 2,
    |        "card_id" : "995443592"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuenta actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "user_id": 2,
    |                        "user_card_id": 2,
    |                        "card_id": "995443592",
    |                        "created_at": "2020-12-14T18:29:46.000000Z",
    |                        "updated_at": "2020-12-14T18:33:40.000000Z",
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
            $UserMercadopagoCard = UserMercadopagoCard::findOrFail($request->id);

            $UserMercadopagoCard->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuenta actualizada satisafactoriamente.",
                "data" => $this->getByID($UserMercadopagoCard->id)
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
    | Delete an User Mercado Pago
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Mercado Pago
    |   using the following parameter:
    |
    |   ______________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                     |
    |  |--------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the User |
    |  |            |        |          | Mercado Pago. Example : 3   |
    |  |            |        |          |                             |
    |  |____________|________|__________|_____________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuenta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "user_id": 2,
    |            "user_card_id": 2,
    |            "card_id": "995443592",
    |            "created_at": "2020-12-14T18:29:46.000000Z",
    |            "updated_at": "2020-12-14T18:33:40.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserMercadopagoCard = UserMercadopagoCard::find($id);

            if (!is_null($UserMercadopagoCard)) {
                $UserMercadopagoCard->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuenta eliminada satisfactoriamente.",
                    "data" => $UserMercadopagoCard
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $UserMercadopagoCard
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
    | Create or Update Users Mercado Pago Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an User Mercado Pago
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:methods,id',
            'user_card_id' => 'required',
            'card_id' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Usuario.',
            'user_id.exists' => 'No existe el Usuario.',
            'user_card_id' => 'Debe escribir un Usuario ID de la Tarjeta.',
            'card_id' => 'Debe escribir un ID de la Tarjeta.',
        ];
    }
}
