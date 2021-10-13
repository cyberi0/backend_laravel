<?php

namespace App\Http\Controllers;

use App\Models\OxxoOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OxxoOrdersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Oxxo Orders
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Oxxo Orders
    |
    |   {
    |        "user_id" : 1,
    |        "amount" : 1000,
    |        "fee" : 300,
    |        "order_id" : "OASD52345JFASF",
    |        "charge_id": "AFAEK032842039A",
    |        "bardcode": "0342UOIJFASLF02839",
    |        "reference" : "Lorem Impsum Dolor",
    |        "expired_at" : "2020-11-24 23:09:39",
    |        "paid_at" : "2020-11-24 23:09:39"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Orden creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Orden recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "user_id": 1,
    |                        "amount": "1000.00",
    |                        "fee": "300.00",
    |                        "order_id": "OASD52345JFASF",
    |                        "charge_id": "AFAEK032842039A",
    |                        "bardcode": "0342UOIJFASLF02839",
    |                        "reference": "Lorem Impsum Dolor",
    |                        "expired_at": "2020-11-24",
    |                        "created_at": "2020-12-12T01:36:25.000000Z",
    |                        "updated_at": "2020-12-12T01:36:25.000000Z",
    |                        "paid_at": "2020-11-24 23:09:39",
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
            $OxxoOrder = OxxoOrder::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Orden creada satisfactoriamente.",
                "data" => $this->getByID($OxxoOrder->id)
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
    | Get All Oxxo Orders
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Oxxo Orders
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
    |                "amount": "1000.00",
    |                "fee": "300.00",
    |                "order_id": "OASD52345JFASF",
    |                "charge_id": "AFAEK032842039A",
    |                "bardcode": "0342UOIJFASLF02839",
    |                "reference": "Lorem Impsum Dolor",
    |                "expired_at": "2020-11-24",
    |                "created_at": "2020-12-12T01:36:25.000000Z",
    |                "updated_at": "2020-12-12T01:36:25.000000Z",
    |                "paid_at": "2020-11-24 23:09:39",
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
    |                "amount": "1500.00",
    |                "fee": "400.00",
    |                "order_id": "GDFD52385FGATS",
    |                "charge_id": "TRGDK054762039A",
    |                "bardcode": "9843UOIJFASLF02839",
    |                "reference": "Lorem Impsum Dolor",
    |                "expired_at": "2020-12-24",
    |                "created_at": "2020-12-12T01:38:48.000000Z",
    |                "updated_at": "2020-12-12T01:38:48.000000Z",
    |                "paid_at": "2020-11-24 23:09:39",
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
            $OxxoOrders = OxxoOrder::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $OxxoOrders
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
    | Get Oxxo Order by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Oxxo Order
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the OxxoOrder   |
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
    |        "message": "Orden recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "user_id": 2,
    |                "amount": "1500.00",
    |                "fee": "400.00",
    |                "order_id": "GDFD52385FGATS",
    |                "charge_id": "TRGDK054762039A",
    |                "bardcode": "9843UOIJFASLF02839",
    |                "reference": "Lorem Impsum Dolor",
    |                "expired_at": "2020-12-24",
    |                "created_at": "2020-12-12T01:38:48.000000Z",
    |                "updated_at": "2020-12-12T01:38:48.000000Z",
    |                "paid_at": "2020-11-24 23:09:39",
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
            $OxxoOrder = OxxoOrder::find($id);

            if (is_null($OxxoOrder)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Orden no encontrada.",
                    "data" => $OxxoOrder
                ]);
            } else {
                $OxxoOrder = $OxxoOrder
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Orden recuperada satisfactoriamente.",
                "data" => $OxxoOrder
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
    | Update Oxxo Orders
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Oxxo Orders
    |
    |   {
    |        "id":2,
    |        "user_id" : 2,
    |        "amount" : 1800,
    |        "fee" : 600,
    |        "order_id" : "RTFD52385FGATS",
    |        "charge_id": "PGRDK054762039A",
    |        "bardcode": "9762UOIJFASLF02839",
    |        "reference" : "Lorem Impsum Dolor",
    |        "expired_at" : "2020-12-24 23:09:39",
    |        "paid_at" : "2020-11-24 23:09:39"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Orden actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Orden recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "user_id": 2,
    |                        "amount": "1800.00",
    |                        "fee": "600.00",
    |                        "order_id": "RTFD52385FGATS",
    |                        "charge_id": "PGRDK054762039A",
    |                        "bardcode": "9762UOIJFASLF02839",
    |                        "reference": "Lorem Impsum Dolor",
    |                        "expired_at": "2020-12-24",
    |                        "created_at": "2020-12-12T01:38:48.000000Z",
    |                        "updated_at": "2020-12-12T01:47:35.000000Z",
    |                        "paid_at": "2020-11-24 23:09:39",
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
            $OxxoOrder = OxxoOrder::findOrFail($request->id);

            $OxxoOrder->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Orden actualizada satisafactoriamente.",
                "data" => $this->getByID($OxxoOrder->id)
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
    | Delete Oxxo Orders
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Oxxo Order
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Oxxo Order |
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
    |        "message": "Orden eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "user_id": 1,
    |            "amount": "300.00",
    |            "fee": "40.00",
    |            "order_id": "ORDERFORDELETE",
    |            "charge_id": "TRGDK054762039A",
    |            "bardcode": "9843UOIJFASLF02839",
    |            "reference": "Lorem Impsum Dolor",
    |            "expired_at": "2020-12-24",
    |            "created_at": "2020-12-12T01:49:58.000000Z",
    |            "updated_at": "2020-12-12T01:49:58.000000Z",
    |            "paid_at": "2020-11-24 23:09:39"
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $OxxoOrder = OxxoOrder::find($id);

            if (!is_null($OxxoOrder)) {
                $OxxoOrder->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Orden eliminada satisfactoriamente.",
                    "data" => $OxxoOrder
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Orden no encontrada.",
                    "data" => $OxxoOrder
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
    | Create or Update Oxxo Orders Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Oxxo Orders
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required',
            'fee' => 'required',
            'order_id' => 'required',
            'charge_id' => 'required',
            'bardcode' => 'required',
            'reference' => 'required',
            'expired_at' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Usuario.',
            'user_id.exists' => 'No existe el Usuario.',
            'amount.required' => 'Debe escribir una Monto.',
            'fee.required' => 'Debe escribir un Cargo.',
            'order_id.required' => 'Debe escribir el ID de la Orden.',
            'charge_id.required' => 'Debe escribir el ID del Cargo.',
            'bardcode.required' => 'Debe escribir un Código de Barras.',
            'reference.required' => 'Debe escribir una Referencia.',
            'expired_at.required' => 'Debe seleccionar la Fecha que Expira.',
        ];
    }
}
