<?php

namespace App\Http\Controllers;

use App\Models\ComplexBalanceAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexBalanceAccountsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create ComplexBalanceAccount
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an ComplexBalanceAccount
    |
    |   {
    |        "complex_id": 2,
    |        "bank_id" : 1,
    |        "owner" : "Emir Kusturica",
    |        "interbank" : "1297512835198",
    |        "number" : "1973 7289 7583 6357",
    |        "branch" : "Underground",
    |        "card" : "American Express"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuenta creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 2,
    |                        "bank_id": 1,
    |                        "owner": "Emir Kusturica",
    |                        "interbank": "1297512835198",
    |                        "number": "1973 7289 7583 6357",
    |                        "branch": "Underground",
    |                        "card": "American Express",
    |                        "created_at": "2020-12-10T00:59:27.000000Z",
    |                        "updated_at": "2020-12-10T00:59:27.000000Z",
    |                        "deleted_at": null,
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
    |                        "bank": {
    |                            "id": 1,
    |                            "name": "Grinderman",
    |                            "company": "Bad Seds",
    |                            "created_at": null,
    |                            "updated_at": "2020-12-04T11:41:11.000000Z",
    |                            "deleted_at": "2020-12-04 11:41:11"
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
            $ComplexBalanceAccount = ComplexBalanceAccount::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuenta creada satisfactoriamente.",
                "data" => $this->getByID($ComplexBalanceAccount->id)
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
    | Get All Accounts
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Accounts
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
    |                "bank_id": 1,
    |                "owner": "Emir Kusturica",
    |                "interbank": "1297512835198",
    |                "number": "1973 7289 7583 6357",
    |                "branch": "Underground",
    |                "card": "American Express",
    |                "created_at": "2020-12-10T00:59:27.000000Z",
    |                "updated_at": "2020-12-10T00:59:27.000000Z",
    |                "deleted_at": null,
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
    |                "bank": {
    |                    "id": 1,
    |                    "name": "Grinderman",
    |                    "company": "Bad Seds",
    |                    "created_at": null,
    |                    "updated_at": "2020-12-04T11:41:11.000000Z",
    |                    "deleted_at": "2020-12-04 11:41:11"
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "bank_id": 1,
    |                "owner": "Simon Posford",
    |                "interbank": "1127415233138",
    |                "number": "5345 7567 5345 0890",
    |                "branch": "Hallucinogen",
    |                "card": "American Express",
    |                "created_at": "2020-12-10T01:03:21.000000Z",
    |                "updated_at": "2020-12-10T01:03:21.000000Z",
    |                "deleted_at": null,
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
    |                "bank": {
    |                    "id": 1,
    |                    "name": "Grinderman",
    |                    "company": "Bad Seds",
    |                    "created_at": null,
    |                    "updated_at": "2020-12-04T11:41:11.000000Z",
    |                    "deleted_at": "2020-12-04 11:41:11"
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $ComplexBalanceAccounts = ComplexBalanceAccount::with('complex')
                ->with('bank')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexBalanceAccounts
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
    | Get Complex Balance Account by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific ComplexBalanceAccount
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance Account. Example : 2      |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuenta recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "bank_id": 1,
    |                "owner": "Simon Posford",
    |                "interbank": "1127415233138",
    |                "number": "5345 7567 5345 0890",
    |                "branch": "Hallucinogen",
    |                "card": "American Express",
    |                "created_at": "2020-12-10T01:03:21.000000Z",
    |                "updated_at": "2020-12-10T01:03:21.000000Z",
    |                "deleted_at": null,
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
    |                "bank": {
    |                    "id": 1,
    |                    "name": "Grinderman",
    |                    "company": "Bad Seds",
    |                    "created_at": null,
    |                    "updated_at": "2020-12-04T11:41:11.000000Z",
    |                    "deleted_at": "2020-12-04 11:41:11"
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $account = ComplexBalanceAccount::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $account
                ]);
            } else {
                $account = $account
                    ->with('complex')
                    ->with('bank')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Cuenta recuperada satisfactoriamente.",
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
    | Update a Complex Balance Account
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex Balance Account
    |
    |   {
    |        "id": 2,
    |        "complex_id": 2,
    |        "bank_id" : 1,
    |        "owner" : "Simon Posford",
    |        "interbank" : "1127415233138",
    |        "number" : "5345 7567 5345 0890",
    |        "branch" : "Hallucinogen Dub",
    |        "card" : "American Express"
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
    |                        "complex_id": 2,
    |                        "bank_id": 1,
    |                        "owner": "Simon Posford",
    |                        "interbank": "1127415233138",
    |                        "number": "5345 7567 5345 0890",
    |                        "branch": "Hallucinogen Dub",
    |                        "card": "American Express",
    |                        "created_at": "2020-12-10T01:03:21.000000Z",
    |                        "updated_at": "2020-12-10T17:21:30.000000Z",
    |                        "deleted_at": null,
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
    |                        "bank": {
    |                            "id": 1,
    |                            "name": "Grinderman",
    |                            "company": "Bad Seds",
    |                            "created_at": null,
    |                            "updated_at": "2020-12-04T11:41:11.000000Z",
    |                            "deleted_at": "2020-12-04 11:41:11"
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
            $ComplexBalanceAccount = ComplexBalanceAccount::findOrFail($request->id);

            $ComplexBalanceAccount->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuenta actualizada satisafactoriamente.",
                "data" => $this->getByID($ComplexBalanceAccount->id)
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
    | Delete a Complex Balance Account
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Balance Account
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance Account Example : 2       |
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
    |        "message": "Cuenta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "complex_id": 2,
    |            "bank_id": 1,
    |            "owner": "Simon Posford",
    |            "interbank": "1127415233138",
    |            "number": "5345 7567 5345 0890",
    |            "branch": "Hallucinogen Dub",
    |            "card": "American Express",
    |            "created_at": "2020-12-10T01:03:21.000000Z",
    |            "updated_at": "2020-12-10T17:21:30.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($account_id)
    {
        try {
            $ComplexBalanceAccount = ComplexBalanceAccount::find($account_id);


            if (!is_null($ComplexBalanceAccount)) {
                $ComplexBalanceAccount->destroy($account_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuenta eliminada satisfactoriamente.",
                    "data" => $ComplexBalanceAccount
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $ComplexBalanceAccount
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
    | Create or Update Complex Balance Accounts Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Complex Balance Account
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'bank_id' => 'required|exists:banks,id',
            'owner' => 'required',
            'interbank' => 'required',
            'number' => 'required',
            'branch' => 'required',
            'card' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
            'bank_id.required' => 'Debe elegir un Banco',
            'bank_id.exists' => 'No existe el Banco',
            'owner' => 'Debe escribir un Propietario',
            'interbank' => 'Debe escribir un Número Interbancario',
            'number' => 'Debe escribir un Número',
            'branch' => 'Debe escribir una Sucursal Bancaria',
            'card' => 'Debe escribir una Tarjeta',
        ];
    }
}
