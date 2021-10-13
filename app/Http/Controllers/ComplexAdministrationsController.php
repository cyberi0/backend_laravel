<?php

namespace App\Http\Controllers;

use App\Models\ComplexAdministration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexAdministrationsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Administration
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an ComplexAdministration
    |
    |   {
    |        "complex_id" : 2,
    |        "type_id" : 2
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |       "response": "success",
    |            "message": "Administración creada satisfactoriamente.",
    |            "data": {
    |                "headers": {},
    |                "original": {
    |                    "response": "success",
    |                    "message": "Administración recuperada satisfactoriamente.",
    |                    "data": [
    |                        {
    |                            "id": 1,
    |                            "complex_id": null,
    |                            "type_id": 2,
    |                            "created_at": "2020-12-09T23:48:21.000000Z",
    |                            "updated_at": "2020-12-09T23:48:21.000000Z",
    |                            "deleted_at": null,
    |                            "complex": null,
    |                            "administration_type": null
    |                        }
    |                    ]
    |                },
    |                "exception": null
    |            }
    |        }
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
            $ComplexAdministration = ComplexAdministration::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Administración creada satisfactoriamente.",
                "data" => $this->getByID($ComplexAdministration->id)
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
    |                "id": 3,
    |                "complex_id": 2,
    |                "type_id": 2,
    |                "created_at": "2020-12-09T23:52:00.000000Z",
    |                "updated_at": "2020-12-09T23:52:00.000000Z",
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
    |                "administration_type": {
    |                    "id": 2,
    |                    "name": "Admin Type Twin Peaks",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-09T22:29:29.000000Z",
    |                    "updated_at": "2020-12-09T22:35:42.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 4,
    |                "complex_id": 2,
    |                "type_id": 2,
    |                "created_at": "2020-12-09T23:52:27.000000Z",
    |                "updated_at": "2020-12-09T23:52:27.000000Z",
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
    |                "administration_type": {
    |                    "id": 2,
    |                    "name": "Admin Type Twin Peaks",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-09T22:29:29.000000Z",
    |                    "updated_at": "2020-12-09T22:35:42.000000Z",
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    */
    public function getAll() {
        try {
            $ComplexAdministrations = ComplexAdministration::with('complex')
                ->with('administration_type')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexAdministrations
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
    | Get Complex Administration by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Administration
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Administration Example : 3        |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Administración recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 3,
    |                "complex_id": 2,
    |                "type_id": 2,
    |                "created_at": "2020-12-09T23:52:00.000000Z",
    |                "updated_at": "2020-12-09T23:52:00.000000Z",
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
    |                "administration_type": {
    |                    "id": 2,
    |                    "name": "Admin Type Twin Peaks",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-09T22:29:29.000000Z",
    |                    "updated_at": "2020-12-09T22:35:42.000000Z",
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    */
    public function getByID($id) {
        try{
            $account = ComplexAdministration::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Administración no encontrada.",
                    "data" => $account
                ]);
            } else {
                $account = $account
                    ->with('complex')
                    ->with('administration_type')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Administración recuperada satisfactoriamente.",
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
    | Update an ComplexAdministration
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an ComplexAdministration
    |
    |   {
    |        "id" : 4,
    |        "complex_id" : 2,
    |        "type_id" : 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Administración actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Administración recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 4,
    |                        "complex_id": 2,
    |                        "type_id": 2,
    |                        "created_at": "2020-12-09T23:52:27.000000Z",
    |                        "updated_at": "2020-12-09T23:52:27.000000Z",
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
    |                        "administration_type": {
    |                            "id": 2,
    |                            "name": "Admin Type Twin Peaks",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-09T22:29:29.000000Z",
    |                            "updated_at": "2020-12-09T22:35:42.000000Z",
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
            $ComplexAdministration = ComplexAdministration::findOrFail($request->id);

            $ComplexAdministration->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Administración actualizada satisafactoriamente.",
                "data" => $this->getByID($ComplexAdministration->id)
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
    | Delete an ComplexAdministration
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific ComplexAdministration
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Administration. Example : 4       |
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
    |        "message": "Administración eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 4,
    |            "complex_id": 2,
    |            "type_id": 2,
    |            "created_at": "2020-12-09T23:52:27.000000Z",
    |            "updated_at": "2020-12-09T23:52:27.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($administration_id)
    {
        try {
            $ComplexAdministration = ComplexAdministration::find($administration_id);


            if (!is_null($ComplexAdministration)) {
                $ComplexAdministration->destroy($administration_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Administración eliminada satisfactoriamente.",
                    "data" => $ComplexAdministration
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Administración no encontrada.",
                    "data" => $ComplexAdministration
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
    |    for validations when you create or update an ComplexAdministration
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'type_id' => 'required|exists:complex_administration_types,id',
        ];
    }

    public function getMessages() {
        return [
            'type_id.required' => 'Debe elegir un Tipo',
            'type_id.exists' => 'No existe el Tipo',
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
        ];
    }
}
