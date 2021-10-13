<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Tag
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Tag
    |
    |   {
            "type_id" : 1,
            "vehicle_id" : 2,
            "complex_id" : 1,
            "property_id" : 5,
            "identifier" : "Tag Identifier",
            "number" : "01829",
            "status_id" : 1
        }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
            "response": "success",
            "message": "Etiqueta creada satisfactoriamente.",
            "data": {
                "headers": {},
                "original": {
                    "response": "success",
                    "message": "Etiqueta recuperada satisfactoriamente.",
                    "data": [
                        {
                            "id": 3,
                            "type_id": 1,
                            "vehicle_id": 2,
                            "complex_id": 1,
                            "property_id": 5,
                            "identifier": "Tag Identifier",
                            "number": "01829",
                            "status_id": 1,
                            "created_at": "2020-12-12T20:41:51.000000Z",
                            "updated_at": "2020-12-12T20:41:51.000000Z",
                            "deleted_at": null,
                            "tag_type": {
                                "id": 1,
                                "name": "Massive Attack",
                                "description": "Lorem Ipsum Dolor",
                                "created_at": "2020-12-12T19:28:23.000000Z",
                                "updated_at": "2020-12-12T19:28:23.000000Z",
                                "deleted_at": null
                            },
                            "vehicle": {
                                "id": 2,
                                "complex_id": 1,
                                "property_id": 2,
                                "type_id": 1,
                                "brand": "Honda",
                                "model": "Pilot",
                                "plate": "WOE-2039",
                                "color": "Verde",
                                "photo": "front.png",
                                "year": "2003",
                                "created_at": "2020-12-12T14:15:51.000000Z",
                                "updated_at": null,
                                "deleted_at": null
                            },
                            "complex": {
                                "id": 1,
                                "owner_id": 1,
                                "admin_id": 2,
                                "created_by": 2,
                                "type_id": 1,
                                "use_id": 1,
                                "name": "Cluster BRC",
                                "created_at": "2020-11-24T23:09:39.000000Z",
                                "updated_at": null,
                                "deleted_at": null
                            },
                            "property": {
                                "id": 5,
                                "complex_id": 1,
                                "type_id": 1,
                                "owner_id": 1,
                                "occupant_id": 2,
                                "name": "Naboo",
                                "floor": "4",
                                "number": "20",
                                "contract": "SFJASOIEFOSA",
                                "contract_expired_at": "2020-12-12",
                                "proportions": "15x30",
                                "document": "Douglas Rushkoff",
                                "book": "Cyberia",
                                "created_at": "2020-12-12T16:47:31.000000Z",
                                "updated_at": "2020-12-12T16:47:31.000000Z",
                                "deleted_at": null
                            },
                            "tag_status": {
                                "id": 1,
                                "name": "Aka Ringu",
                                "created_at": "2020-12-12T19:44:54.000000Z",
                                "updated_at": "2020-12-12T19:44:54.000000Z",
                                "deleted_at": null
                            }
                        }
                    ]
                },
                "exception": null
            }
        }
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
            $Tag = Tag::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Etiqueta creada satisfactoriamente.",
                "data" => $this->getByID($Tag->id)
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
        {
            "response": "success",
            "message": "Lista recuperada satisfactoriamente.",
            "data": [
                {
                    "id": 3,
                    "type_id": 1,
                    "vehicle_id": 2,
                    "complex_id": 1,
                    "property_id": 5,
                    "identifier": "Tag Identifier",
                    "number": "01829",
                    "status_id": 1,
                    "created_at": "2020-12-12T20:41:51.000000Z",
                    "updated_at": "2020-12-12T20:41:51.000000Z",
                    "deleted_at": null,
                    "tag_type": {
                        "id": 1,
                        "name": "Massive Attack",
                        "description": "Lorem Ipsum Dolor",
                        "created_at": "2020-12-12T19:28:23.000000Z",
                        "updated_at": "2020-12-12T19:28:23.000000Z",
                        "deleted_at": null
                    },
                    "vehicle": {
                        "id": 2,
                        "complex_id": 1,
                        "property_id": 2,
                        "type_id": 1,
                        "brand": "Honda",
                        "model": "Pilot",
                        "plate": "WOE-2039",
                        "color": "Verde",
                        "photo": "front.png",
                        "year": "2003",
                        "created_at": "2020-12-12T14:15:51.000000Z",
                        "updated_at": null,
                        "deleted_at": null
                    },
                    "complex": {
                        "id": 1,
                        "owner_id": 1,
                        "admin_id": 2,
                        "created_by": 2,
                        "type_id": 1,
                        "use_id": 1,
                        "name": "Cluster BRC",
                        "created_at": "2020-11-24T23:09:39.000000Z",
                        "updated_at": null,
                        "deleted_at": null
                    },
                    "property": {
                        "id": 5,
                        "complex_id": 1,
                        "type_id": 1,
                        "owner_id": 1,
                        "occupant_id": 2,
                        "name": "Naboo",
                        "floor": "4",
                        "number": "20",
                        "contract": "SFJASOIEFOSA",
                        "contract_expired_at": "2020-12-12",
                        "proportions": "15x30",
                        "document": "Douglas Rushkoff",
                        "book": "Cyberia",
                        "created_at": "2020-12-12T16:47:31.000000Z",
                        "updated_at": "2020-12-12T16:47:31.000000Z",
                        "deleted_at": null
                    },
                    "tag_status": {
                        "id": 1,
                        "name": "Aka Ringu",
                        "created_at": "2020-12-12T19:44:54.000000Z",
                        "updated_at": "2020-12-12T19:44:54.000000Z",
                        "deleted_at": null
                    }
                },
                {
                    "id": 4,
                    "type_id": 1,
                    "vehicle_id": 2,
                    "complex_id": 1,
                    "property_id": 5,
                    "identifier": "Tag Identifier II",
                    "number": "05832",
                    "status_id": 1,
                    "created_at": "2020-12-12T20:42:52.000000Z",
                    "updated_at": "2020-12-12T20:42:52.000000Z",
                    "deleted_at": null,
                    "tag_type": {
                        "id": 1,
                        "name": "Massive Attack",
                        "description": "Lorem Ipsum Dolor",
                        "created_at": "2020-12-12T19:28:23.000000Z",
                        "updated_at": "2020-12-12T19:28:23.000000Z",
                        "deleted_at": null
                    },
                    "vehicle": {
                        "id": 2,
                        "complex_id": 1,
                        "property_id": 2,
                        "type_id": 1,
                        "brand": "Honda",
                        "model": "Pilot",
                        "plate": "WOE-2039",
                        "color": "Verde",
                        "photo": "front.png",
                        "year": "2003",
                        "created_at": "2020-12-12T14:15:51.000000Z",
                        "updated_at": null,
                        "deleted_at": null
                    },
                    "complex": {
                        "id": 1,
                        "owner_id": 1,
                        "admin_id": 2,
                        "created_by": 2,
                        "type_id": 1,
                        "use_id": 1,
                        "name": "Cluster BRC",
                        "created_at": "2020-11-24T23:09:39.000000Z",
                        "updated_at": null,
                        "deleted_at": null
                    },
                    "property": {
                        "id": 5,
                        "complex_id": 1,
                        "type_id": 1,
                        "owner_id": 1,
                        "occupant_id": 2,
                        "name": "Naboo",
                        "floor": "4",
                        "number": "20",
                        "contract": "SFJASOIEFOSA",
                        "contract_expired_at": "2020-12-12",
                        "proportions": "15x30",
                        "document": "Douglas Rushkoff",
                        "book": "Cyberia",
                        "created_at": "2020-12-12T16:47:31.000000Z",
                        "updated_at": "2020-12-12T16:47:31.000000Z",
                        "deleted_at": null
                    },
                    "tag_status": {
                        "id": 1,
                        "name": "Aka Ringu",
                        "created_at": "2020-12-12T19:44:54.000000Z",
                        "updated_at": "2020-12-12T19:44:54.000000Z",
                        "deleted_at": null
                    }
                }
            ]
        }
    */
    public function getAll() {
        try {
            $Tags = Tag::with('tag_type')
                ->with('vehicle')
                ->with('complex')
                ->with('property')
                ->with('tag_status')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Tags
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
    | Get Tag by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Tag
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Tag    |
    |  |            |        |          | Example : 4                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
            "response": "success",
            "message": "Etiqueta recuperada satisfactoriamente.",
            "data": [
                {
                    "id": 4,
                    "type_id": 1,
                    "vehicle_id": 2,
                    "complex_id": 1,
                    "property_id": 5,
                    "identifier": "Tag Identifier II",
                    "number": "05832",
                    "status_id": 1,
                    "created_at": "2020-12-12T20:42:52.000000Z",
                    "updated_at": "2020-12-12T20:42:52.000000Z",
                    "deleted_at": null,
                    "tag_type": {
                        "id": 1,
                        "name": "Massive Attack",
                        "description": "Lorem Ipsum Dolor",
                        "created_at": "2020-12-12T19:28:23.000000Z",
                        "updated_at": "2020-12-12T19:28:23.000000Z",
                        "deleted_at": null
                    },
                    "vehicle": {
                        "id": 2,
                        "complex_id": 1,
                        "property_id": 2,
                        "type_id": 1,
                        "brand": "Honda",
                        "model": "Pilot",
                        "plate": "WOE-2039",
                        "color": "Verde",
                        "photo": "front.png",
                        "year": "2003",
                        "created_at": "2020-12-12T14:15:51.000000Z",
                        "updated_at": null,
                        "deleted_at": null
                    },
                    "complex": {
                        "id": 1,
                        "owner_id": 1,
                        "admin_id": 2,
                        "created_by": 2,
                        "type_id": 1,
                        "use_id": 1,
                        "name": "Cluster BRC",
                        "created_at": "2020-11-24T23:09:39.000000Z",
                        "updated_at": null,
                        "deleted_at": null
                    },
                    "property": {
                        "id": 5,
                        "complex_id": 1,
                        "type_id": 1,
                        "owner_id": 1,
                        "occupant_id": 2,
                        "name": "Naboo",
                        "floor": "4",
                        "number": "20",
                        "contract": "SFJASOIEFOSA",
                        "contract_expired_at": "2020-12-12",
                        "proportions": "15x30",
                        "document": "Douglas Rushkoff",
                        "book": "Cyberia",
                        "created_at": "2020-12-12T16:47:31.000000Z",
                        "updated_at": "2020-12-12T16:47:31.000000Z",
                        "deleted_at": null
                    },
                    "tag_status": {
                        "id": 1,
                        "name": "Aka Ringu",
                        "created_at": "2020-12-12T19:44:54.000000Z",
                        "updated_at": "2020-12-12T19:44:54.000000Z",
                        "deleted_at": null
                    }
                }
            ]
        }
    */
    public function getByID($id) {
        try{
            $Tag = Tag::find($id);

            if (is_null($Tag)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Etiqueta no encontrada.",
                    "data" => $Tag
                ]);
            } else {
                $Tag = $Tag
                    ->with('tag_type')
                    ->with('vehicle')
                    ->with('complex')
                    ->with('property')
                    ->with('tag_status')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Etiqueta recuperada satisfactoriamente.",
                "data" => $Tag
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
    | Update an Tag
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Tag
    |
    |   {
            "id" : 4,
            "type_id" : 1,
            "vehicle_id" : 2,
            "complex_id" : 1,
            "property_id" : 5,
            "identifier" : "Tag Identifier III",
            "number" : "05386",
            "status_id" : 1
        }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
        {
            "response": "success",
            "message": "Etiqueta actualizada satisafactoriamente.",
            "data": {
                "headers": {},
                "original": {
                    "response": "success",
                    "message": "Etiqueta recuperada satisfactoriamente.",
                    "data": [
                        {
                            "id": 4,
                            "type_id": 1,
                            "vehicle_id": 2,
                            "complex_id": 1,
                            "property_id": 5,
                            "identifier": "Tag Identifier III",
                            "number": "05386",
                            "status_id": 1,
                            "created_at": "2020-12-12T20:42:52.000000Z",
                            "updated_at": "2020-12-12T20:45:58.000000Z",
                            "deleted_at": null,
                            "tag_type": {
                                "id": 1,
                                "name": "Massive Attack",
                                "description": "Lorem Ipsum Dolor",
                                "created_at": "2020-12-12T19:28:23.000000Z",
                                "updated_at": "2020-12-12T19:28:23.000000Z",
                                "deleted_at": null
                            },
                            "vehicle": {
                                "id": 2,
                                "complex_id": 1,
                                "property_id": 2,
                                "type_id": 1,
                                "brand": "Honda",
                                "model": "Pilot",
                                "plate": "WOE-2039",
                                "color": "Verde",
                                "photo": "front.png",
                                "year": "2003",
                                "created_at": "2020-12-12T14:15:51.000000Z",
                                "updated_at": null,
                                "deleted_at": null
                            },
                            "complex": {
                                "id": 1,
                                "owner_id": 1,
                                "admin_id": 2,
                                "created_by": 2,
                                "type_id": 1,
                                "use_id": 1,
                                "name": "Cluster BRC",
                                "created_at": "2020-11-24T23:09:39.000000Z",
                                "updated_at": null,
                                "deleted_at": null
                            },
                            "property": {
                                "id": 5,
                                "complex_id": 1,
                                "type_id": 1,
                                "owner_id": 1,
                                "occupant_id": 2,
                                "name": "Naboo",
                                "floor": "4",
                                "number": "20",
                                "contract": "SFJASOIEFOSA",
                                "contract_expired_at": "2020-12-12",
                                "proportions": "15x30",
                                "document": "Douglas Rushkoff",
                                "book": "Cyberia",
                                "created_at": "2020-12-12T16:47:31.000000Z",
                                "updated_at": "2020-12-12T16:47:31.000000Z",
                                "deleted_at": null
                            },
                            "tag_status": {
                                "id": 1,
                                "name": "Aka Ringu",
                                "created_at": "2020-12-12T19:44:54.000000Z",
                                "updated_at": "2020-12-12T19:44:54.000000Z",
                                "deleted_at": null
                            }
                        }
                    ]
                },
                "exception": null
            }
        }
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
            $Tag = Tag::findOrFail($request->id);

            $Tag->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Etiqueta actualizada satisafactoriamente.",
                "data" => $this->getByID($Tag->id)
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
    | Delete Tag
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Tag
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Tag        |
    |  |            |        |          | Example : 4                       |
    |  |            |        |          |                                   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
        {
            "response": "success",
            "message": "Etiqueta eliminada satisfactoriamente.",
            "data": {
                "id": 4,
                "type_id": 1,
                "vehicle_id": 2,
                "complex_id": 1,
                "property_id": 5,
                "identifier": "Tag Identifier III",
                "number": "05386",
                "status_id": 1,
                "created_at": "2020-12-12T20:42:52.000000Z",
                "updated_at": "2020-12-12T20:45:58.000000Z",
                "deleted_at": null
            }
        }
    */
    public function delete($id)
    {
        try {
            $Tag = Tag::find($id);

            if (!is_null($Tag)) {
                $Tag->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Etiqueta eliminada satisfactoriamente.",
                    "data" => $Tag
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Etiqueta no encontrada.",
                    "data" => $Tag
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
    | Create or Update Tags Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Tag
    |
    */
    public function getRules() {
        return [
            'type_id' => 'required|exists:tag_types,id',
            #'vehicle_id' => 'required|exists:vehicles,id',
            'complex_id' => 'required|exists:complexes,id',
            #'property_id' => 'required|exists:properties,id',
            'identifier' => 'required',
            'number' => 'required',
            #'status_id' => 'required'
        ];
    }

    public function getMessages() {
        return [
            'type_id.required' => 'Debe elegir un Tipo de Etiqueta.',
            'type_id.exists' => 'No existe el Tipo de Etiqueta.',
            'complex_id.required' => 'Debe elegir un Complejo.',
            'complex_id.exists' => 'No existe el Complejo.',
            'identifier' => 'Debe escribir un Identificador.',
            'number' => 'Debe escribir un Número.',
        ];
    }
}
