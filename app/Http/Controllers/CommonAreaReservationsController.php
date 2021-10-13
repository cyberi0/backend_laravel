<?php

namespace App\Http\Controllers;

use App\Models\CommonAreaReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonAreaReservationsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Common Area Reservation
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Common Area Reservation
    |   {
    |        "common_area_id" : 1,
    |        "property_id" : 1,
    |        "payment_id" : null,
    |        "starts_at" : "2020-12-04 15:28:46",
    |        "ends_at" : "2021-01-04 15:28:46",
    |        "amount" : 5000
    |    }
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Área Común creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Área Común recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "common_area_id": 1,
    |                        "property_id": 1,
    |                        "payment_id": null,
    |                        "starts_at": "2020-12-04 15:28:46",
    |                        "ends_at": "2021-01-04 15:28:46",
    |                        "amount": "5000.00",
    |                        "created_at": "2020-12-04T17:56:23.000000Z",
    |                        "updated_at": "2020-12-04T17:56:23.000000Z",
    |                        "deleted_at": null,
    |                        "common_area": {
    |                            "id": 1,
    |                            "complex_id": 2,
    |                            "name": "Cool Area",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "price": "1500.00",
    |                            "price_type": "1",
    |                            "price_unit": "MXN",
    |                            "created_at": "2020-12-04T17:45:17.000000Z",
    |                            "updated_at": "2020-12-04T17:45:17.000000Z",
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
    |                        },
    |                        "payment": null
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
            $CommonAreaReservation = CommonAreaReservation::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Área Común creada satisfactoriamente.",
                "data" => $this->getByID($CommonAreaReservation->id)
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
    | Get All Common Area Reservations
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Common Area Reservations
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |       "response": "success",
    |       "message": "Lista recuperada satisfactoriamente.",
    |       "data": [
    |           {
    |               "id": 1,
    |               "common_area_id": 1,
    |               "property_id": 1,
    |               "payment_id": null,
    |               "starts_at": "2020-12-04 15:28:46",
    |               "ends_at": "2021-01-04 15:28:46",
    |               "amount": "5000.00",
    |               "created_at": "2020-12-04T17:45:30.000000Z",
    |               "updated_at": "2020-12-04T17:45:30.000000Z",
    |               "deleted_at": null,
    |               "common_area": {
    |                   "id": 1,
    |                   "complex_id": 2,
    |                   "name": "Cool Area",
    |                   "description": "Lorem Ipsum Dolor",
    |                   "price": "1500.00",
    |                   "price_type": "1",
    |                   "price_unit": "MXN",
    |                   "created_at": "2020-12-04T17:45:17.000000Z",
    |                   "updated_at": "2020-12-04T17:45:17.000000Z",
    |                   "deleted_at": null
    |               },
    |               "property": {
    |                   "id": 1,
    |                   "complex_id": 2,
    |                   "type_id": 1,
    |                   "owner_id": 2,
    |                   "occupant_id": 1,
    |                   "name": "ASDFASDF",
    |                   "floor": "ASDFASDF",
    |                   "number": "ASDFAFDS",
    |                   "contract": "ASDFASDFASDF",
    |                   "contract_expired_at": null,
    |                   "proportions": null,
    |                   "document": null,
    |                   "book": null,
    |                   "created_at": "2020-12-04T11:41:41.000000Z",
    |                   "updated_at": "2020-12-04T11:41:41.000000Z",
    |                   "deleted_at": null
    |               },
    |               "payment": null
    |           },
    |           {
    |               "id": 2,
    |               "common_area_id": 1,
    |               "property_id": 1,
    |               "payment_id": null,
    |               "starts_at": "2020-12-04 15:28:46",
    |               "ends_at": "2021-01-04 15:28:46",
    |               "amount": "5000.00",
    |               "created_at": "2020-12-04T17:56:23.000000Z",
    |               "updated_at": "2020-12-04T17:56:23.000000Z",
    |               "deleted_at": null,
    |               "common_area": {
    |                   "id": 1,
    |                   "complex_id": 2,
    |                   "name": "Cool Area",
    |                   "description": "Lorem Ipsum Dolor",
    |                   "price": "1500.00",
    |                   "price_type": "1",
    |                   "price_unit": "MXN",
    |                   "created_at": "2020-12-04T17:45:17.000000Z",
    |                   "updated_at": "2020-12-04T17:45:17.000000Z",
    |                   "deleted_at": null
    |               },
    |               "property": {
    |                   "id": 1,
    |                   "complex_id": 2,
    |                   "type_id": 1,
    |                   "owner_id": 2,
    |                   "occupant_id": 1,
    |                   "name": "ASDFASDF",
    |                   "floor": "ASDFASDF",
    |                   "number": "ASDFAFDS",
    |                   "contract": "ASDFASDFASDF",
    |                   "contract_expired_at": null,
    |                   "proportions": null,
    |                   "document": null,
    |                   "book": null,
    |                   "created_at": "2020-12-04T11:41:41.000000Z",
    |                   "updated_at": "2020-12-04T11:41:41.000000Z",
    |                   "deleted_at": null
    |               },
    |               "payment": null
    |           }
    |       ]
    |   }
    |
    */
    public function getAll() {
        try {
            $CommonAreaReservations = CommonAreaReservation::with('common_area')
                    ->with('property')
                    ->with('payment')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $CommonAreaReservations
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
    | Get Common Area Reservation by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Common Area Reservations
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Common Area |
    |  |            |        |         | Reservation. Example : 3           |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Área Común recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "common_area_id": 1,
    |                "property_id": 1,
    |                "payment_id": null,
    |                "starts_at": "2020-12-04 15:28:46",
    |                "ends_at": "2021-01-04 15:28:46",
    |                "amount": "5000.00",
    |                "created_at": "2020-12-04T17:56:23.000000Z",
    |                "updated_at": "2020-12-04T17:56:23.000000Z",
    |                "deleted_at": null,
    |                "common_area": {
    |                    "id": 1,
    |                    "complex_id": 2,
    |                    "name": "Cool Area",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "price": "1500.00",
    |                    "price_type": "1",
    |                    "price_unit": "MXN",
    |                    "created_at": "2020-12-04T17:45:17.000000Z",
    |                    "updated_at": "2020-12-04T17:45:17.000000Z",
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
    |                },
    |                "payment": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $CommonAreaReservation = CommonAreaReservation::find($id);

            if (is_null($CommonAreaReservation)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Área Común no encontrada.",
                    "data" => $CommonAreaReservation
                ]);
            } else {
                $CommonAreaReservation = $CommonAreaReservation
                    ->with('common_area')
                    ->with('property')
                    ->with('payment')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Área Común recuperada satisfactoriamente.",
                "data" => $CommonAreaReservation
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
    | Update Common Area Reservation
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Common Area Reservation
    |
    |{
    "id": 1,
    "common_area_id" : 1,
    "property_id" : 1,
    "payment_id" : 3,
    "starts_at" : "2020-12-05",
    "ends_at" : "2021-01-05",
    "amount" : 6710
}
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Área Común actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Área Común recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "common_area_id": 1,
    |                        "property_id": 1,
    |                        "payment_id": 3,
    |                        "starts_at": "2020-12-05 00:00:00",
    |                        "ends_at": "2021-01-05 00:00:00",
    |                        "amount": "6710.00",
    |                        "created_at": "2020-12-04T17:45:30.000000Z",
    |                        "updated_at": "2020-12-04T18:44:14.000000Z",
    |                        "deleted_at": null,
    |                        "common_area": {
    |                            "id": 1,
    |                            "complex_id": 2,
    |                            "name": "Cool Area",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "price": "1500.00",
    |                            "price_type": "1",
    |                            "price_unit": "MXN",
    |                            "created_at": "2020-12-04T17:45:17.000000Z",
    |                            "updated_at": "2020-12-04T17:45:17.000000Z",
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
    |                        },
    |                        "payment": {
    |                            "id": 3,
    |                            "method_id": 1,
    |                            "account_id": 1,
    |                            "card_id": 1,
    |                            "provider_id": 1,
    |                            "complex_id": 2,
    |                            "property_id": 1,
    |                            "type_id": 1,
    |                            "registered_by": 1,
    |                            "cdr": "SDFGSG",
    |                            "reference": "SDFGSDFG",
    |                            "way": "1",
    |                            "month": "1",
    |                            "year": "2312",
    |                            "name": "ASDFASFA",
    |                            "description": "ASDFASDFSA",
    |                            "amount": "1234.00",
    |                            "paid": "423.00",
    |                            "fee": "23423.00",
    |                            "charge": "12331.00",
    |                            "config": null,
    |                            "receipt": "ASDFASDF",
    |                            "comments": "ASDFASDF AS DA ASDF ",
    |                            "created_at": null,
    |                            "updated_at": null,
    |                            "deleted_at": null,
    |                            "registered_at": null,
    |                            "paid_at": null,
    |                            "expired_at": null,
    |                            "withdrawal_requested_at": null,
    |                            "withdrawn_at": null,
    |                            "chargedback_at": null,
    |                            "chargeback_covered_at": null
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
            $CommonAreaReservation = CommonAreaReservation::findOrFail($request->id);

            $CommonAreaReservation->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Área Común actualizada satisafactoriamente.",
                "data" => $this->getByID($CommonAreaReservation->id)
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
    | Delete Common Area Reservation
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Account
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Common Area|
    |  |            |        |          | Reservation. Example : 2          |
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
    |        "message": "Área Común eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "common_area_id": 1,
    |            "property_id": 1,
    |            "payment_id": 3,
    |            "starts_at": "2020-12-05 00:00:00",
    |            "ends_at": "2021-01-05 00:00:00",
    |            "amount": "6710.00",
    |            "created_at": "2020-12-04T17:45:30.000000Z",
    |            "updated_at": "2020-12-04T18:44:14.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($reservation_id)
    {
        try {
            $CommonAreaReservation = CommonAreaReservation::find($reservation_id);


            if (!is_null($CommonAreaReservation)) {
                $CommonAreaReservation->destroy($reservation_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Área Común eliminada satisfactoriamente.",
                    "data" => $CommonAreaReservation
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Área Común no encontrada.",
                    "data" => $CommonAreaReservation
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
    | Create or Update Common Area Reservations Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Common Area Reservations
    |
    */
    public function getRules() {
        return [
            'common_area_id' => 'required|exists:common_areas,id',
            'property_id' => 'required|exists:properties,id',
            'payment_id' => 'exists:payments,id',
            'starts_at' => 'required',
            'ends_at' => 'required',
            'amount' => 'required'
        ];
    }

    public function getMessages() {
        return [
            'common_area_id.required' => 'Debe elegir un Área Común',
            'common_area_id.exists' => 'No existe el Área Común',
            'property_id.required' => 'Debe elegir una Propiedad',
            'property_id.exists' => 'No existe la Propiedad',
            'payment_id.exists' => 'No existe el Pago',
            'starts_at' => 'Debe una Fecha de Inicio',
            'ends_at' => 'Debe una Fecha de Término',
            'amount' => 'Debe ingresar una Monto'
        ];
    }
}
