<?php

namespace App\Http\Controllers;

use App\Models\UserBalanceTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBalanceTransactionsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User Balance Transactions
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Notification
    |
    |    {
    |        "balance_id" : 1,
    |        "payment_id" : 10,
    |        "type" : 1,
    |        "amount" : 1588
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Balance del Usuario creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos de la Balance del Usuario recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "balance_id": 1,
    |                        "payment_id": 10,
    |                        "type": "1",
    |                        "amount": "1588.00",
    |                        "created_at": "2020-12-01T00:37:55.000000Z",
    |                        "updated_at": "2020-12-01T00:37:55.000000Z",
    |                        "deleted_at": null,
    |                        "balance": {
    |                            "id": 1,
    |                            "user_id": 1,
    |                            "balance": "2000.00",
    |                            "created_at": "2020-11-30T21:16:37.000000Z",
    |                            "updated_at": "2020-11-30T21:16:37.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "payment": {
    |                            "id": 10,
    |                            "method_id": 1,
    |                            "account_id": 1,
    |                            "card_id": 2,
    |                            "provider_id": 1,
    |                            "complex_id": 1,
    |                            "property_id": 4,
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
            $userBalance = UserBalanceTransaction::create($input);
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
    | Get All User Balances Transactions
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all User Balances Transactions
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Lista de Balances del Usuario recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "balance_id": 1,
    |                "payment_id": 10,
    |                "type": "1",
    |                "amount": "1588.00",
    |                "created_at": "2020-12-01T00:35:32.000000Z",
    |                "updated_at": "2020-12-01T00:35:32.000000Z",
    |                "deleted_at": null,
    |                "balance": {
    |                    "id": 1,
    |                    "user_id": 1,
    |                    "balance": "2000.00",
    |                    "created_at": "2020-11-30T21:16:37.000000Z",
    |                    "updated_at": "2020-11-30T21:16:37.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payment": {
    |                    "id": 10,
    |                    "method_id": 1,
    |                    "account_id": 1,
    |                    "card_id": 2,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 4,
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
    |                "balance_id": 1,
    |                "payment_id": 10,
    |                "type": "1",
    |                "amount": "1588.00",
    |                "created_at": "2020-12-01T00:37:55.000000Z",
    |                "updated_at": "2020-12-01T00:37:55.000000Z",
    |                "deleted_at": null,
    |                "balance": {
    |                    "id": 1,
    |                    "user_id": 1,
    |                    "balance": "2000.00",
    |                    "created_at": "2020-11-30T21:16:37.000000Z",
    |                    "updated_at": "2020-11-30T21:16:37.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payment": {
    |                    "id": 10,
    |                    "method_id": 1,
    |                    "account_id": 1,
    |                    "card_id": 2,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 4,
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
    */
    public function getAll() {
        try {
            $UserBalances = UserBalanceTransaction::with('balance', 'payment')->get();
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
    | Get User Balance Transaction by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User Balance Transaction
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
    |
    |
    |
    |
    |     {
    |        "response": "success",
    |        "message": "Datos de la Balance del Usuario recuperados satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "balance_id": 1,
    |                "payment_id": 10,
    |                "type": "1",
    |                "amount": "1588.00",
    |                "created_at": "2020-12-01T00:35:32.000000Z",
    |                "updated_at": "2020-12-01T00:35:32.000000Z",
    |                "deleted_at": null,
    |                "balance": {
    |                    "id": 1,
    |                    "user_id": 1,
    |                    "balance": "2000.00",
    |                    "created_at": "2020-11-30T21:16:37.000000Z",
    |                    "updated_at": "2020-11-30T21:16:37.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payment": {
    |                    "id": 10,
    |                    "method_id": 1,
    |                    "account_id": 1,
    |                    "card_id": 2,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 4,
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
    |*/
    public function getByID($id) {
        try {
            $userBalance = UserBalanceTransaction::find($id);

            if (is_null($userBalance)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Balance del Usuario no encontrada.",
                    "data" => $userBalance
                ]);
            } else {
                $userBalance = $userBalance->with('balance','payment')->where('id', $id)->get();
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
    | Update User Balance Transaction
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a User Balance Transaction
    |
    |   {
    |       "id" : 1,
    |       "balance_id" : 1,
    |       "payment_id":10,
    |       "type":1,
    |       "amount":18065
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Balance del Usuario actualizado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos de la Balance del Usuario recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "balance_id": 1,
    |                        "payment_id": 10,
    |                        "type": "1",
    |                        "amount": "18065.00",
    |                        "created_at": "2020-12-01T00:35:32.000000Z",
    |                        "updated_at": "2020-12-01T00:48:00.000000Z",
    |                        "deleted_at": null,
    |                        "balance": {
    |                            "id": 1,
    |                            "user_id": 1,
    |                            "balance": "2000.00",
    |                            "created_at": "2020-11-30T21:16:37.000000Z",
    |                            "updated_at": "2020-11-30T21:16:37.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "payment": {
    |                            "id": 10,
    |                            "method_id": 1,
    |                            "account_id": 1,
    |                            "card_id": 2,
    |                            "provider_id": 1,
    |                            "complex_id": 1,
    |                            "property_id": 4,
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
            $Notification= UserBalanceTransaction::findOrFail($request->id);
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
    | Delete an User Balance Transaction
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Balance
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the            |
    |  |            |        |          | User Balance Transaction.         |
    |  |            |        |          | Example : 3                       |
    |  |____________|________|__________|___________________________________|
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Balance del Usuario eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "balance_id": 2,
    |            "payment_id": 10,
    |            "type": "1",
    |            "amount": "1688.00",
    |            "created_at": "2020-12-01T00:50:18.000000Z",
    |            "updated_at": "2020-12-01T00:50:18.000000Z",
    |            "deleted_at": null
    |        }
    |
    |    }
    */
    public function delete($userBalance_id)
    {
        try {
            $UserBalanceTransaction= UserBalanceTransaction::find($userBalance_id);

            if (!is_null($UserBalanceTransaction)) {
                $UserBalanceTransaction->destroy($userBalance_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Balance del Usuario eliminado satisfactoriamente.",
                    "data" => $UserBalanceTransaction
                ]);
            }else {
                return response()->json([
                    "response" => "error",
                    "message" => "Transacción del Balance del Usuario no encontrada.",
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
            'balance_id' => 'required|exists:user_balances,id',
            'payment_id' => 'required|exists:payments,id',
            'type'=> 'required',
            'amount' => 'required',
        ];
    }
    public function getMessages() {
        return [
            'balance_id.required' => 'Debe elegir el Balance para la transación.',
            'balance_id.exists' => 'El Balance no existe.',
            'payment_id.required' => 'Debe elegir el Pago para la transación.',
            'payment_id.exists' => 'El Pago no existe.',
        ];
    }
}
