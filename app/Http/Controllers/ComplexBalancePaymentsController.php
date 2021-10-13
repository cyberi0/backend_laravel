<?php

namespace App\Http\Controllers;

use App\Models\ComplexBalancePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexBalancePaymentsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Balance Payment
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Complex Balance Payment
    |
    |   {
    |        "withdrawal_id" : 2,
    |        "payment_id" : 3
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Pago creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Pago recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "withdrawal_id": 2,
    |                        "payment_id": 3,
    |                        "created_at": "2020-12-11T02:04:48.000000Z",
    |                        "updated_at": "2020-12-11T02:04:48.000000Z",
    |                        "deleted_at": null,
    |                        "withdrawal": {
    |                            "id": 2,
    |                            "complex_id": 2,
    |                            "account_id": 1,
    |                            "amount": "1700.00",
    |                            "receipt": "300",
    |                            "created_at": "2020-12-11T01:49:35.000000Z",
    |                            "updated_at": "2020-12-11T01:53:20.000000Z",
    |                            "deleted_at": null,
    |                            "withdrawn_at": "2020-12-04 17:30:40",
    |                            "withdrawn_by": 2
    |                        },
    |                        "payment": {
    |                            "id": 3,
    |                            "method_id": 1,
    |                            "account_id": 1,
    |                            "card_id": 1,
    |                            "provider_id": 1,
    |                            "complex_id": 2,
    |                            "property_id": 1,
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
            $ComplexBalancePayment = ComplexBalancePayment::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Pago creado satisfactoriamente.",
                "data" => $this->getByID($ComplexBalancePayment->id)
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
    | Get All Complex Balance Payments
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Balance Payments
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
    |                "withdrawal_id": 2,
    |                "payment_id": 3,
    |                "created_at": "2020-12-11T02:04:48.000000Z",
    |                "updated_at": "2020-12-11T02:04:48.000000Z",
    |                "deleted_at": null,
    |                "withdrawal": {
    |                    "id": 2,
    |                    "complex_id": 2,
    |                    "account_id": 1,
    |                    "amount": "1700.00",
    |                    "receipt": "300",
    |                    "created_at": "2020-12-11T01:49:35.000000Z",
    |                    "updated_at": "2020-12-11T01:53:20.000000Z",
    |                    "deleted_at": null,
    |                    "withdrawn_at": "2020-12-04 17:30:40",
    |                    "withdrawn_by": 2
    |                },
    |                "payment": {
    |                    "id": 3,
    |                    "method_id": 1,
    |                    "account_id": 1,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 2,
    |                    "property_id": 1,
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
    |                "withdrawal_id": 2,
    |                "payment_id": 3,
    |                "created_at": "2020-12-11T02:06:47.000000Z",
    |                "updated_at": "2020-12-11T02:06:47.000000Z",
    |                "deleted_at": null,
    |                "withdrawal": {
    |                    "id": 2,
    |                    "complex_id": 2,
    |                    "account_id": 1,
    |                    "amount": "1700.00",
    |                    "receipt": "300",
    |                    "created_at": "2020-12-11T01:49:35.000000Z",
    |                    "updated_at": "2020-12-11T01:53:20.000000Z",
    |                    "deleted_at": null,
    |                    "withdrawn_at": "2020-12-04 17:30:40",
    |                    "withdrawn_by": 2
    |                },
    |                "payment": {
    |                    "id": 3,
    |                    "method_id": 1,
    |                    "account_id": 1,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 2,
    |                    "property_id": 1,
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
            $Accounts = ComplexBalancePayment::with('withdrawal')
                ->with('payment')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Accounts
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
    | Get Complex Balance Payment by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Balance Payment
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance Payment. Example : 3      |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Pago recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "withdrawal_id": 2,
    |                "payment_id": 3,
    |                "created_at": "2020-12-11T02:06:47.000000Z",
    |                "updated_at": "2020-12-11T02:06:47.000000Z",
    |                "deleted_at": null,
    |                "withdrawal": {
    |                    "id": 2,
    |                    "complex_id": 2,
    |                    "account_id": 1,
    |                    "amount": "1700.00",
    |                    "receipt": "300",
    |                    "created_at": "2020-12-11T01:49:35.000000Z",
    |                    "updated_at": "2020-12-11T01:53:20.000000Z",
    |                    "deleted_at": null,
    |                    "withdrawn_at": "2020-12-04 17:30:40",
    |                    "withdrawn_by": 2
    |                },
    |                "payment": {
    |                    "id": 3,
    |                    "method_id": 1,
    |                    "account_id": 1,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 2,
    |                    "property_id": 1,
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
            $account = ComplexBalancePayment::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Pago no encontrado.",
                    "data" => $account
                ]);
            } else {
                $account = $account
                    ->with('withdrawal')
                    ->with('payment')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Pago recuperado satisfactoriamente.",
                "data" => $account
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
    | Update a ComplexBalancePayment
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex Balance Payment
    |
    |   {
    |       "id" : 2,
    |       "withdrawal_id" : 2,
    |       "payment_id" : 3
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Pago actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Pago recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "withdrawal_id": 2,
    |                        "payment_id": 3,
    |                        "created_at": "2020-12-11T02:06:47.000000Z",
    |                        "updated_at": "2020-12-11T02:06:47.000000Z",
    |                        "deleted_at": null,
    |                        "withdrawal": {
    |                            "id": 2,
    |                            "complex_id": 2,
    |                            "account_id": 1,
    |                            "amount": "1700.00",
    |                            "receipt": "300",
    |                            "created_at": "2020-12-11T01:49:35.000000Z",
    |                            "updated_at": "2020-12-11T01:53:20.000000Z",
    |                            "deleted_at": null,
    |                            "withdrawn_at": "2020-12-04 17:30:40",
    |                            "withdrawn_by": 2
    |                        },
    |                        "payment": {
    |                            "id": 3,
    |                            "method_id": 1,
    |                            "account_id": 1,
    |                            "card_id": 1,
    |                            "provider_id": 1,
    |                            "complex_id": 2,
    |                            "property_id": 1,
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
            $ComplexBalancePayment = ComplexBalancePayment::findOrFail($request->id);

            $ComplexBalancePayment->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Pago actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexBalancePayment->id)
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
    | Delete a Complex Balance Payment
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific ComplexBalancePayment
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance Payment. Example : 3      |
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
    |        "message": "Pago eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "withdrawal_id": 2,
    |            "payment_id": 3,
    |            "created_at": "2020-12-11T02:06:47.000000Z",
    |            "updated_at": "2020-12-11T02:06:47.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($payment_id)
    {
        try {
            $ComplexBalancePayment = ComplexBalancePayment::find($payment_id);


            if (!is_null($ComplexBalancePayment)) {
                $ComplexBalancePayment->destroy($payment_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Pago eliminado satisfactoriamente.",
                    "data" => $ComplexBalancePayment
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Pago no encontrado.",
                    "data" => $ComplexBalancePayment
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
    |    for validations when you create or update a Complex Balance Payment
    |
    */
    public function getRules() {
        return [
            'withdrawal_id' => 'required|exists:complex_balance_withdrawals,id',
            'payment_id' => 'required|exists:payments,id',
        ];
    }

    public function getMessages() {
        return [
            'withdrawal_id.required' => 'Debe elegir un Saldo de Retiro',
            'withdrawal_id.exists' => 'No existe el Saldo de Retiro',
            'payment_id.required' => 'Debe elegir un Pago',
            'payment_id.exists' => 'No existe el Pago',
        ];
    }
}
