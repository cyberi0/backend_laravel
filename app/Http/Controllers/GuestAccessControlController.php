<?php

namespace App\Http\Controllers;

use App\Models\GuestAccessControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestAccessControlController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Guest Access
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Guest Access
    |
    |    {
    |        "property_guest_id" : 1,
    |        "conceded_type_id" : 1,
    |        "conceded_by" : 1,
    |        "access_at" : "2020-12-21 05:39:03",
    |        "created_by" : 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acceso del Invitado creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Acceso del Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "property_guest_id": 1,
    |                        "conceded_type_id": 1,
    |                        "conceded_by": null,
    |                        "access_at": "2020-12-21 05:39:03",
    |                        "created_by": 2,
    |                        "created_at": "2020-12-21T06:21:00.000000Z",
    |                        "updated_at": "2020-12-21T06:21:00.000000Z",
    |                        "deleted_at": null,
    |                        "property_guest": {
    |                            "id": 1,
    |                            "created_by": 2,
    |                            "guest_id": 1,
    |                            "property_id": 1,
    |                            "created_at": "2020-12-20T23:15:53.000000Z",
    |                            "updated_at": "2020-12-20T23:15:53.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "conceded_type": {
    |                            "id": 1,
    |                            "name": "Operador",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-21T03:07:33.000000Z",
    |                            "updated_at": "2020-12-21T03:07:33.000000Z",
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
            $GuestAccessControl = GuestAccessControl::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Acceso del Invitado creado satisfactoriamente.",
                "data" => $this->getByID($GuestAccessControl->id)
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
    | Get All Guests Accesses
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Guests Access
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
    |                "property_guest_id": 1,
    |                "conceded_type_id": 1,
    |                "conceded_by": {
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
    |                "access_at": "2020-12-21 05:39:03",
    |                "created_by": 1,
    |                "created_at": "2020-12-21T06:20:16.000000Z",
    |                "updated_at": "2020-12-21T06:20:16.000000Z",
    |                "deleted_at": null,
    |                "property_guest": {
    |                    "id": 1,
    |                    "created_by": 2,
    |                    "guest_id": 1,
    |                    "property_id": 1,
    |                    "created_at": "2020-12-20T23:15:53.000000Z",
    |                    "updated_at": "2020-12-20T23:15:53.000000Z",
    |                    "deleted_at": null
    |                },
    |                "conceded_type": {
    |                    "id": 1,
    |                    "name": "Operador",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:07:33.000000Z",
    |                    "updated_at": "2020-12-21T03:07:33.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "property_guest_id": 1,
    |                "conceded_type_id": 1,
    |                "conceded_by": {
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
    |                "access_at": "2020-12-21 05:39:03",
    |                "created_by": 2,
    |                "created_at": "2020-12-21T06:21:00.000000Z",
    |                "updated_at": "2020-12-21T06:21:00.000000Z",
    |                "deleted_at": null,
    |                "property_guest": {
    |                    "id": 1,
    |                    "created_by": 2,
    |                    "guest_id": 1,
    |                    "property_id": 1,
    |                    "created_at": "2020-12-20T23:15:53.000000Z",
    |                    "updated_at": "2020-12-20T23:15:53.000000Z",
    |                    "deleted_at": null
    |                },
    |                "conceded_type": {
    |                    "id": 1,
    |                    "name": "Operador",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:07:33.000000Z",
    |                    "updated_at": "2020-12-21T03:07:33.000000Z",
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
            $GuestAccessControls = GuestAccessControl::with('property_guest')
                ->with('conceded_type')
                ->with('conceded_by')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $GuestAccessControls
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
    | Get Guest Access by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Guest Access
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                              |
    |  |----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Guest Access |
    |  |            |        |          | Example : 2                         |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acceso del Invitado recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "property_guest_id": 1,
    |                "conceded_type_id": 1,
    |                "conceded_by": {
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
    |                "access_at": "2020-12-21 05:39:03",
    |                "created_by": 2,
    |                "created_at": "2020-12-21T06:21:00.000000Z",
    |                "updated_at": "2020-12-21T06:21:00.000000Z",
    |                "deleted_at": null,
    |                "property_guest": {
    |                    "id": 1,
    |                    "created_by": 2,
    |                    "guest_id": 1,
    |                    "property_id": 1,
    |                    "created_at": "2020-12-20T23:15:53.000000Z",
    |                    "updated_at": "2020-12-20T23:15:53.000000Z",
    |                    "deleted_at": null
    |                },
    |                "conceded_type": {
    |                    "id": 1,
    |                    "name": "Operador",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-21T03:07:33.000000Z",
    |                    "updated_at": "2020-12-21T03:07:33.000000Z",
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
            $GuestAccessControl = GuestAccessControl::find($id);

            if (is_null($GuestAccessControl)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Acceso del Invitado no encontrado.",
                    "data" => $GuestAccessControl
                ]);
            } else {
                $GuestAccessControl = $GuestAccessControl
                    ->with('property_guest')
                    ->with('conceded_type')
                    ->with('conceded_by')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Acceso del Invitado recuperado satisfactoriamente.",
                "data" => $GuestAccessControl
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
    | Update a Guest Access
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Guest Access
    |
    |    {
    |        "id": 2,
    |        "property_guest_id" : 1,
    |        "conceded_type_id" : 2,
    |        "conceded_by" : 1,
    |        "access_at" : "2020-12-21 05:39:03",
    |        "created_by" : 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acceso del Invitado actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Acceso del Invitado recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "property_guest_id": 1,
    |                        "conceded_type_id": 2,
    |                        "conceded_by": {
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
    |                        "access_at": "2020-12-21 05:39:03",
    |                        "created_by": 2,
    |                        "created_at": "2020-12-21T06:21:00.000000Z",
    |                        "updated_at": "2020-12-21T06:29:05.000000Z",
    |                        "deleted_at": null,
    |                        "property_guest": {
    |                            "id": 1,
    |                            "created_by": 2,
    |                            "guest_id": 1,
    |                            "property_id": 1,
    |                            "created_at": "2020-12-20T23:15:53.000000Z",
    |                            "updated_at": "2020-12-20T23:15:53.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "conceded_type": {
    |                            "id": 2,
    |                            "name": "Barra Vehicular Automática",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "created_at": "2020-12-21T03:09:03.000000Z",
    |                            "updated_at": "2020-12-21T03:11:08.000000Z",
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
            $GuestAccessControl = GuestAccessControl::findOrFail($request->id);

            $GuestAccessControl->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Acceso del Invitado actualizado satisafactoriamente.",
                "data" => $this->getByID($GuestAccessControl->id)
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
    | Delete a Guest Access
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Guest Access
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Guest Access |
    |  |            |        |          | Example : 3                         |
    |  |            |        |          |                                     |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acceso del Invitado eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "property_guest_id": 1,
    |            "conceded_type_id": 2,
    |            "conceded_by": 1,
    |            "access_at": "2020-12-21 05:39:03",
    |            "created_by": 2,
    |            "created_at": "2020-12-21T06:21:00.000000Z",
    |            "updated_at": "2020-12-21T06:29:05.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $GuestAccessControl = GuestAccessControl::find($id);


            if (!is_null($GuestAccessControl)) {
                $GuestAccessControl->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Acceso del Invitado eliminado satisfactoriamente.",
                    "data" => $GuestAccessControl
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Acceso del Invitado no encontrado.",
                    "data" => $GuestAccessControl
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
    | Create or Update Guests Accesses Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Guests Accesses
    |
    */
    public function getRules() {
        return [
            "property_guest_id" => "required|exists:property_guests,id",
            "conceded_type_id" => "required|exists:guest_access_control_conceded_types,id",
            "conceded_by" => "required|exists:users,id",
            "access_at" => "required"
        ];
    }

    public function getMessages() {
        return [
            'property_guest_id.required' => 'Debe seleccionar la Propiedad en la que se registró al Acceso del Invitado.',
            'property_guest_id.exists' => 'El registro del Acceso del Invitado a la Propiedad no existe.',
            'conceded_type_id.required' => 'Debe seleccionar el Tipo del Accesso Concedido.',
            'conceded_type_id.exists' => 'No el Acceso Concedido no existe.',
            'access_at.required' => 'Debe seleccionar una fecha de Acceso.',
        ];
    }
}
