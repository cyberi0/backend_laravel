<?php

namespace App\Http\Controllers;

use App\Models\ProviderAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderAccountsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Provider Accounts
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Provider Accounts
    |
    |    {
    |        "method_id" : 1,
    |        "provider_id": 1,
    |        "bank_id": 1,
    |        "owner": "Moon Safari",
    |        "number" : "6451 2144 2342 2312",
    |        "card": "Lorem Ipsum dolor",
    |        "clabe": "42983792983424"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuenta creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "method_id": 1,
    |                        "provider_id": 1,
    |                        "bank_id": 1,
    |                        "owner": "Moon Safari",
    |                        "number": "6451 2144 2342 2312",
    |                        "card": "Lorem Ipsum dolor",
    |                        "clabe": "42983792983424",
    |                        "created_at": "2020-12-03T18:51:04.000000Z",
    |                        "updated_at": "2020-12-03T18:51:04.000000Z",
    |                        "deleted_at": null,
    |                        "method": {
    |                            "id": 1,
    |                            "name": "Paypal",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-03T12:46:00.000000Z",
    |                            "updated_at": "2020-12-03T12:46:00.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "provider": {
    |                            "id": 1,
    |                            "category_id": 1,
    |                            "company": "Murder Ballads",
    |                            "contact_names": "Nick Polly",
    |                            "contact_surnames": "Cave Harvey",
    |                            "email": "herny@lee.cav",
    |                            "phone": "44888521156",
    |                            "mobile": "987321542",
    |                            "created_at": "2020-12-03T12:49:29.000000Z",
    |                            "updated_at": "2020-12-03T12:49:29.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "bank": {
    |                            "id": 1,
    |                            "name": "Grinderman",
    |                            "company": "Bad Seds",
    |                            "created_at": null,
    |                            "updated_at": "2020-12-03T12:46:03.000000Z",
    |                            "deleted_at": "2020-12-03 12:46:03"
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
            $ProviderAccount = ProviderAccount::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuenta creada satisfactoriamente.",
                "data" => $this->getByID($ProviderAccount->id)
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
    | Get All Provider Accounts
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Provider Accounts
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Lista recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "method_id": 1,
    |                "provider_id": 1,
    |                "bank_id": 1,
    |                "owner": "Moon Safari",
    |                "number": "6451 2144 2342 2312",
    |                "card": "Lorem Ipsum dolor",
    |                "clabe": "42983792983424",
    |                "created_at": "2020-12-03T18:50:23.000000Z",
    |                "updated_at": "2020-12-03T18:50:23.000000Z",
    |                "deleted_at": null,
    |                "method": {
    |                    "id": 1,
    |                    "name": "Paypal",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-03T12:46:00.000000Z",
    |                    "updated_at": "2020-12-03T12:46:00.000000Z",
    |                    "deleted_at": null
    |                },
    |                "provider": {
    |                    "id": 1,
    |                    "category_id": 1,
    |                    "company": "Murder Ballads",
    |                    "contact_names": "Nick Polly",
    |                    "contact_surnames": "Cave Harvey",
    |                    "email": "herny@lee.cav",
    |                    "phone": "44888521156",
    |                    "mobile": "987321542",
    |                    "created_at": "2020-12-03T12:49:29.000000Z",
    |                    "updated_at": "2020-12-03T12:49:29.000000Z",
    |                    "deleted_at": null
    |                },
    |                "bank": {
    |                    "id": 1,
    |                    "name": "Grinderman",
    |                    "company": "Bad Seds",
    |                    "created_at": null,
    |                    "updated_at": "2020-12-03T12:46:03.000000Z",
    |                    "deleted_at": "2020-12-03 12:46:03"
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "method_id": 1,
    |                "provider_id": 1,
    |                "bank_id": 1,
    |                "owner": "Moon Safari",
    |                "number": "6451 2144 2342 2312",
    |                "card": "Lorem Ipsum dolor",
    |                "clabe": "42983792983424",
    |                "created_at": "2020-12-03T18:51:04.000000Z",
    |                "updated_at": "2020-12-03T18:51:04.000000Z",
    |                "deleted_at": null,
    |                "method": {
    |                    "id": 1,
    |                    "name": "Paypal",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-03T12:46:00.000000Z",
    |                    "updated_at": "2020-12-03T12:46:00.000000Z",
    |                    "deleted_at": null
    |                },
    |                "provider": {
    |                    "id": 1,
    |                    "category_id": 1,
    |                    "company": "Murder Ballads",
    |                    "contact_names": "Nick Polly",
    |                    "contact_surnames": "Cave Harvey",
    |                    "email": "herny@lee.cav",
    |                    "phone": "44888521156",
    |                    "mobile": "987321542",
    |                    "created_at": "2020-12-03T12:49:29.000000Z",
    |                    "updated_at": "2020-12-03T12:49:29.000000Z",
    |                    "deleted_at": null
    |                },
    |                "bank": {
    |                    "id": 1,
    |                    "name": "Grinderman",
    |                    "company": "Bad Seds",
    |                    "created_at": null,
    |                    "updated_at": "2020-12-03T12:46:03.000000Z",
    |                    "deleted_at": "2020-12-03 12:46:03"
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $ProviderAccount = ProviderAccount::with('method')
                ->with('provider')
                ->with('bank')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ProviderAccount
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
    | Get Provider Account by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Provider Account
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Provider   |
    |  |            |        |          | Account. Example : 2              |
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
    |                "method_id": 1,
    |                "provider_id": 1,
    |                "bank_id": 1,
    |                "owner": "Moon Safari",
    |                "number": "6451 2144 2342 2312",
    |                "card": "Lorem Ipsum dolor",
    |                "clabe": "42983792983424",
    |                "created_at": "2020-12-03T18:51:04.000000Z",
    |                "updated_at": "2020-12-03T18:51:04.000000Z",
    |                "deleted_at": null,
    |                "method": {
    |                    "id": 1,
    |                    "name": "Paypal",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-03T12:46:00.000000Z",
    |                    "updated_at": "2020-12-03T12:46:00.000000Z",
    |                    "deleted_at": null
    |                },
    |                "provider": {
    |                    "id": 1,
    |                    "category_id": 1,
    |                    "company": "Murder Ballads",
    |                    "contact_names": "Nick Polly",
    |                    "contact_surnames": "Cave Harvey",
    |                    "email": "herny@lee.cav",
    |                    "phone": "44888521156",
    |                    "mobile": "987321542",
    |                    "created_at": "2020-12-03T12:49:29.000000Z",
    |                    "updated_at": "2020-12-03T12:49:29.000000Z",
    |                    "deleted_at": null
    |                },
    |                "bank": {
    |                    "id": 1,
    |                    "name": "Grinderman",
    |                    "company": "Bad Seds",
    |                    "created_at": null,
    |                    "updated_at": "2020-12-03T12:46:03.000000Z",
    |                    "deleted_at": "2020-12-03 12:46:03"
    |                }
    |            }
    |        ]
    |    }
    |
    */
    public function getByID($id) {
        try{
            $ProviderAccount = ProviderAccount::find($id);

            if (is_null($ProviderAccount)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                ]);
            } else {
                $ProviderAccount = $ProviderAccount
                    ->with('method')
                    ->with('provider')
                    ->with('bank')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Cuenta recuperada satisfactoriamente.",
                "data" => $ProviderAccount
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
    | Update Provider Account
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Provider Account
    |
    |   {
    |        "id": 2,
    |        "method_id" : 1,
    |        "provider_id": 1,
    |        "bank_id": 1,
    |        "owner": "Moon Safari II",
    |        "number" : "6451 2144 2342 2312",
    |        "card": "Lorem Ipsum dolor",
    |        "clabe": "42983792983424"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
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
    |                        "provider_id": 1,
    |                        "bank_id": 1,
    |                        "owner": "Moon Safari II",
    |                        "number": "6451 2144 2342 2312",
    |                        "card": "Lorem Ipsum dolor",
    |                        "clabe": "42983792983424",
    |                        "created_at": "2020-12-03T18:51:04.000000Z",
    |                        "updated_at": "2020-12-03T19:43:54.000000Z",
    |                        "deleted_at": null,
    |                        "method": {
    |                            "id": 1,
    |                            "name": "Paypal",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-03T12:46:00.000000Z",
    |                            "updated_at": "2020-12-03T12:46:00.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "provider": {
    |                            "id": 1,
    |                            "category_id": 1,
    |                            "company": "Murder Ballads",
    |                            "contact_names": "Nick Polly",
    |                            "contact_surnames": "Cave Harvey",
    |                            "email": "herny@lee.cav",
    |                            "phone": "44888521156",
    |                            "mobile": "987321542",
    |                            "created_at": "2020-12-03T12:49:29.000000Z",
    |                            "updated_at": "2020-12-03T12:49:29.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "bank": {
    |                            "id": 1,
    |                            "name": "Grinderman",
    |                            "company": "Bad Seds",
    |                            "created_at": null,
    |                            "updated_at": "2020-12-03T12:46:03.000000Z",
    |                            "deleted_at": "2020-12-03 12:46:03"
    |                        }
    |                    }
    |                ]
    |            },
    |            "exception": null
    |        }
    |    }
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
            $ProviderAccount = ProviderAccount::findOrFail($request->id);
            $ProviderAccount->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuenta actualizada satisafactoriamente.",
                "data" => $this->getByID($ProviderAccount->id)
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
    | Delete Provider Account
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Provider Account
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Provider   |
    |  |            |        |          | Account. Example : 2              |
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
    |            "id": 2,
    |            "method_id": 1,
    |            "provider_id": 1,
    |            "bank_id": 1,
    |            "owner": "Moon Safari II",
    |            "number": "6451 2144 2342 2312",
    |            "card": "Lorem Ipsum dolor",
    |            "clabe": "42983792983424",
    |            "created_at": "2020-12-03T18:51:04.000000Z",
    |            "updated_at": "2020-12-03T19:43:54.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($provider_account_id)
    {
        try {
            $ProviderAccount = ProviderAccount::find($provider_account_id);


            if (!is_null($ProviderAccount)) {
                $ProviderAccount->destroy($provider_account_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuenta eliminada satisfactoriamente.",
                    "data" => $ProviderAccount
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $ProviderAccount
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
            'provider_id' => 'required|exists:complex_providers,id',
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
            'provider_id.required' => 'Debe elegir un Proveedor',
            'provider_id.exists' => 'No existe el Proveedor',
            'bank_id.required' => 'Debe elegir un Banco',
            'bank_id.exists' => 'No existe el Banco',
            'owner' => 'Debe escribir un propietario',
            'number' => 'Debe escribir un número',
            'card' => 'Debe escribir una Tarjeta',
            'clabe' => 'Debe escribir una Clabe',
        ];
    }
}
