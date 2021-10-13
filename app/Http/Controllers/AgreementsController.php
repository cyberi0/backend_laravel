<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgreementsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Agreement
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Agreement
    |
    |    {
    |        "complex_id" : 1,
    |        "created_by" : 1,
    |        "owner_id" : 2,
    |        "occupant_id" : 1,
    |        "property_id" : 2,
    |        "name" : "Pink Pop",
    |        "description" : "Lorem Ipsun Dolor",
    |        "amount" : 1000,
    |        "total" : 1300
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |       "response": "success",
    |       "message": "Acuerdo creado satisfactoriamente.",
    |       "data": {
    |       "headers": {},
    |        "original": {
    |           "response": "success",
    |            "message": "Acuerdo recuperado satisfactoriamente.",
    |            "data": [
    |                {
    |                    "id": 1,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Agreement Death Proof",
    |                    "description": "Lorem ipsum dolor",
    |                    "amount": "1000.00",
    |                    "total": "1016.00",
    |                    "document": null,
    |                    "created_at": "2020-11-28T01:49:05.000000Z",
    |                    "updated_at": "2020-11-28T01:51:47.000000Z",
    |                    "deleted_at": null,
    |                    "payments": [],
    |                    "complex": {
    |                        "id": 1,
    |                        "owner_id": 1,
    |                        "admin_id": 1,
    |                        "created_by": 2,
    |                        "type_id": 1,
    |                        "use_id": 1,
    |                        "name": "Complex Paladium",
    |                        "created_at": "2020-11-28T00:30:50.000000Z",
    |                        "updated_at": "2020-11-28T00:30:50.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    "user": {
    |                        "id": 1,
    |                        "user_id": null,
    |                        "type_id": null,
    |                        "created_by": null,
    |                        "names": "Carlos",
    |                        "surnames": "Laravel",
    |                        "username": "develop2",
    |                        "email": "develop2@wobisoft.com",
    |                        "mobile": "9797968543",
    |                        "curp": null,
    |                        "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": "2020-11-24T23:09:39.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    "owner": {
    |                        "id": 2,
    |                        "user_id": null,
    |                        "type_id": null,
    |                        "created_by": null,
    |                        "names": "Jorge",
    |                        "surnames": "Laravel",
    |                        "username": "develop1",
    |                        "email": "develop1@wobisoft.com",
    |                        "mobile": "9797968543",
    |                        "curp": null,
    |                        "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": "2020-11-24T23:09:39.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    "create_by": {
    |                        "id": 1,
    |                        "user_id": null,
    |                        "type_id": null,
    |                        "created_by": null,
    |                        "names": "Carlos",
    |                        "surnames": "Laravel",
    |                        "username": "develop2",
    |                        "email": "develop2@wobisoft.com",
    |                        "mobile": "9797968543",
    |                        "curp": null,
    |                        "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": "2020-11-24T23:09:39.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    "occupant": {
    |                        "id": 1,
    |                        "user_id": null,
    |                        "type_id": null,
    |                        "created_by": null,
    |                        "names": "Carlos",
    |                        "surnames": "Laravel",
    |                        "username": "develop2",
    |                        "email": "develop2@wobisoft.com",
    |                        "mobile": "9797968543",
    |                        "curp": null,
    |                        "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": "2020-11-24T23:09:39.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    "property": {
    |                        "id": 2,
    |                        "complex_id": 1,
    |                        "type_id": 1,
    |                        "owner_id": 1,
    |                        "occupant_id": 1,
    |                        "name": "Property Proof",
    |                        "floor": null,
    |                        "number": null,
    |                        "contract": null,
    |                        "contract_expired_at": null,
    |                        "proportions": null,
    |                        "document": null,
    |                        "book": null,
    |                        "created_at": null,
    |                        "updated_at": null,
    |                        "deleted_at": null
    |                    }
    |                }
    |            ]
    |        },
    |        "exception": null
    |       }
    |   }
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
            $Agreement = Agreement::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Acuerdo creado satisfactoriamente.",
                "data" => $this->getByID($Agreement->id)
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
    | Get All Agreements
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Agreements
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
    |                "id": 4,
    |                "complex_id": 1,
    |                "created_by": 1,
    |                "owner_id": 2,
    |                "occupant_id": 1,
    |                "property_id": 2,
    |                "name": "Pink Pop",
    |                "description": "Lorem Ipsun Dolor",
    |                "amount": "1000.00",
    |                "total": "1300.00",
    |                "document": null,
    |                "created_at": "2020-11-30T03:33:54.000000Z",
    |                "updated_at": "2020-11-30T03:47:45.000000Z",
    |                "deleted_at": null,
    |                "payments": [
    |                    {
    |                        "id": 6,
    |                        "agreement_id": 4,
    |                        "payment_id": 16,
    |                        "created_at": "2020-11-30T04:47:06.000000Z",
    |                        "updated_at": "2020-11-30T04:47:06.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    {
    |                        "id": 7,
    |                        "agreement_id": 4,
    |                        "payment_id": 16,
    |                        "created_at": "2020-11-30T04:49:15.000000Z",
    |                        "updated_at": "2020-11-30T04:49:15.000000Z",
    |                        "deleted_at": null
    |                    },
    |                ],
    |                "complex": {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium",
    |                    "created_at": "2020-11-28T00:30:50.000000Z",
    |                    "updated_at": "2020-11-28T00:30:50.000000Z",
    |                    "deleted_at": null
    |                },
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
    |                },
    |                "owner": {
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
    |                },
    |                "create_by": {
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
    |                },
    |                "occupant": {
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
    |                     "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 2,
    |                    "complex_id": 1,
    |                    "type_id": 1,
    |                    "owner_id": 1,
    |                    "occupant_id": 1,
    |                    "name": "Property Proof",
    |                    "floor": null,
    |                    "number": null,
    |                    "contract": null,
    |                    "contract_expired_at": null,
    |                    "proportions": null,
    |                    "document": null,
    |                    "book": null,
    |                    "created_at": null,
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    */
    public function getAll() {
        try {
            $Agreements = Agreement::with('payments')
                ->with('complex')
                ->with('user')
                ->with('owner')
                ->with('createBy')
                ->with('occupant')
                ->with('property')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Agreements
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
    | Get Agreement by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Agreement
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Agreement  |
    |  |            |        |          | Example : 4                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Acuerdo recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 4,
    |                "complex_id": 1,
    |                "created_by": 1,
    |                "owner_id": 2,
    |                "occupant_id": 1,
    |                "property_id": 2,
    |                "name": "Pink Pop",
    |                "description": "Lorem Ipsun Dolor",
    |                "amount": "1000.00",
    |                "total": "1300.00",
    |                "document": null,
    |                "created_at": "2020-11-30T03:33:54.000000Z",
    |                "updated_at": "2020-11-30T03:47:45.000000Z",
    |                "deleted_at": null,
    |                "payments": [
    |                    {
    |                        "id": 6,
    |                        "agreement_id": 4,
    |                        "payment_id": 16,
    |                        "created_at": "2020-11-30T04:47:06.000000Z",
    |                        "updated_at": "2020-11-30T04:47:06.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    {
    |                        "id": 7,
    |                        "agreement_id": 4,
    |                        "payment_id": 16,
    |                        "created_at": "2020-11-30T04:49:15.000000Z",
    |                        "updated_at": "2020-11-30T04:49:15.000000Z",
    |                        "deleted_at": null
    |                    },
    |                ],
    |                "complex": {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium",
    |                    "created_at": "2020-11-28T00:30:50.000000Z",
    |                    "updated_at": "2020-11-28T00:30:50.000000Z",
    |                    "deleted_at": null
    |                },
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
    |                },
    |                "owner": {
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
    |                },
    |                "create_by": {
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
    |                },
    |                "occupant": {
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
    |                },
    |                "property": {
    |                    "id": 2,
    |                    "complex_id": 1,
    |                    "type_id": 1,
    |                    "owner_id": 1,
    |                    "occupant_id": 1,
    |                    "name": "Property Proof",
    |                    "floor": null,
    |                    "number": null,
    |                    "contract": null,
    |                    "contract_expired_at": null,
    |                    "proportions": null,
    |                    "document": null,
    |                    "book": null,
    |                    "created_at": null,
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try {
            $Agreement = Agreement::find($id);
            if (is_null($Agreement)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Acuerdo no encontrado.",
                    "data" => $Agreement
                ]);
            } else {
                $Agreement = $Agreement->with('payments')
                    ->with('complex','user','owner','createBy','occupant','property')
                    ->where('id', $id)
                    ->get();
            }
            return response()->json([
                "response" => "success",
                "message" => "Acuerdo recuperado satisfactoriamente.",
                "data" => $Agreement
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
    | Update an Agreement
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Agreement
    |
    |    {
    |        "id" : 1,
    |        "complex_id" : 1,
    |        "created_by" : 1,
    |        "owner_id" : 2,
    |        "occupant_id" : 1,
    |        "property_id" : 2,
    |        "name" : "Pink Pop",
    |        "description" : "Lorem Ipsun Dolor",
    |        "amount" : 1000,
    |        "total" : 1300
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acuerdo Plan actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Acuerdo recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                       "id": 1,
    |                       "complex_id": 1,
    |                        "created_by": 1,
    |                       "owner_id": 2,
    |                        "occupant_id": 1,
    |                        "property_id": 2,
    |                        "name": "Agreement Death Proof",
    |                        "description": "Lorem ipsum dolor",
    |                        "amount": "1000.00",
    |                        "total": "1016.00",
    |                        "document": null,
    |                        "created_at": "2020-11-28T01:49:05.000000Z",
    |                        "updated_at": "2020-11-28T01:51:47.000000Z",
    |                        "deleted_at": null,
    |                        "payments": [],
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 1,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Complex Paladium",
    |                            "created_at": "2020-11-28T00:30:50.000000Z",
    |                            "updated_at": "2020-11-28T00:30:50.000000Z",
    |                            "deleted_at": null
    |                        },
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
    |                        },
    |                        "owner": {
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
    |                        },
    |                        "create_by": {
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
    |                        },
    |                        "occupant": {
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
    |                        },
    |                        "property": {
    |                            "id": 2,
    |                            "complex_id": 1,
    |                            "type_id": 1,
    |                            "owner_id": 1,
    |                            "occupant_id": 1,
    |                            "name": "Property Proof",
    |                            "floor": null,
    |                            "number": null,
    |                            "contract": null,
    |                            "contract_expired_at": null,
    |                            "proportions": null,
    |                            "document": null,
    |                            "book": null,
    |                            "created_at": null,
    |                            "updated_at": null,
    |                            "deleted_at": null
    |                        }
    |                    },
    |                    {
    |                        "id": 4,
    |                        "complex_id": 1,
    |                        "created_by": 1,
    |                        "owner_id": 2,
    |                        "occupant_id": 1,
    |                        "property_id": 2,
    |                        "name": "Pink Pop",
    |                        "description": "Lorem Ipsun Dolor",
    |                        "amount": "1000.00",
    |                        "total": "1300.00",
    |                        "document": null,
    |                        "created_at": "2020-11-30T03:33:54.000000Z",
    |                        "updated_at": "2020-11-30T03:47:45.000000Z",
    |                        "deleted_at": null,
    |                        "payments": [],
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 1,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Complex Paladium",
    |                            "created_at": "2020-11-28T00:30:50.000000Z",
    |                            "updated_at": "2020-11-28T00:30:50.000000Z",
    |                            "deleted_at": null
    |                        },
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
    |                        },
    |                        "owner": {
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
    |                        },
    |                        "create_by": {
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
    |                        },
    |                        "occupant": {
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
    |                        },
    |                        "property": {
    |                            "id": 2,
    |                            "complex_id": 1,
    |                            "type_id": 1,
    |                            "owner_id": 1,
    |                            "occupant_id": 1,
    |                            "name": "Property Proof",
    |                            "floor": null,
    |                            "number": null,
    |                            "contract": null,
    |                            "contract_expired_at": null,
    |                            "proportions": null,
    |                            "document": null,
    |                            "book": null,
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
            $Agreement = Agreement::findOrFail($request->id);
            $Agreement->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Acuerdo Plan actualizado satisafactoriamente.",
                "data" => $this->getByID($Agreement->id)
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
    | Delete an Agreement
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Agreement
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Agreement  |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |            "response": "success",
    |            "message": "Acuerdo eliminado satisfactoriamente.",
    |            "data": {
    |                "id": 1,
    |                "complex_id": 1,
    |                "created_by": 1,
    |                "owner_id": 2,
    |                "occupant_id": 1,
    |                "property_id": 2,
    |                "name": "Agreement Death Proof",
    |                "description": "Lorem ipsum dolor",
    |                "amount": "1000.00",
    |                "total": "1016.00",
    |                "document": null,
    |                "created_at": "2020-11-28T01:49:05.000000Z",
    |                "updated_at": "2020-11-28T01:51:47.000000Z",
    |                "deleted_at": null
    |            }
    |        }
    |
    |
    */
    public function delete($agreement_id)
    {
        try {
            $Agreement = Agreement::find($agreement_id);
            $Agreement->destroy($agreement_id);
            return response()->json([
                "response" => "success",
                "message" => "Acuerdo eliminado satisfactoriamente.",
                "data" => $Agreement
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
    | Create or Update Agreement Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Agreement
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'created_by' => 'required|exists:users,id',
            'owner_id' => 'required|exists:users,id',
            'occupant_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'total' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir el Complejo.',
            'complex_id.exists' => 'No existe el Complejo.',
            'created_by.required' => 'Debe elegir por quién fué creado.',
            'owner_id.required' => 'Debe elegir el Propietario.',
            'owner_id.exists' => 'No existe el Propietario.',
            'occupant_id.required' => 'Debe elegir el Ocupante.',
            'occupant_id.exists' => 'No existe el Ocupante.',
            'property_id.required' => 'Debe elegir la Propiedad.',
            'property_id.exists' => 'No existe la Propiedad.',
            'name.required' => 'Debe escribir un Nombre.',
            'description.required' => 'Debe escribir una Descripción.',
            'amount.required' => 'Debe ingresar un Monto.',
            'total.required' => 'Debe ingresar el Total.'
        ];
    }
}
