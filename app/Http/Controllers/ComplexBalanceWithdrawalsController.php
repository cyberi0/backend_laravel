<?php

namespace App\Http\Controllers;

use App\Models\ComplexBalanceWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexBalanceWithdrawalsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Balance Withdrawal
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an ComplexBalanceWithDrawal
    |
    |   {
    |        "complex_id" : 2,
    |        "account_id" : 1,
    |        "amount" : 1000.00,
    |        "receipt" : 500.00,
    |        "withdrawn_at" : "2020-12-04 15:28:46",
    |        "withdrawn_by": 1
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Saldo de Retiro creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Saldo de Retiro recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 2,
    |                        "account_id": 1,
    |                        "amount": "1000.00",
    |                        "receipt": "500",
    |                        "created_at": "2020-12-11T01:45:02.000000Z",
    |                        "updated_at": "2020-12-11T01:45:02.000000Z",
    |                        "deleted_at": null,
    |                        "withdrawn_at": "2020-12-04 15:28:46",
    |                        "withdrawn_by": 1,
    |                        "complex": {
    |                            "id": 2,
    |                            "owner_id": 1,
    |                            "admin_id": 2,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Cluster BRC",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": null,
    |                            "deleted_at": null
    |                        },
    |                        "account": {
    |                            "id": 1,
    |                            "method_id": 1,
    |                            "complex_id": 2,
    |                            "bank_id": 1,
    |                            "owner": "JARISFE",
    |                            "number": "123",
    |                            "card": "RQWER",
    |                            "clabe": "1234QE312WE",
    |                            "created_at": "2020-12-04T11:41:34.000000Z",
    |                            "updated_at": "2020-12-04T11:41:34.000000Z",
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
            $ComplexBalanceWithDrawal = ComplexBalanceWithdrawal::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Saldo de Retiro creado satisfactoriamente.",
                "data" => $this->getByID($ComplexBalanceWithDrawal->id)
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
    | Get All Complex Balance Withdrawal
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Balance Withdrawal
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
    |                "complex_id": 2,
    |                "account_id": 1,
    |                "amount": "1000.00",
    |                "receipt": "500",
    |                "created_at": "2020-12-11T01:45:02.000000Z",
    |                "updated_at": "2020-12-11T01:45:02.000000Z",
    |                "deleted_at": null,
    |                "withdrawn_at": "2020-12-04 15:28:46",
    |                "withdrawn_by": 1,
    |                "complex": {
    |                    "id": 2,
    |                    "owner_id": 1,
    |                    "admin_id": 2,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Cluster BRC",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                },
    |                "account": {
    |                    "id": 1,
    |                    "method_id": 1,
    |                    "complex_id": 2,
    |                    "bank_id": 1,
    |                    "owner": "JARISFE",
    |                    "number": "123",
    |                    "card": "RQWER",
    |                    "clabe": "1234QE312WE",
    |                    "created_at": "2020-12-04T11:41:34.000000Z",
    |                    "updated_at": "2020-12-04T11:41:34.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "account_id": 1,
    |                "amount": "1500.00",
    |                "receipt": "700",
    |                "created_at": "2020-12-11T01:49:35.000000Z",
    |                "updated_at": "2020-12-11T01:49:35.000000Z",
    |                "deleted_at": null,
    |                "withdrawn_at": "2020-12-04 17:30:40",
    |                "withdrawn_by": 2,
    |                "complex": {
    |                    "id": 2,
    |                    "owner_id": 1,
    |                    "admin_id": 2,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Cluster BRC",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                },
    |                "account": {
    |                    "id": 1,
    |                    "method_id": 1,
    |                    "complex_id": 2,
    |                    "bank_id": 1,
    |                    "owner": "JARISFE",
    |                    "number": "123",
    |                    "card": "RQWER",
    |                    "clabe": "1234QE312WE",
    |                    "created_at": "2020-12-04T11:41:34.000000Z",
    |                    "updated_at": "2020-12-04T11:41:34.000000Z",
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
            $ComplexBalanceWithDrawals = ComplexBalanceWithdrawal::with('complex')
                ->with('account')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexBalanceWithDrawals
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
    | Get Complex Balance Withdrawal by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Balance Withdrawal
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Complex     |
    |  |            |        |         | Balance Withdrawal. Example : 2    |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Saldo de Retiro recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "account_id": 1,
    |                "amount": "1500.00",
    |                "receipt": "700",
    |                "created_at": "2020-12-11T01:49:35.000000Z",
    |                "updated_at": "2020-12-11T01:49:35.000000Z",
    |                "deleted_at": null,
    |                "withdrawn_at": "2020-12-04 17:30:40",
    |                "withdrawn_by": 2,
    |                "complex": {
    |                    "id": 2,
    |                    "owner_id": 1,
    |                    "admin_id": 2,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Cluster BRC",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                },
    |                "account": {
    |                    "id": 1,
    |                    "method_id": 1,
    |                    "complex_id": 2,
    |                    "bank_id": 1,
    |                    "owner": "JARISFE",
    |                    "number": "123",
    |                    "card": "RQWER",
    |                    "clabe": "1234QE312WE",
    |                    "created_at": "2020-12-04T11:41:34.000000Z",
    |                    "updated_at": "2020-12-04T11:41:34.000000Z",
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
            $account = ComplexBalanceWithdrawal::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Saldo de Retiro no encontrada.",
                    "data" => $account
                ]);
            } else {
                $account = $account
                    ->with('complex')
                    ->with('account')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Saldo de Retiro recuperado satisfactoriamente.",
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
    | Update an Complex Balance Withdrawal
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Complex Balance Withdrawal
    |
    |   {
    |        "id" : 2,
    |        "complex_id" : 2,
    |        "account_id" : 1,
    |        "amount" : 1700.00,
    |        "receipt" : 300.00,
    |        "withdrawn_at" : "2020-12-04 17:30:40",
    |        "withdrawn_by": 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Saldo de Retiro actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Saldo de Retiro recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 2,
    |                        "account_id": 1,
    |                        "amount": "1700.00",
    |                        "receipt": "300",
    |                        "created_at": "2020-12-11T01:49:35.000000Z",
    |                        "updated_at": "2020-12-11T01:53:20.000000Z",
    |                        "deleted_at": null,
    |                        "withdrawn_at": "2020-12-04 17:30:40",
    |                        "withdrawn_by": 2,
    |                        "complex": {
    |                            "id": 2,
    |                            "owner_id": 1,
    |                            "admin_id": 2,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Cluster BRC",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": null,
    |                            "deleted_at": null
    |                        },
    |                        "account": {
    |                            "id": 1,
    |                            "method_id": 1,
    |                            "complex_id": 2,
    |                            "bank_id": 1,
    |                            "owner": "JARISFE",
    |                            "number": "123",
    |                            "card": "RQWER",
    |                            "clabe": "1234QE312WE",
    |                            "created_at": "2020-12-04T11:41:34.000000Z",
    |                            "updated_at": "2020-12-04T11:41:34.000000Z",
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
            $ComplexBalanceWithDrawal = ComplexBalanceWithdrawal::findOrFail($request->id);

            $ComplexBalanceWithDrawal->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Saldo de Retiro actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexBalanceWithDrawal->id)
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
    | Delete an Complex Balance Withdrawal
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Balance Withdrawal
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance With Drawal. Example : 1  |
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
    |        "message": "Saldo de Retiro eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "complex_id": 2,
    |            "account_id": 1,
    |            "amount": "1000.00",
    |            "receipt": "500",
    |            "created_at": "2020-12-11T01:45:02.000000Z",
    |            "updated_at": "2020-12-11T01:45:02.000000Z",
    |            "deleted_at": null,
    |            "withdrawn_at": "2020-12-04 15:28:46",
    |            "withdrawn_by": 1
    |        }
    |    }
    |
    |
    */
    public function delete($withdrawal_id)
    {
        try {
            $ComplexBalanceWithDrawal = ComplexBalanceWithdrawal::find($withdrawal_id);


            if (!is_null($ComplexBalanceWithDrawal)) {
                $ComplexBalanceWithDrawal->destroy($withdrawal_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Saldo de Retiro eliminada satisfactoriamente.",
                    "data" => $ComplexBalanceWithDrawal
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Saldo de Retiro no encontrada.",
                    "data" => $ComplexBalanceWithDrawal
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
    | Create or Update Complex Balance Withdrawal Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an ComplexBalanceWithDrawal
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
        ];
    }
}
