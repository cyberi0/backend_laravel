<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\ComplexAdministrationRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexAdministrationRolesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Administration Roles
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Complex Administration Roles
    |
    |    {
    |        "role" : "Administrator",
    |        "description" : "Lorem Ipsum Dolor",
    |        "administration_id" : 3,
    |        "user_id" : 1
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Administración para el Complejo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Administración para el Complejo recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "administration_id": 3,
    |                        "user_id": 1,
    |                        "role": "Administrator",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-10T00:02:59.000000Z",
    |                        "updated_at": "2020-12-10T00:02:59.000000Z",
    |                        "deleted_at": null,
    |                        "user": {
    |                            "id": 1,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Carlos",
    |                            "surnames": "Laravel",
    |                            "username": "develop2",
    |                            "email": "develop2@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "administration": {
    |                            "id": 3,
    |                            "complex_id": 2,
    |                            "type_id": 2,
    |                            "created_at": "2020-12-09T23:52:00.000000Z",
    |                            "updated_at": "2020-12-09T23:52:00.000000Z",
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
            $ComplexAdministrationRol = ComplexAdministrationRoles::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Rol de Administración para el Complejo creado satisfactoriamente.",
                "data" => $this->getByID($ComplexAdministrationRol->id)
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
    | Get All Complex Administration Roles
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Complex Administration Roles
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
    |                "administration_id": 3,
    |                "user_id": 1,
    |                "role": "Administrator",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-10T00:02:59.000000Z",
    |                "updated_at": "2020-12-10T00:02:59.000000Z",
    |                "deleted_at": null,
    |                "user": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "administration": {
    |                    "id": 3,
    |                    "complex_id": 2,
    |                    "type_id": 2,
    |                    "created_at": "2020-12-09T23:52:00.000000Z",
    |                    "updated_at": "2020-12-09T23:52:00.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "administration_id": 3,
    |                "user_id": 2,
    |                "role": "Chief Master",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-10T00:26:42.000000Z",
    |                "updated_at": "2020-12-10T00:26:42.000000Z",
    |                "deleted_at": null,
    |                "user": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "administration": {
    |                    "id": 3,
    |                    "complex_id": 2,
    |                    "type_id": 2,
    |                    "created_at": "2020-12-09T23:52:00.000000Z",
    |                    "updated_at": "2020-12-09T23:52:00.000000Z",
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
            $ComplexAdministrationRoles = ComplexAdministrationRoles::with('user')
                ->with('administration')
                ->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexAdministrationRoles
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
    | Get Complex Administration Rol by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Administration Rol
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Administration Type Example : 2   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Rol de Administración para el Complejo recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "administration_id": 3,
    |                "user_id": 1,
    |                "role": "Administrator",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-10T00:02:59.000000Z",
    |                "updated_at": "2020-12-10T00:02:59.000000Z",
    |                "deleted_at": null,
    |                "user": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "administration": {
    |                    "id": 3,
    |                    "complex_id": 2,
    |                    "type_id": 2,
    |                    "created_at": "2020-12-09T23:52:00.000000Z",
    |                    "updated_at": "2020-12-09T23:52:00.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "administration_id": 3,
    |                "user_id": 2,
    |                "role": "Chief Master",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-10T00:26:42.000000Z",
    |                "updated_at": "2020-12-10T00:26:42.000000Z",
    |                "deleted_at": null,
    |                "user": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "administration": {
    |                    "id": 3,
    |                    "complex_id": 2,
    |                    "type_id": 2,
    |                    "created_at": "2020-12-09T23:52:00.000000Z",
    |                    "updated_at": "2020-12-09T23:52:00.000000Z",
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
            $ComplexAdministrationRol = ComplexAdministrationRoles::find($id);

            if (is_null($ComplexAdministrationRol)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Rol de Administración para el Complejo no encontrado.",
                    "data" => $ComplexAdministrationRol
                ]);
            }else {
                $ComplexAdministrationRol = $ComplexAdministrationRol
                    ->with('user')
                    ->with('administration')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Rol de Administración para el Complejo recuperada satisfactoriamente.",
                "data" => $ComplexAdministrationRol
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
    | Update an Complex Administration Rol
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex Administration Roles
    |
    |   {
    |        "id" : 1,
    |        "role" : "Chief Administrator",
    |        "description" : "Lorem Ipsum Dolor",
    |        "administration_id" : 3,
    |        "user_id" : 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Rol de Administración para el Complejo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Rol de Administración para el Complejo recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "administration_id": 3,
    |                        "user_id": 2,
    |                        "role": "Chief Administrator",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-10T00:02:59.000000Z",
    |                        "updated_at": "2020-12-10T00:30:27.000000Z",
    |                        "deleted_at": null,
    |                        "user": {
    |                            "id": 2,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Jorge",
    |                            "surnames": "Laravel",
    |                            "username": "develop1",
    |                            "email": "develop1@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "administration": {
    |                            "id": 3,
    |                            "complex_id": 2,
    |                            "type_id": 2,
    |                            "created_at": "2020-12-09T23:52:00.000000Z",
    |                            "updated_at": "2020-12-09T23:52:00.000000Z",
    |                            "deleted_at": null
    |                        }
    |                    },
    |                    {
    |                        "id": 2,
    |                        "administration_id": 3,
    |                        "user_id": 2,
    |                        "role": "Chief Master",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-10T00:26:42.000000Z",
    |                        "updated_at": "2020-12-10T00:26:42.000000Z",
    |                        "deleted_at": null,
    |                        "user": {
    |                            "id": 2,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Jorge",
    |                            "surnames": "Laravel",
    |                            "username": "develop1",
    |                            "email": "develop1@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "administration": {
    |                            "id": 3,
    |                            "complex_id": 2,
    |                            "type_id": 2,
    |                            "created_at": "2020-12-09T23:52:00.000000Z",
    |                            "updated_at": "2020-12-09T23:52:00.000000Z",
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
            $ComplexAdministrationRol = ComplexAdministrationRoles::findOrFail($request->id);

            $ComplexAdministrationRol->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Rol de Administración para el Complejo actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexAdministrationRol->id)
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
    | Delete a Complex Administration Rol
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Administration Rol
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | Administration Rol  Example : 1   |
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
    |        "message": "Rol de Administración para el Complejo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "administration_id": 3,
    |            "user_id": 2,
    |            "role": "Role 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-10T00:32:03.000000Z",
    |            "updated_at": "2020-12-10T00:32:03.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($type_id)
    {
        try {
            $ComplexAdministrationRol = ComplexAdministrationRoles::find($type_id);


            if (!is_null($ComplexAdministrationRol)) {
                $ComplexAdministrationRol->destroy($type_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Rol de Administración para el Complejo eliminado satisfactoriamente.",
                    "data" => $ComplexAdministrationRol
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Rol de Administración para el Complejo no encontrado.",
                    "data" => $ComplexAdministrationRol
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
    | Create or Update Complex Administration Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an ComplexAdministrationRoles
    |
    */
    public function getRules() {
        return [
            'role' => 'required',
            'description' => 'required',
            'administration_id'=> 'required|exists:complex_administrations,id',
            'user_id'=> 'required|exists:users,id'
        ];
    }

    public function getMessages() {
        return [
            'role.required' => 'Debe escribir un Rol',
            'administration_id.required' => 'Debe elegir una Administración.',
            'administration_id.exists' => 'No existe la Administración.',
            'user_id.required' => 'Debe elegir un Usuario.',
            'user_id.exists' => 'No existe el Usuario.'
        ];
    }
}
