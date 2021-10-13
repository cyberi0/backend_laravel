<?php

namespace App\Http\Controllers;

use App\Models\PropertyGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyGuestsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Property Guests
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Property Guest
    |
    |    {
    |        "guest_id" : 1,
    |        "property_id" : 1,
    |        "created_by" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "created_by": {
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
    |                        "guest_id": 1,
    |                        "property_id": 1,
    |                        "created_at": "2020-12-20T23:16:33.000000Z",
    |                        "updated_at": "2020-12-20T23:16:33.000000Z",
    |                        "deleted_at": null,
    |                        "guest": {
    |                            "id": 1,
    |                            "uuid": "123456789123456789",
    |                            "names": "Cyberio",
    |                            "surnames": "Lopez",
    |                            "email": "development2@wobosoft.com",
    |                            "mobile": "9841360125",
    |                            "created_by": 1,
    |                            "created_at": "2020-12-20T07:40:21.000000Z",
    |                            "updated_at": "2020-12-20T07:40:21.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "property": {
    |                            "id": 1,
    |                            "complex_id": 1,
    |                            "type_id": 1,
    |                            "owner_id": 2,
    |                            "occupant_id": 1,
    |                            "name": "ASDFASDF",
    |                            "floor": "ASDFASDF",
    |                            "number": "ASDFAFDS",
    |                            "contract": "ASDFASDFASDF",
    |                            "contract_expired_at": null,
    |                            "proportions": null,
    |                            "document": null,
    |                            "book": null,
    |                            "created_at": "2020-12-20T02:13:19.000000Z",
    |                            "updated_at": "2020-12-20T02:13:19.000000Z",
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
            $PropertyGuest = PropertyGuest::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Invitado creado satisfactoriamente.",
                "data" => $this->getByID($PropertyGuest->id)
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
    | Get All Property Guests
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Property Guests
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
    |                "guest_id": 1,
    |                "property_id": 1,
    |                "created_at": "2020-12-20T23:15:53.000000Z",
    |                "updated_at": "2020-12-20T23:15:53.000000Z",
    |                "deleted_at": null,
    |                "guest": {
    |                    "id": 1,
    |                    "uuid": "123456789123456789",
    |                    "names": "Cyberio",
    |                    "surnames": "Lopez",
    |                    "email": "development2@wobosoft.com",
    |                    "mobile": "9841360125",
    |                    "created_by": 1,
    |                    "created_at": "2020-12-20T07:40:21.000000Z",
    |                    "updated_at": "2020-12-20T07:40:21.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "complex_id": 1,
    |                    "type_id": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "name": "ASDFASDF",
    |                    "floor": "ASDFASDF",
    |                    "number": "ASDFAFDS",
    |                    "contract": "ASDFASDFASDF",
    |                    "contract_expired_at": null,
    |                    "proportions": null,
    |                    "document": null,
    |                    "book": null,
    |                    "created_at": "2020-12-20T02:13:19.000000Z",
    |                    "updated_at": "2020-12-20T02:13:19.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "created_by": {
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
    |                "guest_id": 1,
    |                "property_id": 1,
    |                "created_at": "2020-12-20T23:16:33.000000Z",
    |                "updated_at": "2020-12-20T23:16:33.000000Z",
    |                "deleted_at": null,
    |                "guest": {
    |                    "id": 1,
    |                    "uuid": "123456789123456789",
    |                    "names": "Cyberio",
    |                    "surnames": "Lopez",
    |                    "email": "development2@wobosoft.com",
    |                    "mobile": "9841360125",
    |                    "created_by": 1,
    |                    "created_at": "2020-12-20T07:40:21.000000Z",
    |                    "updated_at": "2020-12-20T07:40:21.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "complex_id": 1,
    |                    "type_id": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "name": "ASDFASDF",
    |                    "floor": "ASDFASDF",
    |                    "number": "ASDFAFDS",
    |                    "contract": "ASDFASDFASDF",
    |                    "contract_expired_at": null,
    |                    "proportions": null,
    |                    "document": null,
    |                    "book": null,
    |                    "created_at": "2020-12-20T02:13:19.000000Z",
    |                    "updated_at": "2020-12-20T02:13:19.000000Z",
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
            $PropertyGuests = PropertyGuest::with('guest')
                ->with('property')
                ->with('created_by')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $PropertyGuests
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
    | Get Property Guest by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Property Guest
    |   using the following parameter:
    |
    |   _______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                               |
    |  |-----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Property Guest|
    |  |            |        |          | Example : 2                          |
    |  |____________|________|__________|______________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "created_by": {
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
    |                "guest_id": 1,
    |                "property_id": 1,
    |                "created_at": "2020-12-20T23:16:33.000000Z",
    |                "updated_at": "2020-12-20T23:16:33.000000Z",
    |                "deleted_at": null,
    |                "guest": {
    |                    "id": 1,
    |                    "uuid": "123456789123456789",
    |                    "names": "Cyberio",
    |                    "surnames": "Lopez",
    |                    "email": "development2@wobosoft.com",
    |                    "mobile": "9841360125",
    |                    "created_by": 1,
    |                    "created_at": "2020-12-20T07:40:21.000000Z",
    |                    "updated_at": "2020-12-20T07:40:21.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "complex_id": 1,
    |                    "type_id": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "name": "ASDFASDF",
    |                    "floor": "ASDFASDF",
    |                    "number": "ASDFAFDS",
    |                    "contract": "ASDFASDFASDF",
    |                    "contract_expired_at": null,
    |                    "proportions": null,
    |                    "document": null,
    |                    "book": null,
    |                    "created_at": "2020-12-20T02:13:19.000000Z",
    |                    "updated_at": "2020-12-20T02:13:19.000000Z",
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
            $PropertyGuest = PropertyGuest::find($id);

            if (is_null($PropertyGuest)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Invitado no encontrado.",
                ]);
            } else {
                $PropertyGuest = $PropertyGuest
                    ->with('guest')
                    ->with('property')
                    ->with('created_by')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Invitado recuperado satisfactoriamente.",
                "data" => $PropertyGuest
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
    | Update a Property Guest
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Property Guest
    |
    |    {
    |        "id" : 2,
    |        "guest_id" : 1,
    |        "property_id" : 1,
    |        "created_by" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "created_by": {
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
    |                        "guest_id": 1,
    |                        "property_id": 1,
    |                        "created_at": "2020-12-20T23:16:33.000000Z",
    |                        "updated_at": "2020-12-20T23:16:33.000000Z",
    |                        "deleted_at": null,
    |                        "guest": {
    |                            "id": 1,
    |                            "uuid": "123456789123456789",
    |                            "names": "Cyberio",
    |                            "surnames": "Lopez",
    |                            "email": "development2@wobosoft.com",
    |                            "mobile": "9841360125",
    |                            "created_by": 1,
    |                            "created_at": "2020-12-20T07:40:21.000000Z",
    |                            "updated_at": "2020-12-20T07:40:21.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "property": {
    |                            "id": 1,
    |                            "complex_id": 1,
    |                            "type_id": 1,
    |                            "owner_id": 2,
    |                            "occupant_id": 1,
    |                            "name": "ASDFASDF",
    |                            "floor": "ASDFASDF",
    |                            "number": "ASDFAFDS",
    |                            "contract": "ASDFASDFASDF",
    |                            "contract_expired_at": null,
    |                            "proportions": null,
    |                            "document": null,
    |                            "book": null,
    |                            "created_at": "2020-12-20T02:13:19.000000Z",
    |                            "updated_at": "2020-12-20T02:13:19.000000Z",
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
            $PropertyGuest = PropertyGuest::findOrFail($request->id);

            $PropertyGuest->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Invitado actualizado satisafactoriamente.",
                "data" => $this->getByID($PropertyGuest->id)
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
    | Delete a Property Guest
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Property Guest
    |   using the following parameter:
    |
    |   _______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                              |
    |  |-----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Property Guest|
    |  |            |        |          | Example : 3                          |
    |  |            |        |          |                                      |
    |  |____________|________|__________|______________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Invitado eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "created_by": 1,
    |            "guest_id": 1,
    |            "property_id": 1,
    |            "created_at": "2020-12-20T23:20:35.000000Z",
    |            "updated_at": "2020-12-20T23:20:35.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
     */
    public function delete($id)
    {
        try {
            $PropertyGuest = PropertyGuest::find($id);


            if (!is_null($PropertyGuest)) {
                $PropertyGuest->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Invitado eliminado satisfactoriamente.",
                    "data" => $PropertyGuest
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Invitado no encontrado.",
                    "data" => $PropertyGuest
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
    | Create or Update Property Guests Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Property Guests
    |
    */
    public function getRules() {
        return [
            "guest_id" => "required|exists:guests,id",
            "property_id" => "required|exists:properties,id",
            "created_by" => "required|exists:users,id"
        ];
    }

    public function getMessages() {
        return [
            "guest_id.required" => "Debe seleccionar un Invitado.",
            "guest_id.exists" => "El Invitado no existe.",
            "property_id.required" => "Debe seleccionar una Propiedad.",
            "property_id.exists" => "La propiedad no existe.",
            "created_by.required" => "Debe seleccionar un Creador.",
            "created_by.exists" => "El Creador no existe."
        ];
    }
}
