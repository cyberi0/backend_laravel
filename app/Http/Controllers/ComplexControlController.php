<?php

namespace App\Http\Controllers;

use App\Models\ComplexControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexControlController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Control
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Complex Control
    |
    |   {
    |        "complex_id" : 2,
    |        "url" : "https://www.wobisoft.com",
    |        "api_uuid" : "YXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0",
    |        "api_key" : "vI1_AbTJ7K8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |        "pi_id" : "EsImVtYWlsIjoiY2xtQGFkbWluL",
    |        "pi_access_token" :"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI1_AbTJ7K8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |        "last_ping": "2020-12-04 17:30:40"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Control creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Control recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 2,
    |                        "url": "https://www.wobisoft.com",
    |                        "api_uuid": "YXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0",
    |                        "api_key": "vI1_AbTJ7K8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                        "pi_id": "EsImVtYWlsIjoiY2xtQGFkbWluL",
    |                        "pi_access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI1_AbTJ7K8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                        "created_at": "2020-12-11T03:43:36.000000Z",
    |                        "updated_at": "2020-12-11T03:43:36.000000Z",
    |                        "deleted_at": null,
    |                        "last_ping": "2020-12-04 17:30:40",
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
    |        */
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
            $ComplexControl = ComplexControl::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Control creado satisfactoriamente.",
                "data" => $this->getByID($ComplexControl->id)
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
    | Get All Complex Controls
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Controls
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
    |                "url": "https://www.wobisoft.com",
    |                "api_uuid": "YXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0",
    |                "api_key": "vI1_AbTJ7K8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                "pi_id": "EsImVtYWlsIjoiY2xtQGFkbWluL",
    |                "pi_access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI1_AbTJ7K8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                "created_at": "2020-12-11T03:43:36.000000Z",
    |                "updated_at": "2020-12-11T03:43:36.000000Z",
    |                "deleted_at": null,
    |                "last_ping": "2020-12-04 17:30:40",
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
    |                "id": 2,
    |                "complex_id": 2,
    |                "url": "https://www.wobisoft.com",
    |                "api_uuid": "QxyTiOtE2RSc4NTs3NzgsImV4cCI6MTYwODI2MjU3OH0",
    |                "api_key": "vI2_AnRL8J5EEnhnIh7vtRNEc3tdsfgsdduU3E_JuqmjgI",
    |                "pi_id": "EsImVtYWlsIksdfj23wxtQGFkbWluL",
    |                "pi_access_token": "reG0eRAiOhJMV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI2_RSTfsK8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                "created_at": "2020-12-11T03:46:08.000000Z",
    |                "updated_at": "2020-12-11T03:46:08.000000Z",
    |                "deleted_at": null,
    |                "last_ping": "2020-12-04 17:30:40",
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
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $ComplexControls = ComplexControl::with('complex')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexControls
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
    | Get Complex Control by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Control
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Control. Example : 2              |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Control recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 2,
    |                "url": "https://www.wobisoft.com",
    |                "api_uuid": "QxyTiOtE2RSc4NTs3NzgsImV4cCI6MTYwODI2MjU3OH0",
    |                "api_key": "vI2_AnRL8J5EEnhnIh7vtRNEc3tdsfgsdduU3E_JuqmjgI",
    |                "pi_id": "EsImVtYWlsIksdfj23wxtQGFkbWluL",
    |                "pi_access_token": "reG0eRAiOhJMV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI2_RSTfsK8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                "created_at": "2020-12-11T03:46:08.000000Z",
    |                "updated_at": "2020-12-11T03:46:08.000000Z",
    |                "deleted_at": null,
    |                "last_ping": "2020-12-04 17:30:40",
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
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $ComplexControl = ComplexControl::find($id);

            if (is_null($ComplexControl)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Control no encontrado.",
                    "data" => $ComplexControl
                ]);
            } else {
                $ComplexControl = $ComplexControl
                    ->with('complex')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Control recuperado satisfactoriamente.",
                "data" => $ComplexControl
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
    | Update an ComplexControl
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an ComplexControl
    |
    |   {
    |        "id" : 2,
    |        "complex_id" : 2,
    |        "url" : "https://www.wobisoft.com",
    |        "api_uuid" : "QxyTiOtR2RSc4NTs3NzgsImV4cCI6MTYwOFI2TjU3OH1",
    |        "api_key" : "vI2_AnRL8J5EEnhnIh7vtRNEc3tdsfgsdduU3E_JuqmjgI",
    |        "pi_id" : "EsIlVtYFlsKksdfj23wxtQGFkeWluL",
    |        "pi_access_token" :"yeG0eRAiOhJMV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI2_RSTfsK8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |        "last_ping": "2020-12-04 17:30:40"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Control actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Control recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 2,
    |                        "url": "https://www.wobisoft.com",
    |                        "api_uuid": "QxyTiOtR2RSc4NTs3NzgsImV4cCI6MTYwOFI2TjU3OH1",
    |                        "api_key": "vI2_AnRL8J5EEnhnIh7vtRNEc3tdsfgsdduU3E_JuqmjgI",
    |                        "pi_id": "EsIlVtYFlsKksdfj23wxtQGFkeWluL",
    |                        "pi_access_token": "yeG0eRAiOhJMV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI2_RSTfsK8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |                        "created_at": "2020-12-11T03:46:08.000000Z",
    |                        "updated_at": "2020-12-11T03:50:49.000000Z",
    |                        "deleted_at": null,
    |                        "last_ping": "2020-12-04 17:30:40",
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
            $ComplexControl = ComplexControl::findOrFail($request->id);

            $ComplexControl->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Control actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexControl->id)
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
    | Delete an ComplexControl
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific ComplexControl
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Control .Example : 2              |
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
    |        "message": "Control eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "complex_id": 2,
    |            "url": "https://www.wobisoft.com",
    |            "api_uuid": "QxyTiOtR2RSc4NTs3NzgsImV4cCI6MTYwOFI2TjU3OH1",
    |            "api_key": "vI2_AnRL8J5EEnhnIh7vtRNEc3tdsfgsdduU3E_JuqmjgI",
    |            "pi_id": "EsIlVtYFlsKksdfj23wxtQGFkeWluL",
    |            "pi_access_token": "yeG0eRAiOhJMV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiY2xtQGFkbWluLm14IiwibmFtZSI6IkNhcmxvcyIsInN1cm5hbWUiOiJNb2N0ZXp1bWEiLCJpYXQiOjE2MDc2NTc3NzgsImV4cCI6MTYwODI2MjU3OH0.vI2_RSTfsK8EEnhnIh7vtRNEc3tcnoduU3E_JuqmjgI",
    |            "created_at": "2020-12-11T03:46:08.000000Z",
    |            "updated_at": "2020-12-11T03:50:49.000000Z",
    |            "deleted_at": null,
    |            "last_ping": "2020-12-04 17:30:40"
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $ComplexControl = ComplexControl::find($id);

            if (!is_null($ComplexControl)) {
                $ComplexControl->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Control eliminado satisfactoriamente.",
                    "data" => $ComplexControl
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Control no encontrado.",
                    "data" => $ComplexControl
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
    |    for validations when you create or update an ComplexControl
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
        ];
    }
}
