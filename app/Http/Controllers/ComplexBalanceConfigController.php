<?php

namespace App\Http\Controllers;

use App\Models\ComplexBalanceConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexBalanceConfigController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Balance Config
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Complex Balance Config
    |
    |   {
    |        "complex_id" : 2,
    |        "percentage" : 5.00,
    |        "fixed" : 10.00,
    |        "client" : 1
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Configuración creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Configuración recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 2,
    |                        "percentage": "5.00",
    |                        "fixed": "10.00",
    |                        "client": "0",
    |                        "created_at": "2020-12-10T18:18:06.000000Z",
    |                        "updated_at": "2020-12-10T18:18:06.000000Z",
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
    |                        }
    |                    }
    |                ]
    |            },
    |            "exception": null
    |        }
    |    }
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
            $ComplexBalanceConfig = ComplexBalanceConfig::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Configuración creada satisfactoriamente.",
                "data" => $this->getByID($ComplexBalanceConfig->id)
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
    | Get All Complex Balance Configs
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Balance Configs
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
    |                "percentage": "5.00",
    |                "fixed": "10.00",
    |                "client": "0",
    |                "created_at": "2020-12-10T18:18:06.000000Z",
    |                "updated_at": "2020-12-10T18:18:06.000000Z",
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
    |                }
    |            },
    |            {
    |                "id": 3,
    |                "complex_id": 5,
    |                "percentage": "8.00",
    |                "fixed": "15.00",
    |                "client": "0",
    |                "created_at": "2020-12-10T18:46:34.000000Z",
    |                "updated_at": "2020-12-10T18:46:34.000000Z",
    |                "deleted_at": null,
    |                "complex": {
    |                    "id": 5,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": 2,
    |                    "type_id": 2,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium II",
    |                    "created_at": "2020-12-10T18:40:54.000000Z",
    |                    "updated_at": "2020-12-10T18:40:54.000000Z",
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
            $ComplexBalanceConfigs = ComplexBalanceConfig::with('complex')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexBalanceConfigs
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
    | Get Complex Balance Config by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Balance Config
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	 | Required  | Details                          |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance Config. Example : 3       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Configuración recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 3,
    |                "complex_id": 5,
    |                "percentage": "8.00",
    |                "fixed": "15.00",
    |                "client": "0",
    |                "created_at": "2020-12-10T18:46:34.000000Z",
    |                "updated_at": "2020-12-10T18:46:34.000000Z",
    |                "deleted_at": null,
    |                "complex": {
    |                    "id": 5,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": 2,
    |                    "type_id": 2,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium II",
    |                    "created_at": "2020-12-10T18:40:54.000000Z",
    |                    "updated_at": "2020-12-10T18:40:54.000000Z",
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
            $ComplexBalanceConfig = ComplexBalanceConfig::find($id);

            if (is_null($ComplexBalanceConfig)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Configuración no encontrada.",
                    "data" => $ComplexBalanceConfig
                ]);
            } else {
                $ComplexBalanceConfig = $ComplexBalanceConfig
                    ->with('complex')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Configuración recuperada satisfactoriamente.",
                "data" => $ComplexBalanceConfig
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
    | Update an ComplexBalanceConfig
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an ComplexBalanceConfig
    |
    |   {
    |        "id" : 3,
    |        "complex_id" : 5,
    |        "percentage" : 8.00,
    |        "fixed" : 16.00,
    |        "client" : 1
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    |    {
    |        "response": "success",
    |        "message": "Configuración actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Configuración recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "complex_id": 5,
    |                        "percentage": "8.00",
    |                        "fixed": "16.00",
    |                        "client": "0",
    |                        "created_at": "2020-12-10T18:46:34.000000Z",
    |                        "updated_at": "2020-12-10T18:50:11.000000Z",
    |                        "deleted_at": null,
    |                        "complex": {
    |                            "id": 5,
    |                            "owner_id": 1,
    |                            "admin_id": 1,
    |                            "created_by": 2,
    |                            "type_id": 2,
    |                            "use_id": 1,
    |                            "name": "Complex Paladium II",
    |                            "created_at": "2020-12-10T18:40:54.000000Z",
    |                            "updated_at": "2020-12-10T18:40:54.000000Z",
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
            $ComplexBalanceConfig = ComplexBalanceConfig::findOrFail($request->id);

            $ComplexBalanceConfig->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Configuración actualizada satisafactoriamente.",
                "data" => $this->getByID($ComplexBalanceConfig->id)
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
    | Delete an ComplexBalanceConfig
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific ComplexBalanceConfig
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Balance Config. Example : 3       |
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
    |        "message": "Configuración eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "complex_id": 5,
    |            "percentage": "8.00",
    |            "fixed": "16.00",
    |            "client": "0",
    |            "created_at": "2020-12-10T18:46:34.000000Z",
    |            "updated_at": "2020-12-10T18:50:11.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($config_id)
    {
        try {
            $ComplexBalanceConfig = ComplexBalanceConfig::find($config_id);
            if (!is_null($ComplexBalanceConfig)) {
                $ComplexBalanceConfig->destroy($config_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Configuración eliminada satisfactoriamente.",
                    "data" => $ComplexBalanceConfig
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Configuración no encontrada.",
                    "data" => $ComplexBalanceConfig
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
    |    for validations when you create or update an ComplexBalanceConfig
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'percentage' => 'required',
            'fixed' => 'required',
            'client' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
            'percentage' => 'Debe escribir un Porcentaje',
            'fixed' => 'Debe escribir un Saldo Fijo',
            'client' => 'Debe escribir un Cliente',
        ];
    }
}
