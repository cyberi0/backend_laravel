<?php

namespace App\Http\Controllers;
use App\Models\Complex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Create Complex
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Complex
    |
    |    {
    |        "name" : "Complex Paladium II",
    |        "owner_id" : 1,
    |        "admin_id" : 1,
    |        "created_by" : 2,
    |        "type_id" : 1,
    |        "use_id" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |    "response": "success",
    |    "message": "Complejo creado satisfactoriamente.",
    |    "data": {
    |        "headers": {},
    |        "original": {
    |            "response": "success",
    |            "message": "Datos del Complejo recuperados satisfactoriamente.",
    |            "data": [
    |                {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": {
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
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium",
    |                    "created_at": "2020-11-28T00:30:50.000000Z",
    |                    "updated_at": "2020-11-28T00:30:50.000000Z",
    |                    "deleted_at": null,
    |                    "plan": {
    |                        "id": 2,
    |                        "complex_id": 1,
    |                        "plan_id": 1,
    |                        "last_payment_at": "2020-11-01 21:45:47",
    |                        "next_payment_at": "2020-11-30 21:45:47",
    |                        "created_at": "2020-11-28T20:10:52.000000Z",
    |                        "updated_at": "2020-11-30T02:37:32.000000Z",
    |                        "deleted_at": null
    |                    },
    |                    "owner": {
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
    |                    "admin": {
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
    |                    "type_complex": {
    |                        "id": 1,
    |                        "name": "Cluster",
    |                        "description": "Lorem ipsum dolor",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": null,
    |                        "deleted_at": null
    |                    }
    |                },
    |                {
    |                    "id": 3,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": {
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
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex in This Together",
    |                    "created_at": "2020-11-29T21:59:54.000000Z",
    |                    "updated_at": "2020-11-30T02:41:23.000000Z",
    |                    "deleted_at": null,
    |                    "plan": null,
    |                    "owner": {
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
    |                    "admin": {
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
    |                    "type_complex": {
    |                        "id": 1,
    |                        "name": "Cluster",
    |                        "description": "Lorem ipsum dolor",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": null,
    |                        "deleted_at": null
    |                    }
    |                },
    |                {
    |                    "id": 4,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": {
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
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium Dead Souls",
    |                    "created_at": "2020-11-30T01:55:17.000000Z",
    |                    "updated_at": "2020-11-30T01:55:17.000000Z",
    |                    "deleted_at": null,
    |                    "plan": null,
    |                    "owner": {
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
    |                    "admin": {
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
    |                    "type_complex": {
    |                        "id": 1,
    |                        "name": "Cluster",
    |                        "description": "Lorem ipsum dolor",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": null,
    |                        "deleted_at": null
    |                    }
    |                },
    |                {
    |                    "id": 5,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": {
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
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium Dead Souls",
    |                    "created_at": "2020-11-30T02:44:46.000000Z",
    |                    "updated_at": "2020-11-30T02:44:46.000000Z",
    |                    "deleted_at": null,
    |                    "plan": null,
    |                    "owner": {
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
    |                    "admin": {
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
    |                    "type_complex": {
    |                        "id": 1,
    |                        "name": "Cluster",
    |                        "description": "Lorem ipsum dolor",
    |                        "created_at": "2020-11-24T23:09:39.000000Z",
    |                        "updated_at": null,
    |                        "deleted_at": null
    |                    }
    |                }
    |            ]
    |        },
    |        "exception": null
    |    }
    |   }
    |
    |*/
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
            $Complex = Complex::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Complejo creado satisfactoriamente.",
                "data" => $this->getByID($Complex->id)
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
    | Get All Complexes
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complexes
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Lista de Complejos recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "owner_id": 1,
    |                "admin_id": 1,
    |                "created_by": {
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
    |                "type_id": 1,
    |                "use_id": 1,
    |                "name": "Complex Paladium",
    |                "created_at": "2020-11-28T00:30:50.000000Z",
    |                "updated_at": "2020-11-28T00:30:50.000000Z",
    |                "deleted_at": null,
    |                "plan": {
    |                    "id": 2,
    |                    "complex_id": 1,
    |                    "plan_id": 2,
    |                    "last_payment_at": "2020-11-27 21:45:47",
    |                    "next_payment_at": "2020-11-27 21:45:47",
    |                    "created_at": "2020-11-28T20:10:52.000000Z",
    |                    "updated_at": "2020-11-28T20:10:52.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
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
    |                "admin": {
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
    |                "type_complex": {
    |                    "id": 1,
    |                    "name": "Cluster",
    |                    "description": "Lorem ipsum dolor",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            },
    |        ]
    |    }
    |
    */
    public function getAll() {
        try {
            $Complexs = Complex::with('plan', 'owner', 'admin', 'createdBy', 'typeComplex')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista de Complejos recuperada satisfactoriamente.",
                "data" => $Complexs
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
    | Get Complex by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Datos del Complejo recuperados satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "owner_id": 1,
    |                "admin_id": 1,
    |                "created_by": {
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
    |                "type_id": 1,
    |                "use_id": 1,
    |                "name": "Complex Paladium",
    |                "created_at": "2020-11-28T00:30:50.000000Z",
    |                "updated_at": "2020-11-28T00:30:50.000000Z",
    |                "deleted_at": null,
    |                "plan": {
    |                    "id": 2,
    |                    "complex_id": 1,
    |                    "plan_id": 2,
    |                    "last_payment_at": "2020-11-27 21:45:47",
    |                    "next_payment_at": "2020-11-27 21:45:47",
    |                    "created_at": "2020-11-28T20:10:52.000000Z",
    |                    "updated_at": "2020-11-28T20:10:52.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
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
    |                "admin": {
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
    |                "type_complex": {
    |                    "id": 1,
    |                    "name": "Cluster",
    |                    "description": "Lorem ipsum dolor",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 3,
    |                "owner_id": 1,
    |                "admin_id": 1,
    |                "created_by": {
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
    |                "type_id": 1,
    |                "use_id": 1,
    |                "name": "Complex Paladium D",
    |                "created_at": "2020-11-29T21:59:54.000000Z",
    |                "updated_at": "2020-11-29T21:59:54.000000Z",
    |                "deleted_at": null,
    |                "plan": null,
    |                "owner": {
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
    |                "admin": {
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
    |                "type_complex": {
    |                    "id": 1,
    |                    "name": "Cluster",
    |                    "description": "Lorem ipsum dolor",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    */
    public function getByID($id) {
        try {
            $Complex = Complex::find($id);

            if (is_null($Complex)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Complejo no encontrado.",
                    "data" => $Complex
                ]);
            }else {
                $Complex = $Complex->with('plan', 'owner', 'admin', 'createdBy', 'typeComplex')->get();
            }
            return response()->json([
                "response" => "success",
                "message" => "Datos del Complejo recuperados satisfactoriamente.",
                "data" => $Complex
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
    | Update a Complex
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex
    |
    |   {
    |        "id" : 2,
    |        "name" : "Complex Ones",
    |        "owner_id" : 1,
    |        "admin_id" : 1,
    |        "created_by" : 2,
    |        "type_id" : 1,
    |        "use_id" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Complejo actualizado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos del Complejo recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "owner_id": 1,
    |                        "admin_id": 1,
    |                        "created_by": {
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
    |                        "type_id": 1,
    |                        "use_id": 1,
    |                        "name": "Complex Paladium",
    |                        "created_at": "2020-11-28T00:30:50.000000Z",
    |                        "updated_at": "2020-11-28T00:30:50.000000Z",
    |                        "deleted_at": null,
    |                        "plan": {
    |                            "id": 2,
    |                            "complex_id": 1,
    |                            "plan_id": 1,
    |                            "last_payment_at": "2020-11-01 21:45:47",
    |                            "next_payment_at": "2020-11-30 21:45:47",
    |                            "created_at": "2020-11-28T20:10:52.000000Z",
    |                            "updated_at": "2020-11-30T02:37:32.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "owner": {
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
    |                        "admin": {
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
    |                        "type_complex": {
    |                            "id": 1,
    |                            "name": "Cluster",
    |                            "description": "Lorem ipsum dolor",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": null,
    |                            "deleted_at": null
    |                        }
    |                    },
    |                    {
    |                        "id": 3,
    |                        "owner_id": 1,
    |                        "admin_id": 1,
    |                        "created_by": {
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
    |                        "type_id": 1,
    |                        "use_id": 1,
    |                        "name": "Complex in This Together",
    |                        "created_at": "2020-11-29T21:59:54.000000Z",
    |                        "updated_at": "2020-11-30T02:41:23.000000Z",
    |                        "deleted_at": null,
    |                        "plan": null,
    |                        "owner": {
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
    |                        "admin": {
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
    |                        "type_complex": {
    |                            "id": 1,
    |                            "name": "Cluster",
    |                            "description": "Lorem ipsum dolor",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": null,
    |                            "deleted_at": null
    |                        }
    |                    },
    |                    {
    |                        "id": 4,
    |                        "owner_id": 1,
    |                        "admin_id": 1,
    |                        "created_by": {
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
    |                        "type_id": 1,
    |                        "use_id": 1,
    |                        "name": "Complex Paladium Dead Souls",
    |                        "created_at": "2020-11-30T01:55:17.000000Z",
    |                        "updated_at": "2020-11-30T01:55:17.000000Z",
    |                        "deleted_at": null,
    |                        "plan": null,
    |                        "owner": {
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
    |                        "admin": {
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
    |                        "type_complex": {
    |                            "id": 1,
    |                            "name": "Cluster",
    |                            "description": "Lorem ipsum dolor",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
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
            $Complex = Complex::findOrFail($request->id);
            $Complex->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Complejo actualizado satisfactoriamente.",
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
    | Delete a Complex
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Complejo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "owner_id": 1,
    |            "admin_id": 1,
    |            "created_by": 2,
    |            "type_id": 1,
    |            "use_id": 1,
    |            "name": "Complex Ones",
    |            "created_at": "2020-11-28T19:59:48.000000Z",
    |            "updated_at": "2020-11-28T20:04:27.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($complex_id)
    {
        try {
            $Complex = Complex::find($complex_id);
            $Complex->destroy($complex_id);
            return response()->json([
                "response" => "success",
                "message" => "Complejo eliminado satisfactoriamente.",
                "data" => $Complex
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
    | Create or Update Complex Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Complex
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:plans',
            'owner_id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:users,id',
            'created_by' => 'required|exists:users,id',
            'type_id' => 'required|exists:complexes,id',
            'use_id' => 'required|exists:users,id'
        ];
    }
    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un nombre para el Complejo.',
            'name.unique' => 'El nombre para el Complejo ya existe.',

            'owner_id.required' => 'Debe elegir el Propietario del Complejo.',
            'owner_id.exists' => 'El Ocupante para la Notificación no existe.',

            'admin_id.required' => 'Debe elegir el Administrador del Complejo.',
            'admin_id.exists' => 'el Administrador del Complejo no existe.',

            'type_id.required' => 'Debe elegir el Tipo de Complejo.',
            'type_id.exists' => 'el Tipo de Complejo no existe.',

            'use_id.required' => 'Debe seleccionar el Uso del Complejo.',
            'use_id.exists' => 'El Uso del Complejo no existe.',
        ];
    }

}
