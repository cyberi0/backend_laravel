<?php

namespace App\Http\Controllers;

use App\Models\OxxoOrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OxxoOrderPaymentsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Oxxo Order Payments
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Oxxo Order Payments
    |
    |   {
    |       "order_id" : 1,
    |       "payment_id" : 3
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Orden de Pago creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Orden de Pago recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "order_id": 1,
    |                        "payment_id": 3,
    |                        "created_at": "2020-12-12T02:23:01.000000Z",
    |                        "updated_at": "2020-12-12T02:23:01.000000Z",
    |                        "order": {
    |                            "id": 1,
    |                            "user_id": 1,
    |                            "amount": "1000.00",
    |                            "fee": "300.00",
    |                            "order_id": "OASD52345JFASF",
    |                            "charge_id": "AFAEK032842039A",
    |                            "bardcode": "0342UOIJFASLF02839",
    |                            "reference": "Lorem Impsum Dolor",
    |                            "expired_at": "2020-11-24",
    |                            "created_at": "2020-12-12T01:36:25.000000Z",
    |                            "updated_at": "2020-12-12T01:36:25.000000Z",
    |                            "paid_at": "2020-11-24 23:09:39"
    |                        },
    |                        "payment": {
    |                            "id": 3,
    |                            "method_id": 1,
    |                            "account_id": 2,
    |                            "card_id": 1,
    |                            "provider_id": 1,
    |                            "complex_id": 1,
    |                            "property_id": 2,
    |                            "type_id": 1,
    |                            "registered_by": 1,
    |                            "cdr": "SDFGSG",
    |                            "reference": "SDFGSDFG",
    |                            "way": "1",
    |                            "month": "1",
    |                            "year": "2312",
    |                            "name": "ASDFASFA",
    |                            "description": "ASDFASDFSA",
    |                            "amount": "1234.00",
    |                            "paid": "423.00",
    |                            "fee": "23423.00",
    |                            "charge": "12331.00",
    |                            "config": null,
    |                            "receipt": "ASDFASDF",
    |                            "comments": "ASDFASDF AS DA ASDF ",
    |                            "created_at": null,
    |                            "updated_at": null,
    |                            "deleted_at": null,
    |                            "registered_at": null,
    |                            "paid_at": null,
    |                            "expired_at": null,
    |                            "withdrawal_requested_at": null,
    |                            "withdrawn_at": null,
    |                            "chargedback_at": null,
    |                            "chargeback_covered_at": null
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
            $OxxoOrderPayment = OxxoOrderPayment::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Orden de Pago creada satisfactoriamente.",
                "data" => $this->getByID($OxxoOrderPayment->id)
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
    | Get All Oxxo Order Payments
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Oxxo Order Payments
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
    |                "order_id": 1,
    |                "payment_id": 3,
    |                "created_at": "2020-12-12T02:23:01.000000Z",
    |                "updated_at": "2020-12-12T02:23:01.000000Z",
    |                "order": {
    |                    "id": 1,
    |                    "user_id": 1,
    |                    "amount": "1000.00",
    |                    "fee": "300.00",
    |                    "order_id": "OASD52345JFASF",
    |                    "charge_id": "AFAEK032842039A",
    |                    "bardcode": "0342UOIJFASLF02839",
    |                    "reference": "Lorem Impsum Dolor",
    |                    "expired_at": "2020-11-24",
    |                    "created_at": "2020-12-12T01:36:25.000000Z",
    |                    "updated_at": "2020-12-12T01:36:25.000000Z",
    |                    "paid_at": "2020-11-24 23:09:39"
    |                },
    |                "payment": {
    |                    "id": 3,
    |                    "method_id": 1,
    |                    "account_id": 2,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 2,
    |                    "type_id": 1,
    |                    "registered_by": 1,
    |                    "cdr": "SDFGSG",
    |                    "reference": "SDFGSDFG",
    |                    "way": "1",
    |                    "month": "1",
    |                    "year": "2312",
    |                    "name": "ASDFASFA",
    |                    "description": "ASDFASDFSA",
    |                    "amount": "1234.00",
    |                    "paid": "423.00",
    |                    "fee": "23423.00",
    |                    "charge": "12331.00",
    |                    "config": null,
    |                    "receipt": "ASDFASDF",
    |                    "comments": "ASDFASDF AS DA ASDF ",
    |                    "created_at": null,
    |                    "updated_at": null,
    |                    "deleted_at": null,
    |                    "registered_at": null,
    |                    "paid_at": null,
    |                    "expired_at": null,
    |                    "withdrawal_requested_at": null,
    |                    "withdrawn_at": null,
    |                    "chargedback_at": null,
    |                    "chargeback_covered_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "order_id": 2,
    |                "payment_id": 3,
    |                "created_at": "2020-12-12T02:24:01.000000Z",
    |                "updated_at": "2020-12-12T02:24:01.000000Z",
    |                "order": {
    |                    "id": 2,
    |                    "user_id": 2,
    |                    "amount": "1800.00",
    |                    "fee": "600.00",
    |                    "order_id": "RTFD52385FGATS",
    |                    "charge_id": "PGRDK054762039A",
    |                    "bardcode": "9762UOIJFASLF02839",
    |                    "reference": "Lorem Impsum Dolor",
    |                    "expired_at": "2020-12-24",
    |                    "created_at": "2020-12-12T01:38:48.000000Z",
    |                    "updated_at": "2020-12-12T01:47:35.000000Z",
    |                    "paid_at": "2020-11-24 23:09:39"
    |                },
    |                "payment": {
    |                    "id": 3,
    |                    "method_id": 1,
    |                    "account_id": 2,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 2,
    |                    "type_id": 1,
    |                    "registered_by": 1,
    |                    "cdr": "SDFGSG",
    |                    "reference": "SDFGSDFG",
    |                    "way": "1",
    |                    "month": "1",
    |                    "year": "2312",
    |                    "name": "ASDFASFA",
    |                    "description": "ASDFASDFSA",
    |                    "amount": "1234.00",
    |                    "paid": "423.00",
    |                    "fee": "23423.00",
    |                    "charge": "12331.00",
    |                    "config": null,
    |                    "receipt": "ASDFASDF",
    |                    "comments": "ASDFASDF AS DA ASDF ",
    |                    "created_at": null,
    |                    "updated_at": null,
    |                    "deleted_at": null,
    |                    "registered_at": null,
    |                    "paid_at": null,
    |                    "expired_at": null,
    |                    "withdrawal_requested_at": null,
    |                    "withdrawn_at": null,
    |                    "chargedback_at": null,
    |                    "chargeback_covered_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $OxxoOrderPayments = OxxoOrderPayment::with('order')
                ->with('payment')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $OxxoOrderPayments
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
    | Get Oxxo Order Payments by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Oxxo Order Payment
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Oxxo Order |
    |  |            |        |          | Payment. Example : 2              |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Orden de Pago recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "order_id": 2,
    |                "payment_id": 3,
    |                "created_at": "2020-12-12T02:24:01.000000Z",
    |                "updated_at": "2020-12-12T02:24:01.000000Z",
    |                "order": {
    |                    "id": 2,
    |                    "user_id": 2,
    |                    "amount": "1800.00",
    |                    "fee": "600.00",
    |                    "order_id": "RTFD52385FGATS",
    |                    "charge_id": "PGRDK054762039A",
    |                    "bardcode": "9762UOIJFASLF02839",
    |                    "reference": "Lorem Impsum Dolor",
    |                    "expired_at": "2020-12-24",
    |                    "created_at": "2020-12-12T01:38:48.000000Z",
    |                    "updated_at": "2020-12-12T01:47:35.000000Z",
    |                    "paid_at": "2020-11-24 23:09:39"
    |                },
    |                "payment": {
    |                    "id": 3,
    |                    "method_id": 1,
    |                    "account_id": 2,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 2,
    |                    "type_id": 1,
    |                    "registered_by": 1,
    |                    "cdr": "SDFGSG",
    |                    "reference": "SDFGSDFG",
    |                    "way": "1",
    |                    "month": "1",
    |                    "year": "2312",
    |                    "name": "ASDFASFA",
    |                    "description": "ASDFASDFSA",
    |                    "amount": "1234.00",
    |                    "paid": "423.00",
    |                    "fee": "23423.00",
    |                    "charge": "12331.00",
    |                    "config": null,
    |                    "receipt": "ASDFASDF",
    |                    "comments": "ASDFASDF AS DA ASDF ",
    |                    "created_at": null,
    |                    "updated_at": null,
    |                    "deleted_at": null,
    |                    "registered_at": null,
    |                    "paid_at": null,
    |                    "expired_at": null,
    |                    "withdrawal_requested_at": null,
    |                    "withdrawn_at": null,
    |                    "chargedback_at": null,
    |                    "chargeback_covered_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $OxxoOrderPayment = OxxoOrderPayment::find($id);

            if (is_null($OxxoOrderPayment)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Orden de Pago no encontrada.",
                    "data" => $OxxoOrderPayment
                ]);
            } else {
                $OxxoOrderPayment = $OxxoOrderPayment
                    ->with('order')
                    ->with('payment')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Orden de Pago recuperada satisfactoriamente.",
                "data" => $OxxoOrderPayment
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
    | Update an Oxxo Order Payment
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Oxxo Order Payment
    |
    |   {
    |        "id" : 2,
    |        "order_id" : 2,
    |        "payment_id" : 3
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Orden de Pago actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Orden de Pago recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "order_id": 2,
    |                        "payment_id": 3,
    |                        "created_at": "2020-12-12T02:24:01.000000Z",
    |                        "updated_at": "2020-12-12T02:24:01.000000Z",
    |                        "order": {
    |                            "id": 2,
    |                            "user_id": 2,
    |                            "amount": "1800.00",
    |                            "fee": "600.00",
    |                            "order_id": "RTFD52385FGATS",
    |                            "charge_id": "PGRDK054762039A",
    |                            "bardcode": "9762UOIJFASLF02839",
    |                            "reference": "Lorem Impsum Dolor",
    |                            "expired_at": "2020-12-24",
    |                            "created_at": "2020-12-12T01:38:48.000000Z",
    |                            "updated_at": "2020-12-12T01:47:35.000000Z",
    |                            "paid_at": "2020-11-24 23:09:39"
    |                        },
    |                        "payment": {
    |                            "id": 3,
    |                            "method_id": 1,
    |                            "account_id": 2,
    |                            "card_id": 1,
    |                            "provider_id": 1,
    |                            "complex_id": 1,
    |                            "property_id": 2,
    |                            "type_id": 1,
    |                            "registered_by": 1,
    |                            "cdr": "SDFGSG",
    |                            "reference": "SDFGSDFG",
    |                            "way": "1",
    |                            "month": "1",
    |                            "year": "2312",
    |                            "name": "ASDFASFA",
    |                            "description": "ASDFASDFSA",
    |                            "amount": "1234.00",
    |                            "paid": "423.00",
    |                            "fee": "23423.00",
    |                            "charge": "12331.00",
    |                            "config": null,
    |                            "receipt": "ASDFASDF",
    |                            "comments": "ASDFASDF AS DA ASDF ",
    |                            "created_at": null,
    |                            "updated_at": null,
    |                            "deleted_at": null,
    |                            "registered_at": null,
    |                            "paid_at": null,
    |                            "expired_at": null,
    |                            "withdrawal_requested_at": null,
    |                            "withdrawn_at": null,
    |                            "chargedback_at": null,
    |                            "chargeback_covered_at": null
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
            $OxxoOrderPayment = OxxoOrderPayment::findOrFail($request->id);

            $OxxoOrderPayment->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Orden de Pago actualizada satisafactoriamente.",
                "data" => $this->getByID($OxxoOrderPayment->id)
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
    | Delete Oxxo Order Payments
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Oxxo Order Payment
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Oxxo Order |
    |  |            |        |          | Payment. Example : 2              |
    |  |            |        |          |                                   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
        {
            "response": "success",
            "message": "Orden de Pago eliminada satisfactoriamente.",
            "data": {
                "id": 2,
                "order_id": 2,
                "payment_id": 3,
                "created_at": "2020-12-12T02:24:01.000000Z",
                "updated_at": "2020-12-12T02:24:01.000000Z"
            }
        }
    */
    public function delete($id)
    {
        try {
            $OxxoOrderPayment = OxxoOrderPayment::find($id);

            if (!is_null($OxxoOrderPayment)) {
                $OxxoOrderPayment->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Orden de Pago eliminada satisfactoriamente.",
                    "data" => $OxxoOrderPayment
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Orden de Pago no encontrada.",
                    "data" => $OxxoOrderPayment
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
    |    for validations when you create or update an OxxoOrderPayment
    |
    */
    public function getRules() {
        return [
            'order_id' => 'required|exists:oxxo_orders,id',
            'payment_id' => 'required|exists:payments,id',
        ];
    }

    public function getMessages() {
        return [
            'order_id.required' => 'Debe elegir un Método',
            'order_id.exists' => 'No existe el Método',
            'payment_id.required' => 'Debe elegir un Pago',
            'payment_id.exists' => 'No existe el Pago',
        ];
    }
}
