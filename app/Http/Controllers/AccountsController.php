<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Account
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Account
    |
    |   {
    |        "method_id" : 1,
    |        "complex_id" : 1,
    |        "bank_id" : 1,
    |        "owner" : "Nick Cave",
    |        "number" : "710",
    |        "card" : "0044 9889 5581 2552",
    |        "clabe" : "3728478928-3"
    |    }
    |
    |
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
    |                        "id": 3,
    |                        "method_id": 1,
    |                        "complex_id": 1,
    |                        "bank_id": 1,
    |                        "owner": "Nick Cave",
    |                        "number": "710",
    |                        "card": "0044 9889 5581 2552",
    |                        "clabe": "3728478928-3",
    |                        "created_at": "2020-12-02T02:44:58.000000Z",
    |                        "updated_at": "2020-12-02T02:44:58.000000Z",
    |                        "deleted_at": null,
    |                        "method": {
    |                            "id": 1,
    |                            "name": "Paypal",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-11-30T17:36:43.000000Z",
    |                            "updated_at": "2020-11-30T17:36:43.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "complex": {
    |                            "id": 1,
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
    |                            "updated_at": null,
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
            $Account = Account::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuenta creada satisfactoriamente.",
                "data" => $this->getByID($Account->id)
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
    |                "method_id": 1,
    |                "complex_id": 1,
    |                "bank_id": 1,
    |                "owner": "JARISFE",
    |                "number": "123",
    |                "card": "RQWER",
    |                "clabe": "1234QE312WE",
    |                "created_at": "2020-11-30T18:06:50.000000Z",
    |                "updated_at": "2020-11-30T18:06:50.000000Z",
    |                "deleted_at": null,
    |                "method": {
    |                    "id": 1,
    |                    "name": "Paypal",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-11-30T17:36:43.000000Z",
    |                    "updated_at": "2020-11-30T17:36:43.000000Z",
    |                    "deleted_at": null
    |                },
    |                "complex": {
    |                    "id": 1,
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
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "method_id": 1,
    |                "complex_id": 1,
    |                "bank_id": 1,
    |                "owner": "Nick Cave",
    |                "number": "710",
    |                "card": "0044 9889 5581 2552",
    |                "clabe": "3728478928-3",
    |                "created_at": "2020-12-02T02:39:20.000000Z",
    |                "updated_at": "2020-12-02T02:39:20.000000Z",
    |                "deleted_at": null,
    |                "method": {
    |                    "id": 1,
    |                    "name": "Paypal",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-11-30T17:36:43.000000Z",
    |                    "updated_at": "2020-11-30T17:36:43.000000Z",
    |                    "deleted_at": null
    |                },
    |                "complex": {
    |                    "id": 1,
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
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            },
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $Accounts = Account::with('method')
                    ->with('complex')
                    ->with('bank')->get();
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
   | Get Account by ID
   |--------------------------------------------------------------------------
   |   With this service you can get an specific Account
   |   using the following parameter:
   |
   |   ____________________________________________________________________
   |  | Parameter  | Kind	| Required | Details                           |
   |  |--------------------------------------------------------------------|
   |  |    id      | number | True	   | Indicate the ID of the Account    |
   |  |            |        |          | Example : 3                       |
   |  |____________|________|__________|___________________________________|
   |
   |
   |--------------------------------------------------------------------------
   | Response Success
   |--------------------------------------------------------------------------
   |
   |     {
   |         "response": "success",
   |         "message": "Cuenta recuperada satisfactoriamente.",
   |         "data": [
   |             {
   |                 "id": 3,
   |                 "method_id": 1,
   |                 "complex_id": 1,
   |                 "bank_id": 1,
   |                 "owner": "Nick Cave",
   |                 "number": "710",
   |                 "card": "0044 9889 5581 2552",
   |                 "clabe": "3728478928-3",
   |                 "created_at": "2020-12-02T02:44:58.000000Z",
   |                 "updated_at": "2020-12-02T02:44:58.000000Z",
   |                 "deleted_at": null,
   |                 "method": {
   |                     "id": 1,
   |                     "name": "Paypal",
   |                     "description": "Lorem Ipsum Dolor",
   |                     "created_at": "2020-11-30T17:36:43.000000Z",
   |                     "updated_at": "2020-11-30T17:36:43.000000Z",
   |                     "deleted_at": null
   |                 },
   |                 "complex": {
   |                     "id": 1,
   |                     "owner_id": 1,
   |                     "admin_id": 2,
   |                     "created_by": 2,
   |                     "type_id": 1,
   |                     "use_id": 1,
   |                     "name": "Cluster BRC",
   |                     "created_at": "2020-11-24T23:09:39.000000Z",
   |                     "updated_at": null,
   |                     "deleted_at": null
   |                 },
   |                 "bank": {
   |                     "id": 1,
   |                     "name": "Grinderman",
   |                     "company": "Bad Seds",
   |                     "created_at": null,
   |                     "updated_at": null,
   |                     "deleted_at": null
   |                 }
   |             }
   |         ]
   |     }
   |
   |
   */
   public function getByID($id) {
       try{
           $account = Account::find($id);

           if (is_null($account)) {
               return response()->json([
                   "response" => "error",
                   "message" => "Cuenta no encontrada.",
                   "data" => $account
               ]);
           } else {
               $account = $account
                   ->with('method')
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
    | Update an Account
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Account
    |
    |   {
    |        "id" : 2,
    |        "method_id" : 1,
    |        "complex_id" : 1,
    |        "bank_id" : 1,
    |        "owner" : "Nick Cave",
    |        "number" : "710",
    |        "card" : "4432 3543 6634 1321",
    |        "clabe" : "234141234123-32"
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
    |                        "method_id": 1,
    |                        "complex_id": 1,
    |                        "bank_id": 1,
    |                        "owner": "Nick Cave",
    |                        "number": "710",
    |                        "card": "4432 3543 6634 1321",
    |                        "clabe": "234141234123-32",
    |                        "created_at": "2020-12-02T02:39:20.000000Z",
    |                        "updated_at": "2020-12-02T02:54:03.000000Z",
    |                        "deleted_at": null,
    |                        "method": {
    |                            "id": 1,
    |                            "name": "Paypal",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-11-30T17:36:43.000000Z",
    |                            "updated_at": "2020-11-30T17:36:43.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "complex": {
    |                            "id": 1,
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
    |                            "updated_at": null,
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
            $Account = Account::findOrFail($request->id);

            $Account->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuenta actualizada satisafactoriamente.",
                "data" => $this->getByID($Account->id)
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
    | Delete an Account
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Account
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Account    |
    |  |            |        |          | Example : 3                       |
    |  |            |        |          |                                   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuenta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "method_id": 1,
    |            "complex_id": 1,
    |            "bank_id": 1,
    |            "owner": "Nick Cave",
    |            "number": "710",
    |            "card": "0044 9889 5581 2552",
    |            "clabe": "3728478928-3",
    |            "created_at": "2020-12-02T02:44:58.000000Z",
    |            "updated_at": "2020-12-02T02:44:58.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($account_id)
    {
        try {
            $Account = Account::find($account_id);


            if (!is_null($Account)) {
                $Account->destroy($account_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuenta eliminada satisfactoriamente.",
                    "data" => $Account
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $Account
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
    |    for validations when you create or update an Account
    |
    */
    public function getRules() {
        return [
            'method_id' => 'required|exists:methods,id',
            'complex_id' => 'required|exists:complexes,id',
            'bank_id' => 'required|exists:banks,id',
            'owner' => 'required',
            'number' => 'required',
            'card' => 'required',
            'clabe' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'method_id.required' => 'Debe elegir un Método',
            'method_id.exists' => 'No existe el Método',
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
            'bank_id.required' => 'Debe elegir un Banco',
            'bank_id.exists' => 'No existe el Banco',
            'owner.required' => 'Debe escribir un propietario',
            'number.required' => 'Debe escribir un número',
            'card.required' => 'Debe escribir una Tarjeta',
            'clabe.require' => 'Debe escribir una Clabe',
        ];
    }
}
