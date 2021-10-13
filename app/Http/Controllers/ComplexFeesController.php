<?php

namespace App\Http\Controllers;

use App\Models\ComplexFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexFeesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Fees
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Complex Fees
    |
    |   {
    |        "complex_id" : 2,
    |        "type_id" : 1,
    |        "amount" : 17000,
    |        "cutoff" : 8,
    |        "limit" : 5
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuota del Complejo creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuota del Complejo recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 2,
    |                        "type_id": 1,
    |                        "amount": "17000.00",
    |                        "cutoff": 8,
    |                        "limit": 5,
    |                        "created_at": "2020-12-11T05:31:22.000000Z",
    |                        "updated_at": "2020-12-11T05:31:22.000000Z",
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
    |                        "complex_fee_type": {
    |                            "id": 1,
    |                            "name": "Akufen",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-11T04:54:52.000000Z",
    |                            "updated_at": "2020-12-11T04:54:52.000000Z",
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
            $ComplexFee = ComplexFee::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuota del Complejo creada satisfactoriamente.",
                "data" => $this->getByID($ComplexFee->id)
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
    | Get All Complex Fees
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Fees
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
    |                "complex_id": 2,
    |                "type_id": 1,
    |                "amount": "14000.00",
    |                "cutoff": 15,
    |                "limit": 10,
    |                "created_at": "2020-12-11T05:29:00.000000Z",
    |                "updated_at": "2020-12-11T05:29:00.000000Z",
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
    |                "complex_fee_type": {
    |                    "id": 1,
    |                    "name": "Akufen",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T04:54:52.000000Z",
    |                    "updated_at": "2020-12-11T04:54:52.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "type_id": 1,
    |                "amount": "17000.00",
    |                "cutoff": 8,
    |                "limit": 5,
    |                "created_at": "2020-12-11T05:31:22.000000Z",
    |                "updated_at": "2020-12-11T05:31:22.000000Z",
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
    |                "complex_fee_type": {
    |                    "id": 1,
    |                    "name": "Akufen",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T04:54:52.000000Z",
    |                    "updated_at": "2020-12-11T04:54:52.000000Z",
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
            $ComplexFees = ComplexFee::with('complex')
                ->with('complex_fee_type')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexFees
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
    | Get Complex Fee by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Fee
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Complex Fee |
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
    |        "message": "Cuota del Complejo recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "type_id": 1,
    |                "amount": "17000.00",
    |                "cutoff": 8,
    |                "limit": 5,
    |                "created_at": "2020-12-11T05:31:22.000000Z",
    |                "updated_at": "2020-12-11T05:31:22.000000Z",
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
    |                "complex_fee_type": {
    |                    "id": 1,
    |                    "name": "Akufen",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T04:54:52.000000Z",
    |                    "updated_at": "2020-12-11T04:54:52.000000Z",
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
            $ComplexFee = ComplexFee::find($id);

            if (is_null($ComplexFee)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuota del Complejo no encontrada.",
                    "data" => $ComplexFee
                ]);
            } else {
                $ComplexFee = $ComplexFee
                    ->with('complex')
                    ->with('complex_fee_type')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Cuota del Complejo recuperada satisfactoriamente.",
                "data" => $ComplexFee
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
    | Update an Complex Fee
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Complex Fee
    |
    |   {
    |        "id" : 2,
    |        "complex_id" : 2,
    |        "type_id" : 1,
    |        "amount" : 17000,
    |        "cutoff" : 8,
    |        "limit" : 5
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuota del Complejo actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuota del Complejo recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 2,
    |                        "type_id": 1,
    |                        "amount": "17000.00",
    |                        "cutoff": 8,
    |                        "limit": 5,
    |                        "created_at": "2020-12-11T05:31:22.000000Z",
    |                        "updated_at": "2020-12-11T05:35:00.000000Z",
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
    |                        "complex_fee_type": {
    |                            "id": 1,
    |                            "name": "Akufen",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-11T04:54:52.000000Z",
    |                            "updated_at": "2020-12-11T04:54:52.000000Z",
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
            $ComplexFee = ComplexFee::findOrFail($request->id);

            $ComplexFee->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuota del Complejo actualizada satisafactoriamente.",
                "data" => $this->getByID($ComplexFee->id)
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
    | Delete an Complex Fee
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Fee
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex Fee|
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
    |        "message": "Cuota del Complejo eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "complex_id": 2,
    |            "type_id": 1,
    |            "amount": "17000.00",
    |            "cutoff": 8,
    |            "limit": 5,
    |            "created_at": "2020-12-11T05:31:22.000000Z",
    |            "updated_at": "2020-12-11T05:35:00.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $ComplexFee = ComplexFee::find($id);


            if (!is_null($ComplexFee)) {
                $ComplexFee->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuota del Complejo eliminada satisfactoriamente.",
                    "data" => $ComplexFee
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuota del Complejo no encontrada.",
                    "data" => $ComplexFee
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
    | Create or Update Complex Fees Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Complex Fees
    |
    */
    public function getRules() {
        return [
            'amount' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'amount.required' => 'Debe escribir un Monto',
        ];
    }
}
