<?php

namespace App\Http\Controllers;

use App\Models\UserCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserCardsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User Cards
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create User Cards
    |
    |   {
    |        "user_id" : 1,
    |        "provider_id" : 2,
    |        "brand" : "Centro",
    |        "digits" : "0230 0121 2151 3544",
    |        "bank" : "Santander",
    |        "data" : "Lorem Ipsum Dolor"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tarjeta creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "error",
    |                "message": "Call to undefined relationship [method] on model [App\\Models\\UserCard]."
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
            $UserCard = UserCard::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tarjeta creada satisfactoriamente.",
                "data" => $this->getByID($UserCard->id)
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
    | Get All  User Cards
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all  User Cards
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
    |                "provider_id": 1,
    |                "brand": "VISA",
    |                "digits": "3142 2343 4234 4365",
    |                "bank": "Bankker",
    |                "data": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T19:59:06.000000Z",
    |                "updated_at": "2020-12-11T19:59:06.000000Z",
    |                "deleted_at": null,
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
    |                "provider": {
    |                    "id": 1,
    |                    "name": "TaggerApi",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "default": "1",
    |                    "created_at": "2020-12-11T19:58:45.000000Z",
    |                    "updated_at": "2020-12-11T19:58:45.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 3,
    |                "user_id": 1,
    |                "provider_id": 2,
    |                "brand": "Centro",
    |                "digits": "0230 0121 2151 3544",
    |                "bank": "Santander",
    |                "data": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-14T16:04:18.000000Z",
    |                "updated_at": "2020-12-14T16:04:18.000000Z",
    |                "deleted_at": null,
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
    |                "provider": {
    |                    "id": 2,
    |                    "name": "Atouk",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "default": "1",
    |                    "created_at": "2020-12-11T19:59:01.000000Z",
    |                    "updated_at": "2020-12-11T19:59:01.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 4,
    |                "user_id": 1,
    |                "provider_id": 2,
    |                "brand": "Animas",
    |                "digits": "0653 0153 2335 7543",
    |                "bank": "BBV",
    |                "data": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-14T16:12:22.000000Z",
    |                "updated_at": "2020-12-14T16:12:22.000000Z",
    |                "deleted_at": null,
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
    |                "provider": {
    |                    "id": 2,
    |                    "name": "Atouk",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "default": "1",
    |                    "created_at": "2020-12-11T19:59:01.000000Z",
    |                    "updated_at": "2020-12-11T19:59:01.000000Z",
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
            $UserCards = UserCard::with('user')
                ->with('provider')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $UserCards
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
    | Get User Card by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User Card
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the User Card  |
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
    |        "message": "Tarjeta recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "user_id": 1,
    |                "provider_id": 1,
    |                "brand": "VISA",
    |                "digits": "3142 2343 4234 4365",
    |                "bank": "Bankker",
    |                "data": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T19:59:06.000000Z",
    |                "updated_at": "2020-12-11T19:59:06.000000Z",
    |                "deleted_at": null,
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
    |                "provider": {
    |                    "id": 1,
    |                    "name": "TaggerApi",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "default": "1",
    |                    "created_at": "2020-12-11T19:58:45.000000Z",
    |                    "updated_at": "2020-12-11T19:58:45.000000Z",
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
            $UserCard = UserCard::find($id);

            if (is_null($UserCard)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tarjeta no encontrada.",
                    "data" => $UserCard
                ]);
            } else {
                $UserCard = $UserCard
                    ->with('user')
                    ->with('provider')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Tarjeta recuperada satisfactoriamente.",
                "data" => $UserCard
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
    | Update an User Card
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an User Card
    |
    |   {
    |        "id":1,
    |        "user_id" : 1,
    |        "provider_id" : 2,
    |        "brand" : "Animas",
    |        "digits" : "0534 0756 9878 2346",
    |        "bank" : "BBV",
    |        "data" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tarjeta actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tarjeta recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "user_id": 1,
    |                        "provider_id": 2,
    |                        "brand": "Animas",
    |                        "digits": "0534 0756 9878 2346",
    |                        "bank": "BBV",
    |                        "data": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-11T19:59:06.000000Z",
    |                        "updated_at": "2020-12-14T16:20:21.000000Z",
    |                        "deleted_at": null,
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
    |                        "provider": {
    |                            "id": 2,
    |                            "name": "Atouk",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "default": "1",
    |                            "created_at": "2020-12-11T19:59:01.000000Z",
    |                            "updated_at": "2020-12-11T19:59:01.000000Z",
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
            $UserCard = UserCard::findOrFail($request->id);

            $UserCard->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tarjeta actualizada satisafactoriamente.",
                "data" => $this->getByID($UserCard->id)
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
    | Delete an User Card
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Card
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the UserCard   |
    |  |            |        |          | Example : 2                       |
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
    |        "message": "Tarjeta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "user_id": 1,
    |            "provider_id": 1,
    |            "brand": "FSGAFD",
    |            "digits": "1234 435 1213 3 3453",
    |            "bank": "ASDFASFD ",
    |            "data": "3241 AS",
    |            "created_at": "2020-12-11T19:59:55.000000Z",
    |            "updated_at": "2020-12-11T19:59:55.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserCard = UserCard::find($id);

            if (!is_null($UserCard)) {
                $UserCard->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tarjeta eliminada satisfactoriamente.",
                    "data" => $UserCard
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tarjeta no encontrada.",
                    "data" => $UserCard
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
    | Create or Update User Cards Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an User Card
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'provider_id' => 'required|exists:payment_providers,id',
            'brand' => 'required',
            'digits' => 'required',
            'bank' => 'required',
            'data' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Método',
            'user_id.exists' => 'No existe el Método',
            'provider_id.required' => 'Debe elegir un Complejo',
            'provider_id.exists' => 'No existe el Complejo',
            'brand' => 'Debe escribir una Sucursal',
            'digits' => 'Debe escribir los Dígitos',
            'bank' => 'Debe escribir un Banco',
            'data' => 'Debe escribir lod Datos',
        ];
    }
}
