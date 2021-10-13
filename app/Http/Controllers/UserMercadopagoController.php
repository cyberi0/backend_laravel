<?php

namespace App\Http\Controllers;

use App\Models\UserMercadopago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMercadopagoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Users Mercado Pago
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an User Mercado Pago
    |
    |   {
    |        "user_id" : 2,
    |        "customer_id" : "01293468",
    |        "email" : "development2@wobisoft.com",
    |        "first_name" : "Billy",
    |        "last_name" : "Mahonie",
    |        "description" : "Lorem Ipsum Dolor"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Usuario Mercadopago creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Usuario Mercadopago recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "user_id": 2,
    |                        "email": "development2@wobisoft.com",
    |                        "first_name": "Billy",
    |                        "last_name": "Mahonie",
    |                        "customer_id": "01293468",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-14T17:27:38.000000Z",
    |                        "updated_at": "2020-12-14T17:27:38.000000Z",
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
            $UserMercadoPago = UserMercadopago::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Usuario Mercadopago creado satisfactoriamente.",
                "data" => $this->getByID($UserMercadoPago->id)
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
    |        "message": "Lista recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "user_id": 2,
    |                "email": "development@wobisoft.com",
    |                "first_name": "Nick",
    |                "last_name": "Cave",
    |                "customer_id": "0823495",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-14T17:24:24.000000Z",
    |                "updated_at": "2020-12-14T17:24:24.000000Z",
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
    |                "user_id": 2,
    |                "email": "development2@wobisoft.com",
    |                "first_name": "Billy",
    |                "last_name": "Mahonie",
    |                "customer_id": "01293468",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-14T17:27:38.000000Z",
    |                "updated_at": "2020-12-14T17:27:38.000000Z",
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
            $UserMercadoPagos = UserMercadopago::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperado satisfactoriamente.",
                "data" => $UserMercadoPagos
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
    |   {
    |        "response": "success",
    |        "message": "Usuario Mercadopago recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "user_id": 2,
    |                "email": "development2@wobisoft.com",
    |                "first_name": "Billy",
    |                "last_name": "Mahonie",
    |                "customer_id": "01293468",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-14T17:27:38.000000Z",
    |                "updated_at": "2020-12-14T17:27:38.000000Z",
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
            $UserMercadoPago = UserMercadopago::find($id);

            if (is_null($UserMercadoPago)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Usuario Mercadopago no encontrado.",
                    "data" => $UserMercadoPago
                ]);
            } else {
                $UserMercadoPago = $UserMercadoPago
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Usuario Mercadopago recuperado satisfactoriamente.",
                "data" => $UserMercadoPago
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
            "id" : 2,
            "user_id" : 2,
            "customer_id" : "01193987",
            "email" : "development2@wobisoft.com",
            "first_name" : "Billy",
            "last_name" : "Mahonie",
            "description" : "Lorem Ipsum Dolor"
        }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
        {
            "response": "success",
            "message": "Usuario Mercadopago actualizado satisafactoriamente.",
            "data": {
                "headers": {},
                "original": {
                    "response": "success",
                    "message": "Usuario Mercadopago recuperado satisfactoriamente.",
                    "data": [
                        {
                            "id": 2,
                            "user_id": 2,
                            "email": "development2@wobisoft.com",
                            "first_name": "Billy",
                            "last_name": "Mahonie",
                            "customer_id": "01193987",
                            "description": "Lorem Ipsum Dolor",
                            "created_at": "2020-12-14T17:27:38.000000Z",
                            "updated_at": "2020-12-14T17:54:29.000000Z",
                            "deleted_at": null,
                            "user": {
                                "id": 2,
                                "user_id": null,
                                "type_id": null,
                                "created_by": null,
                                "names": "Jorge",
                                "surnames": "Laravel",
                                "username": "develop1",
                                "email": "develop1@wobisoft.com",
                                "mobile": "9797968543",
                                "curp": null,
                                "email_verified_at": "2020-11-24T23:09:39.000000Z",
                                "created_at": "2020-11-24T23:09:39.000000Z",
                                "updated_at": "2020-11-24T23:09:39.000000Z",
                                "deleted_at": null
                            }
                        }
                    ]
                },
                "exception": null
            }
        }
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
            $UserMercadoPago = UserMercadopago::findOrFail($request->id);

            $UserMercadoPago->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Usuario Mercadopago actualizado satisafactoriamente.",
                "data" => $this->getByID($UserMercadoPago->id)
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
    |  |            |        |          | Mercado Pago. Example : 2   |
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
    |        "message": "Usuario Mercadopago eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "user_id": 2,
    |            "email": "development2@wobisoft.com",
    |            "first_name": "Billy",
    |            "last_name": "Mahonie",
    |            "customer_id": "01193987",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-14T17:27:38.000000Z",
    |            "updated_at": "2020-12-14T17:54:29.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserMercadoPago = UserMercadopago::find($id);

            if (!is_null($UserMercadoPago)) {
                $UserMercadoPago->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Usuario Mercadopago eliminado satisfactoriamente.",
                    "data" => $UserMercadoPago
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Usuario Mercadopago no encontrado.",
                    "data" => $UserMercadoPago
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
    | Create or Update Accounts Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an UserMercadoPago
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:methods,id',
            'customer_id' => 'required',
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Usuario.',
            'user_id.exists' => 'No existe el Usuario.',
            'customer_id.required' => 'Debe escribir el ID del Cliente.',
            'email' => 'Debe escribir un Correo Electrónico.',
            'first_name' => 'Debe escribir un Nombre.',
            'last_name' => 'Debe escribir un Apellido.',
            'description' => 'Debe escribir una Descripción.',
        ];
    }
}
