<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create PaymentType
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an PaymentType
    |
    |   {
    |        "name" : "Type A",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Pago creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Pago recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Type A",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-12T15:49:21.000000Z",
    |                    "updated_at": "2020-12-12T15:49:21.000000Z",
    |                    "deleted_at": null
    |                }
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
            $PaymentType = PaymentType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Pago creado satisfactoriamente.",
                "data" => $this->getByID($PaymentType->id)
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
    |    {
    |        "response": "success",
    |        "message": "Lista recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "name": "Transaction",
    |                "description": "Lorem Impsum Dolor",
    |                "created_at": "2020-12-11T19:59:12.000000Z",
    |                "updated_at": "2020-12-11T19:59:12.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Type A",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-12T15:49:21.000000Z",
    |                "updated_at": "2020-12-12T15:49:21.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Type B",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-12T15:50:07.000000Z",
    |                "updated_at": "2020-12-12T15:50:07.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $PaymentTypes = PaymentType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $PaymentTypes
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
    | Get Payment Type by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific PaymentType
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Payment Type|
    |  |            |        |         | Example : 2                        |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Pago recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Type A",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T15:49:21.000000Z",
    |            "updated_at": "2020-12-12T15:49:21.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $PaymentType = PaymentType::find($id);

            if (is_null($PaymentType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Pago no encontrado.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Pago recuperado satisfactoriamente.",
                "data" => $PaymentType
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
    | Update Payment Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Payment Types
    |
    |   {
    |        "id" : 2,
    |        "name" : "Type B2",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Pago actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Pago recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Type B2",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-12T15:49:21.000000Z",
    |                    "updated_at": "2020-12-12T15:52:15.000000Z",
    |                    "deleted_at": null
    |                }
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
            $PaymentType = PaymentType::findOrFail($request->id);

            $PaymentType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Pago actualizado satisafactoriamente.",
                "data" => $this->getByID($PaymentType->id)
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
    | Delete Payment Types
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Payment Types
    |   using the following parameter:
    |
    |   _____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                            |
    |  |---------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Payment Type|
    |  |            |        |          | Example : 4                        |
    |  |            |        |          |                                    |
    |  |____________|________|__________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Pago eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "name": "Type 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T15:52:58.000000Z",
    |            "updated_at": "2020-12-12T15:52:58.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $PaymentType = PaymentType::find($id);

            if (!is_null($PaymentType)) {
                $PaymentType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Pago eliminado satisfactoriamente.",
                    "data" => $PaymentType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Pago no encontrado.",
                    "data" => $PaymentType
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
    | Create or Update Payment Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Payment Types
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:payment_providers',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre',
            'description.required' => 'Debe escribir una Descripción',
        ];
    }
}
