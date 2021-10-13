<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Address
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Address
    |
    |   {
    |        "complex_id":2,
    |        "property_id":1,
    |        "street":"Big Sur",
    |        "house_number": "710",
    |        "settlement": "Lorem Ipsum Dolor",
    |        "postal_code": 91170,
    |        "locality": "Xalapa",
    |        "town": "Xalapa",
    |        "state": "Veracruz",
    |        "country": "México",
    |        "latitude": "20.638295856990894",
    |        "longitude" :"-87.06401714869082"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Dirección creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Dirección recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 2,
    |                        "property_id": 1,
    |                        "street": "Big Sur",
    |                        "house_number": "710",
    |                        "suite_number": null,
    |                        "settlement": "Lorem Ipsum Dolor",
    |                        "postal_code": "91170",
    |                        "locality": "Xalapa",
    |                        "town": "Xalapa",
    |                        "state": "Veracruz",
    |                        "country": "México",
    |                        "latitude": "20.638295856990894",
    |                        "longitude": "-87.06401714869082",
    |                        "created_at": "2020-12-09T16:41:42.000000Z",
    |                        "updated_at": "2020-12-09T16:41:42.000000Z",
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
    |                        "property": {
    |                            "id": 1,
    |                            "complex_id": 2,
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
    |                            "created_at": "2020-12-04T11:41:41.000000Z",
    |                            "updated_at": "2020-12-04T11:41:41.000000Z",
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
            $Address = Address::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Dirección creada satisfactoriamente.",
                "data" => $this->getByID($Address->id)
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
    | Get All Addresses
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Addresses
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
    |                "complex_id": 2,
    |                "property_id": 1,
    |                "street": "Big Sur",
    |                "house_number": "710",
    |                "suite_number": null,
    |                "settlement": "Lorem Ipsum Dolor",
    |                "postal_code": "91170",
    |                "locality": "Xalapa",
    |                "town": "Xalapa",
    |                "state": "Veracruz",
    |                "country": "México",
    |                "latitude": "20.638295856990894",
    |                "longitude": "-87.06401714869082",
    |                "created_at": "2020-12-09T16:41:42.000000Z",
    |                "updated_at": "2020-12-09T16:41:42.000000Z",
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
    |                "property": {
    |                    "id": 1,
    |                    "complex_id": 2,
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
    |                    "created_at": "2020-12-04T11:41:41.000000Z",
    |                    "updated_at": "2020-12-04T11:41:41.000000Z",
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
            $Addresses = Address::with('complex')
                ->with('property')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Addresses
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
    | Get Address by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Address
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Address     |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |    "response": "success",
    |    "message": "Dirección recuperada satisfactoriamente.",
    |    "data": [
    |        {
    |            "id": 1,
    |            "complex_id": 2,
    |            "property_id": 1,
    |            "street": "Big Sur",
    |            "house_number": "710",
    |            "suite_number": null,
    |            "settlement": "Lorem Ipsum Dolor",
    |            "postal_code": "91170",
    |            "locality": "Xalapa",
    |            "town": "Xalapa",
    |            "state": "Veracruz",
    |            "country": "México",
    |            "latitude": "20.638295856990894",
    |            "longitude": "-87.06401714869082",
    |            "created_at": "2020-12-09T16:41:42.000000Z",
    |            "updated_at": "2020-12-09T16:41:42.000000Z",
    |            "deleted_at": null,
    |            "complex": {
    |                "id": 2,
    |                "owner_id": 1,
    |                "admin_id": 2,
    |                "created_by": 2,
    |                "type_id": 1,
    |                "use_id": 1,
    |                "name": "Cluster BRC",
    |                "created_at": "2020-11-24T23:09:39.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null
    |            },
    |            "property": {
    |                "id": 1,
    |                "complex_id": 2,
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
    |                "created_at": "2020-12-04T11:41:41.000000Z",
    |                "updated_at": "2020-12-04T11:41:41.000000Z",
    |                "deleted_at": null
    |            }
    |        }
    |    ]
    |   }
    |
    |
    */
    public function getByID($id) {
        try{
            $Address = Address::find($id);

            if (is_null($Address)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Dirección no encontrada.",
                    "data" => $Address
                ]);
            } else {
                $Address = $Address
                    ->with('complex')
                    ->with('property')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Dirección recuperada satisfactoriamente.",
                "data" => $Address
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
    | Update an Address
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Address
    |
    |   {
    |        "id": 1,
    |        "complex_id":2,
    |        "property_id":1,
    |        "street":"Big Sur 9",
    |        "house_number": "710",
    |        "settlement": "Lorem Ipsum Dolor...",
    |        "postal_code": 10013,
    |        "locality": "Xalapa",
    |        "town": "Xalapa",
    |        "state": "Veracruz",
    |        "country": "México",
    |        "latitude": "20.638295846990834",
    |        "longitude" :"-87.06401314849082"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Dirección actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Dirección recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 2,
    |                        "property_id": 1,
    |                        "street": "Big Sur 9",
    |                        "house_number": "710",
    |                        "suite_number": null,
    |                        "settlement": "Lorem Ipsum Dolor...",
    |                        "postal_code": "10013",
    |                        "locality": "Xalapa",
    |                        "town": "Xalapa",
    |                        "state": "Veracruz",
    |                        "country": "México",
    |                        "latitude": "20.638295846990834",
    |                        "longitude": "-87.06401314849082",
    |                        "created_at": "2020-12-09T16:41:42.000000Z",
    |                        "updated_at": "2020-12-09T16:46:34.000000Z",
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
    |                        "property": {
    |                            "id": 1,
    |                            "complex_id": 2,
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
    |                            "created_at": "2020-12-04T11:41:41.000000Z",
    |                            "updated_at": "2020-12-04T11:41:41.000000Z",
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
            $Address = Address::findOrFail($request->id);

            $Address->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Dirección actualizada satisafactoriamente.",
                "data" => $this->getByID($Address->id)
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
    | Delete an Address
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Address
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Address    |
    |  |            |        |          | Example : 1                       |
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
    |        "message": "Dirección eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "complex_id": 2,
    |            "property_id": 1,
    |            "street": "Big Sur 9",
    |            "house_number": "710",
    |            "suite_number": null,
    |            "settlement": "Lorem Ipsum Dolor...",
    |            "postal_code": "10013",
    |            "locality": "Xalapa",
    |            "town": "Xalapa",
    |            "state": "Veracruz",
    |            "country": "México",
    |            "latitude": "20.638295846990834",
    |            "longitude": "-87.06401314849082",
    |            "created_at": "2020-12-09T16:41:42.000000Z",
    |            "updated_at": "2020-12-09T16:46:34.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($address_id)
    {
        try {
            $Address = Address::find($address_id);


            if (!is_null($Address)) {
                $Address->destroy($address_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Dirección eliminada satisfactoriamente.",
                    "data" => $Address
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Dirección no encontrada.",
                    "data" => $Address
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
    | Create or Update Addresses Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Address
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'property_id' => 'required|exists:properties,id',
            'street' => 'required',
            'house_number' => 'required',
            'settlement' => 'required',
            'postal_code' => 'required',
            'locality' => 'required',
            'town' => 'required',
            'state' => 'required',
            'country' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
            'property_id.required' => 'Debe elegir una Propiedad',
            'property_id.exists' => 'No existe la Propiedad',
            'street' => 'Debe escribir una Calle',
            'house_number' => 'Debe escribir un número',
            'settlement' => 'Debe aceptar el acuerdo',
            'postal_code' => 'Debe escribir el Código Postal',
            'locality' => 'Debe escribir una Localidad',
            'town' => 'Debe escribir Municipio',
            'state' => 'Debe escribir un Estado',
            'country' => 'Debe escribir una Ciudad',
            'latitude' => 'Debe escribir una Latitud',
            'longitude' => 'Debe escribir una Longitud',
        ];
    }
}
