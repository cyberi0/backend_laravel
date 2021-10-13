<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertiesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Property
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Property
    |
    |   {
    |        "complex_id" : 1,
    |        "type_id" : 1,
    |        "owner_id" : 2,
    |        "occupant_id" : 1,
    |        "name" : "Property Name Pro",
    |        "floor" : "4",
    |        "number" : "20",
    |        "contract" : "SFJASOIEFOSA",
    |        "contract_expired_at" : "2020-12-12 15:34:40",
    |        "proportions" : "15x30",
    |        "document" : "Douglas Rushkoff",
    |        "book": "Cyberia"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Propiedad creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Propiedad recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 5,
    |                        "complex_id": 1,
    |                        "type_id": 1,
    |                        "owner_id": 1,
    |                        "occupant_id": 2,
    |                        "name": "Naboo",
    |                        "floor": "4",
    |                        "number": "20",
    |                        "contract": "SFJASOIEFOSA",
    |                        "contract_expired_at": "2020-12-12",
    |                        "proportions": "15x30",
    |                        "document": "Douglas Rushkoff",
    |                        "book": "Cyberia",
    |                        "created_at": "2020-12-12T16:47:31.000000Z",
    |                        "updated_at": "2020-12-12T16:47:31.000000Z",
    |                        "deleted_at": null,
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
    |                        "property_type": {
    |                            "id": 1,
    |                            "name": "Vacational",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-11T19:59:32.000000Z",
    |                            "updated_at": "2020-12-11T19:59:32.000000Z",
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
    |                        "occupant": {
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
            $Property = Property::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Propiedad creada satisfactoriamente.",
                "data" => $this->getByID($Property->id)
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
    | Get All Properties
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Properties
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
    |                "id": 2,
    |                "complex_id": 1,
    |                "type_id": 1,
    |                "owner_id": 2,
    |                "occupant_id": 1,
    |                "name": "ASDFASDF",
    |                "floor": "ASDFASDF",
    |                "number": "ASDFAFDS",
    |                "contract": "ASDFASDFASDF",
    |                "contract_expired_at": null,
    |                "proportions": null,
    |                "document": null,
    |                "book": null,
    |                "created_at": "2020-12-11T19:59:50.000000Z",
    |                "updated_at": "2020-12-11T19:59:50.000000Z",
    |                "deleted_at": null,
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
    |                "property_type": {
    |                    "id": 1,
    |                    "name": "Vacational",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T19:59:32.000000Z",
    |                    "updated_at": "2020-12-11T19:59:32.000000Z",
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
    |                }
    |            },
    |            {
    |                "id": 5,
    |                "complex_id": 1,
    |                "type_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "name": "Naboo",
    |                "floor": "4",
    |                "number": "20",
    |                "contract": "SFJASOIEFOSA",
    |                "contract_expired_at": "2020-12-12",
    |                "proportions": "15x30",
    |                "document": "Douglas Rushkoff",
    |                "book": "Cyberia",
    |                "created_at": "2020-12-12T16:47:31.000000Z",
    |                "updated_at": "2020-12-12T16:47:31.000000Z",
    |                "deleted_at": null,
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
    |                "property_type": {
    |                    "id": 1,
    |                    "name": "Vacational",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T19:59:32.000000Z",
    |                    "updated_at": "2020-12-11T19:59:32.000000Z",
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
    |                "occupant": {
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $Properties = Property::with('complex')
                ->with('property_type')
                ->with('owner')
                ->with('occupant')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Properties
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
    | Get Property by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Property
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Property   |
    |  |            |        |          | Example : 2                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Propiedad recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 1,
    |                "type_id": 1,
    |                "owner_id": 2,
    |                "occupant_id": 1,
    |                "name": "ASDFASDF",
    |                "floor": "ASDFASDF",
    |                "number": "ASDFAFDS",
    |                "contract": "ASDFASDFASDF",
    |                "contract_expired_at": null,
    |                "proportions": null,
    |                "document": null,
    |                "book": null,
    |                "created_at": "2020-12-11T19:59:50.000000Z",
    |                "updated_at": "2020-12-11T19:59:50.000000Z",
    |                "deleted_at": null,
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
    |                "property_type": {
    |                    "id": 1,
    |                    "name": "Vacational",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T19:59:32.000000Z",
    |                    "updated_at": "2020-12-11T19:59:32.000000Z",
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $Property = Property::find($id);

            if (is_null($Property)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Propiedad no encontrada.",
                    "data" => $Property
                ]);
            } else {
                $Property = $Property
                    ->with('complex')
                    ->with('property_type')
                    ->with('owner')
                    ->with('occupant')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Propiedad recuperada satisfactoriamente.",
                "data" => $Property
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
    | Update a Property
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Property
    |
    |   {
    |        "id" : 2,
    |        "complex_id" : 1,
    |        "type_id" : 1,
    |        "owner_id" : 2,
    |        "occupant_id" : 1,
    |        "name" : "Naboo II",
    |        "floor" : "7",
    |        "number" : "10",
    |        "contract" : "SFJASOIEFOSA",
    |        "contract_expired_at" : "2020-12-12 15:34:40",
    |        "proportions" : "15x30",
    |        "document" : "Douglas Rushkoff",
    |        "book": "Cyberia V"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Propiedad actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Propiedad recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 1,
    |                        "type_id": 1,
    |                        "owner_id": 2,
    |                        "occupant_id": 1,
    |                        "name": "Naboo II",
    |                        "floor": "7",
    |                        "number": "10",
    |                        "contract": "SFJASOIEFOSA",
    |                        "contract_expired_at": "2020-12-12",
    |                        "proportions": "15x30",
    |                        "document": "Douglas Rushkoff",
    |                        "book": "Cyberia V",
    |                        "created_at": "2020-12-11T19:59:50.000000Z",
    |                        "updated_at": "2020-12-12T17:55:58.000000Z",
    |                        "deleted_at": null,
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
    |                        "property_type": {
    |                            "id": 1,
    |                            "name": "Vacational",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-11T19:59:32.000000Z",
    |                            "updated_at": "2020-12-11T19:59:32.000000Z",
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
            $Property = Property::findOrFail($request->id);

            $Property->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Propiedad actualizada satisafactoriamente.",
                "data" => $this->getByID($Property->id)
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
    | Delete a Property
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Property
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Property   |
    |  |            |        |          | Example : 3                       |
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
    |        "message": "Propiedad eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "complex_id": null,
    |            "type_id": null,
    |            "owner_id": 2,
    |            "occupant_id": 1,
    |            "name": "Property Name Pro",
    |            "floor": "4",
    |            "number": "20",
    |            "contract": "SFJASOIEFOSA",
    |            "contract_expired_at": "2020-12-12",
    |            "proportions": "15x30",
    |            "document": "Douglas Rushkoff",
    |            "book": "Cyberia",
    |            "created_at": "2020-12-12T16:43:32.000000Z",
    |            "updated_at": "2020-12-12T16:43:32.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $Property = Property::find($id);


            if (!is_null($Property)) {
                $Property->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Propiedad eliminada satisfactoriamente.",
                    "data" => $Property
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Propiedad no encontrada.",
                    "data" => $Property
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
    |    for validations when you create or update a Property
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'type_id' => 'required|exists:property_types,id',
            'owner_id' => 'required|exists:users,id',
            'occupant_id' => 'required|exists:users,id',
            'name' => 'required|unique:properties',
            'floor' => 'required',
            'number' => 'required',
            'contract' => 'required',
            'contract_expired_at' => 'required',
            'proportions' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo.',
            'complex_id.exists' => 'No existe el Complejo.',
            'type_id.required' => 'Debe elegir un Tipo de Propiedad.',
            'type_id.exists' => 'No existe el Tipo de Propiedad.',
            'owner_id.required' => 'Debe elegir un Propietario.',
            'owner_id.exists' => 'No existe el Propietario.',
            'occupant_id.required' => 'Debe elegir un Ocupante.',
            'occupant_id.exists' => 'No existe el Ocupante.',
            'name' => 'Debe escribir un Nombre.',
            'floor' => 'Debe escribir un Piso.',
            'number' => 'Debe escribir un Número.',
            'contract' => 'Debe escribir un Contrato.',
            'contract_expired_at' => 'Debe seleccionar Fecha de Expiración.',
            'proportions' => 'Debe escribir las Proporciones.'
        ];
    }
}
