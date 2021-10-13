<?php

namespace App\Http\Controllers;

use App\Models\PaymentProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentProvidersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Payment Providers
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Payment Providers
    |
    |   {
    |       "name" : "Akufen",
    |       "description" : "Lorem Ipsum Dolor"
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Pago a Proveedores creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Pago a Proveedores recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Akufen",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "default": "1",
    |                    "created_at": "2020-12-12T15:31:07.000000Z",
    |                    "updated_at": "2020-12-12T15:31:07.000000Z",
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
            $PaymentProvider = PaymentProvider::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Pago a Proveedores creada satisfactoriamente.",
                "data" => $this->getByID($PaymentProvider->id)
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
    | Get All Payment Providers
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Payment Providers
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
    |                "name": "TaggerApi",
    |                "description": "Lorem Ipsum Dolor",
    |                "default": "1",
    |                "created_at": "2020-12-11T19:58:45.000000Z",
    |                "updated_at": "2020-12-11T19:58:45.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Atouk",
    |                "description": "Lorem Ipsum Dolor",
    |                "default": "1",
    |                "created_at": "2020-12-11T19:59:01.000000Z",
    |                "updated_at": "2020-12-11T19:59:01.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Akufen",
    |                "description": "Lorem Ipsum Dolor",
    |                "default": "1",
    |                "created_at": "2020-12-12T15:31:07.000000Z",
    |                "updated_at": "2020-12-12T15:31:07.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 4,
    |                "name": "Mutek",
    |                "description": "Lorem Ipsum Dolor",
    |                "default": "1",
    |                "created_at": "2020-12-12T15:32:18.000000Z",
    |                "updated_at": "2020-12-12T15:32:18.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $PaymentProviders = PaymentProvider::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $PaymentProviders
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
    | Get Payment Provider by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Payment Provider
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Payment    |
    |  |            |        |          | Provider. Example : 4             |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Pago a Proveedores recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "name": "Mutek",
    |            "description": "Lorem Ipsum Dolor",
    |            "default": "1",
    |            "created_at": "2020-12-12T15:32:18.000000Z",
    |            "updated_at": "2020-12-12T15:32:18.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $account = PaymentProvider::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Pago a Proveedores no encontrada.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Pago a Proveedores recuperado satisfactoriamente.",
                "data" => $account
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
    | Update an PaymentProvider
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an PaymentProvider
    |
    |   {
    |        "id" : 4,
    |        "name" : "Mutek II",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Pago a Proveedores actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Pago a Proveedores recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 4,
    |                    "name": "Mutek II",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "default": "1",
    |                    "created_at": "2020-12-12T15:32:18.000000Z",
    |                    "updated_at": "2020-12-12T15:34:40.000000Z",
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
            $PaymentProvider = PaymentProvider::findOrFail($request->id);

            $PaymentProvider->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Pago a Proveedores actualizado satisafactoriamente.",
                "data" => $this->getByID($PaymentProvider->id)
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
    | Delete an Payment Provider
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Payment Provider
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Payment    |
    |  |            |        |          | Provider. Example : 3             |
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
    |        "message": "Pago a Proveedores eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "name": "Akufen",
    |            "description": "Lorem Ipsum Dolor",
    |            "default": "1",
    |            "created_at": "2020-12-12T15:31:07.000000Z",
    |            "updated_at": "2020-12-12T15:31:07.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $PaymentProvider = PaymentProvider::find($id);

            if (!is_null($PaymentProvider)) {
                $PaymentProvider->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Pago a Proveedores eliminado satisfactoriamente.",
                    "data" => $PaymentProvider
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Pago a Proveedores no encontrada.",
                    "data" => $PaymentProvider
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
    | Create or Update Payment Providers Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Payment Providers
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
