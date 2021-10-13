<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiclesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Vehicle
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Vehicle
    |
    |   {
    |        "complex_id" : 1,
    |        "property_id" : 1,
    |        "type_id" : 1,
    |        "brand" : "Honda",
    |        "model" : "Pilot",
    |        "plate" : "YFD-2432",
    |        "color" : "Green",
    |        "photo" : "N/A",
    |        "year"  : "1993"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Vehículo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Vehículo recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 4,
    |                        "complex_id": 1,
    |                        "property_id": 1,
    |                        "type_id": 1,
    |                        "brand": "Honda",
    |                        "model": "Pilot",
    |                        "plate": "YFD-2432",
    |                        "color": "Green",
    |                        "photo": "N/A",
    |                        "year": "1993",
    |                        "created_at": "2020-12-14T23:17:34.000000Z",
    |                        "updated_at": "2020-12-14T23:17:34.000000Z",
    |                        "deleted_at": null,
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
    |                            "created_at": "2020-12-14T13:16:57.000000Z",
    |                            "updated_at": "2020-12-14T13:16:57.000000Z",
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
    |                        "type": {
    |                            "id": 1,
    |                            "name": "4x4",
    |                            "created_at": "2020-12-14T13:19:04.000000Z",
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
            $Vehicle = Vehicle::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Vehículo creado satisfactoriamente.",
                "data" => $this->getByID($Vehicle->id)
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
    | Get All Vehicles
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Vehicles
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
    |                "id": 3,
    |                "complex_id": 1,
    |                "property_id": 1,
    |                "type_id": 1,
    |                "brand": "Honda",
    |                "model": "Pilot",
    |                "plate": "WOE-2039",
    |                "color": "Verde",
    |                "photo": "front.png",
    |                "year": "2003",
    |                "created_at": "2020-12-14T13:19:09.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null,
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
    |                    "created_at": "2020-12-14T13:16:57.000000Z",
    |                    "updated_at": "2020-12-14T13:16:57.000000Z",
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
    |                "type": {
    |                    "id": 1,
    |                    "name": "4x4",
    |                    "created_at": "2020-12-14T13:19:04.000000Z",
    |                    "updated_at": null,
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 4,
    |                "complex_id": 1,
    |                "property_id": 1,
    |                "type_id": 1,
    |                "brand": "Honda",
    |                "model": "Pilot",
    |                "plate": "YFD-2432",
    |                "color": "Green",
    |                "photo": "N/A",
    |                "year": "1993",
    |                "created_at": "2020-12-14T23:17:34.000000Z",
    |                "updated_at": "2020-12-14T23:17:34.000000Z",
    |                "deleted_at": null,
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
    |                    "created_at": "2020-12-14T13:16:57.000000Z",
    |                    "updated_at": "2020-12-14T13:16:57.000000Z",
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
    |                "type": {
    |                    "id": 1,
    |                    "name": "4x4",
    |                    "created_at": "2020-12-14T13:19:04.000000Z",
    |                    "updated_at": null,
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
            $Vehicles = Vehicle::with('property')
                ->with('complex')
                ->with('type')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Vehicles
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
    | Get Vehicle by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Vehicle
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Vehicle     |
    |  |            |        |          | Example : 3                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Vehículo recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 3,
    |                "complex_id": 1,
    |                "property_id": 1,
    |                "type_id": 1,
    |                "brand": "Honda",
    |                "model": "Pilot",
    |                "plate": "WOE-2039",
    |                "color": "Verde",
    |                "photo": "front.png",
    |                "year": "2003",
    |                "created_at": "2020-12-14T13:19:09.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null,
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
    |                    "created_at": "2020-12-14T13:16:57.000000Z",
    |                    "updated_at": "2020-12-14T13:16:57.000000Z",
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
    |                "type": {
    |                    "id": 1,
    |                    "name": "4x4",
    |                    "created_at": "2020-12-14T13:19:04.000000Z",
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
        try{
            $Vehicle = Vehicle::find($id);

            if (is_null($Vehicle)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Vehículo no encontrado.",
                    "data" => $Vehicle
                ]);
            } else {
                $Vehicle = $Vehicle
                    ->with('property')
                    ->with('complex')
                    ->with('type')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Vehículo recuperado satisfactoriamente.",
                "data" => $Vehicle
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
    | Update an Vehicle
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Vehicle
    |
    |   {
    |        "id" : 3,
    |        "complex_id" : 1,
    |        "property_id" : 1,
    |        "type_id" : 1,
    |        "brand" : "Honda",
    |        "model" : "Pilot",
    |        "plate" : "YFD-6454",
    |        "color" : "Green",
    |        "photo" : "N/A",
    |        "year"  : "1993"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Vehículo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Vehículo recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "complex_id": 1,
    |                        "property_id": 1,
    |                        "type_id": 1,
    |                        "brand": "Honda",
    |                        "model": "Pilot",
    |                        "plate": "YFD-6454",
    |                        "color": "Green",
    |                        "photo": "N/A",
    |                        "year": "1993",
    |                        "created_at": "2020-12-14T13:19:09.000000Z",
    |                        "updated_at": "2020-12-14T23:23:10.000000Z",
    |                        "deleted_at": null,
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
    |                            "created_at": "2020-12-14T13:16:57.000000Z",
    |                            "updated_at": "2020-12-14T13:16:57.000000Z",
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
    |                        "type": {
    |                            "id": 1,
    |                            "name": "4x4",
    |                            "created_at": "2020-12-14T13:19:04.000000Z",
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
            $Vehicle = Vehicle::findOrFail($request->id);

            $Vehicle->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Vehículo actualizado satisafactoriamente.",
                "data" => $this->getByID($Vehicle->id)
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
    | Delete an Vehicle
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Vehicle
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Vehicle    |
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
    |        "message": "Vehículo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "complex_id": 1,
    |            "property_id": 1,
    |            "type_id": 1,
    |            "brand": "Honda",
    |            "model": "Pilot",
    |            "plate": "YFD-6454",
    |            "color": "Green",
    |            "photo": "N/A",
    |            "year": "1993",
    |            "created_at": "2020-12-14T13:19:09.000000Z",
    |            "updated_at": "2020-12-14T23:23:10.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $Vehicle = Vehicle::find($id);

            if (!is_null($Vehicle)) {
                $Vehicle->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Vehículo eliminado satisfactoriamente.",
                    "data" => $Vehicle
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Vehículo no encontrado.",
                    "data" => $Vehicle
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
    | Create or Update Vehicles Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Vehicle
    |
    */
    public function getRules() {
        return [
            "complex_id"  => "required|exists:complexes,id",
            "property_id" => "required|exists:properties,id",
            "type_id" => "required|exists:vehicle_types,id",
            "brand" => "required",
            "model" => "required",
            "plate" => "required",
            "color" => "required",
            "photo" => "required",
            "year" => "required"
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo.',
            'complex_id.exists' => 'No existe el Complejo.',
            'property_id.required' => 'Debe elegir una Propiedad.',
            'property_id.exists' => 'No existe la Propiedad.',
            'type_id.required' => 'Debe elegir un Tipo de Vehículo.',
            'type_id.exists' => 'No existe el Tipo de Vehículo.',
            'brand' => 'Debe escribir una Marca.',
            'model' => 'Debe escribir un Modelo.',
            'plate' => 'Debe escribir una Matrícula.',
            'color' => 'Debe escribir un Color.',
            'photo' => 'Debe seleccionar una Foto.',
            'year' => 'Debe escribir un Año.',
        ];
    }
}
