<?php

namespace App\Http\Controllers;

use App\Models\LostObjectsControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LostObjectsControlController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Lost Objects
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Lost Object
    |
    |    {
    |        "property_id" : 1,
    |        "reported_by_user" :1 ,
    |        "reported_at" : "2020-12-20 08:00:35",
    |        "comments" : "Lorem Ipsum Dolor",
    |        "lost_at" : "2020-12-20 08:00:35",
    |        "created_by" : 1,
    |        "finded_at" : "2020-12-20 08:00:35"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Reporte Objeto Perdido creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Reporte Objeto Perdido recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "property_id": 1,
    |                        "common_area_id": null,
    |                        "reported_by_user": {
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
    |                        "reported_by_guest": null,
    |                        "reported_at": "2020-12-20 08:00:35",
    |                        "finded_by_user": null,
    |                        "finded_by_guest": null,
    |                        "finded_at": "2020-12-20 08:00:35",
    |                        "comments": "Lorem Ipsum Dolor",
    |                        "lost_at": "2020-12-20 08:00:35",
    |                        "created_by": null,
    |                        "created_at": "2020-12-21T05:39:03.000000Z",
    |                        "updated_at": "2020-12-21T05:39:03.000000Z",
    |                        "deleted_at": null
    |                    }
    |                ]
    |            },
    |            "exception": null
    |        }
    |    }
    |
    |
    */
    public function create(Request $request)
    {
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
            $LostObjectsControl = LostObjectsControl::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Reporte Objeto Perdido creado satisfactoriamente.",
                "data" => $this->getByID($LostObjectsControl->id)
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
    | Get All Lost Objects
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Lost Objects
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
    |                "property_id": 1,
    |                "common_area_id": null,
    |                "reported_by_user": {
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
    |                "reported_by_guest": null,
    |                "reported_at": "2020-12-20 08:00:35",
    |                "finded_by_user": null,
    |                "finded_by_guest": null,
    |                "finded_at": "2020-12-20 08:00:35",
    |                "comments": "Lorem Ipsum Dolor",
    |                "lost_at": "2020-12-20 08:00:35",
    |                "created_by": null,
    |                "created_at": "2020-12-21T05:17:01.000000Z",
    |                "updated_at": "2020-12-21T05:17:01.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "property_id": 1,
    |                "common_area_id": null,
    |                "reported_by_user": {
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
    |                "reported_by_guest": null,
    |                "reported_at": "2020-12-20 08:00:35",
    |                "finded_by_user": null,
    |                "finded_by_guest": null,
    |                "finded_at": "2020-12-20 08:00:35",
    |                "comments": "Lorem Ipsum Dolor",
    |                "lost_at": "2020-12-20 08:00:35",
    |                "created_by": null,
    |                "created_at": "2020-12-21T05:34:45.000000Z",
    |                "updated_at": "2020-12-21T05:34:45.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "property_id": 1,
    |                "common_area_id": null,
    |                "reported_by_user": {
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
    |                "reported_by_guest": null,
    |                "reported_at": "2020-12-20 08:00:35",
    |                "finded_by_user": null,
    |                "finded_by_guest": null,
    |                "finded_at": "2020-12-20 08:00:35",
    |                "comments": "Lorem Ipsum Dolor",
    |                "lost_at": "2020-12-20 08:00:35",
    |                "created_by": null,
    |                "created_at": "2020-12-21T05:39:03.000000Z",
    |                "updated_at": "2020-12-21T05:39:03.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll()
    {
        try {
            $LostObjectsControls = LostObjectsControl::with('reported_by_user')
                ->with('reported_by_guest')
                ->with('finded_by_user')
                ->with('finded_by_guest')
                ->with('created_by')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $LostObjectsControls
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
    | Get Lost Objects by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Lost Objects
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                              |
    |  |----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Lost Objects |
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
    |        "message": "Reporte Objeto Perdido recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "property_id": 1,
    |                "common_area_id": null,
    |                "reported_by_user": {
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
    |                "reported_by_guest": null,
    |                "reported_at": "2020-12-20 08:00:35",
    |                "finded_by_user": null,
    |                "finded_by_guest": null,
    |                "finded_at": "2020-12-20 08:00:35",
    |                "comments": "Lorem Ipsum Dolor",
    |                "lost_at": "2020-12-20 08:00:35",
    |                "created_by": null,
    |                "created_at": "2020-12-21T05:34:45.000000Z",
    |                "updated_at": "2020-12-21T05:34:45.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id)
    {
        try {
            $LostObjectsControl = LostObjectsControl::find($id);

            if (is_null($LostObjectsControl)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Reporte Objeto Perdido no encontrado.",
                    "data" => $LostObjectsControl
                ]);
            } else {
                $LostObjectsControl = $LostObjectsControl
                    ->with('reported_by_user')
                    ->with('reported_by_guest')
                    ->with('finded_by_user')
                    ->with('finded_by_guest')
                    ->with('created_by')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Reporte Objeto Perdido recuperado satisfactoriamente.",
                "data" => $LostObjectsControl
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
    | Update a Lost Objects
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Lost Objects
    |
    |    {
    |        "id" : 1,
    |        "property_id" : 1,
    |        "reported_by_user" :1 ,
    |        "reported_at" : "2020-12-20 08:00:35",
    |        "comments" : "Lorem Ipsum Dolor",
    |        "lost_at" : "2020-12-20 08:00:35",
    |        "created_by" : 1,
    |        "finded_by_user" : 2,
    |        "finded_at" : "2020-12-20 08:00:35"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Reporte Objeto Perdido actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Reporte Objeto Perdido recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "property_id": 1,
    |                        "common_area_id": null,
    |                        "reported_by_user": {
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
    |                        "reported_by_guest": null,
    |                        "reported_at": "2020-12-20 08:00:35",
    |                        "finded_by_user": {
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
    |                        "finded_by_guest": null,
    |                        "finded_at": "2020-12-20 08:00:35",
    |                        "comments": "Lorem Ipsum Dolor",
    |                        "lost_at": "2020-12-20 08:00:35",
    |                        "created_by": null,
    |                        "created_at": "2020-12-21T05:17:01.000000Z",
    |                        "updated_at": "2020-12-21T05:48:10.000000Z",
    |                        "deleted_at": null
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
            $LostObjectsControl = LostObjectsControl::findOrFail($request->id);

            $LostObjectsControl->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Reporte Objeto Perdido actualizada satisafactoriamente.",
                "data" => $this->getByID($LostObjectsControl->id)
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
    | Delete Lost Objects
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Lost Objects
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Lost Objects |
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
    |        "message": "Reporte Objeto Perdido eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "property_id": 1,
    |            "common_area_id": null,
    |            "reported_by_user": 1,
    |            "reported_by_guest": null,
    |            "reported_at": "2020-12-20 08:00:35",
    |            "finded_by_user": null,
    |            "finded_by_guest": null,
    |            "finded_at": "2020-12-20 08:00:35",
    |            "comments": "Lorem Ipsum Dolor",
    |            "lost_at": "2020-12-20 08:00:35",
    |            "created_by": 1,
    |            "created_at": "2020-12-21T05:39:03.000000Z",
    |            "updated_at": "2020-12-21T05:39:03.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $LostObjectsControl = LostObjectsControl::find($id);


            if (!is_null($LostObjectsControl)) {
                $LostObjectsControl->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Reporte Objeto Perdido eliminado satisfactoriamente.",
                    "data" => $LostObjectsControl
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Reporte Objeto Perdido no encontrado.",
                    "data" => $LostObjectsControl
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
    public function getRules()
    {
        return [
            "property_id" => "sometimes|required|exists:properties,id",
            "common_area_id" => "sometimes|required|exists:common_areas,id",
            "reported_by_user" => "sometimes|required|exists:users,id",
            "reported_by_guest" => "sometimes|required|exists:guests,id",
            "reported_at" => "required",
            "finded_by_user" => "sometimes|required|exists:users,id",
            "finded_by_guest" => "sometimes|required|exists:guests,id",
            "finded_at"  => "sometimes|required",
            "comments"  => "sometimes|required",
            "lost_at"  => "required",
            "created_by" => "required|exists:users,id",
        ];
    }

    public function getMessages()
    {
        return [
            'property_id.required' => 'Debe seleccionar una Propiedad.',
            'property_id.exists' => 'Debe seleccionar una Propiedad.',

            'common_area_id.required' => 'Debe seleccionar una Área Común.',
            'common_area_id.exists' => 'Debe seleccionar una Área Común.',

            'reported_by_user.required' => 'Debe seleccionar el Usuario que Reportó el Reporte Objeto Perdido Perdido.',
            'reported_by_user.exists' => 'El Usuario no existe.',
            'reported_by_guest.required' => 'Debe seleccionar el Reporte Objeto Perdido que Reportó el Reporte Objeto Perdido Perdido.',
            'reported_by_guest.exists' => 'El Reporte Objeto Perdido no existe.',
            'reported_at.required' =>"Debe seleccionar una Fecha de Reporte.",

            'finded_by_user.required' => 'Debe seleccionar el Usuario que Encontró el Reporte Objeto Perdido Perdido.',
            'finded_by_user.exists' => 'El Usuario no existe.',
            'finded_by_guest.required' => 'Debe seleccionar el Reporte Objeto Perdido que Econtró el Reporte Objeto Perdido Perdido.',
            'finded_by_guest.exists' => 'El Reporte Objeto Perdido no existe.',
            'finded_at.required' =>"Debe seleccionar una Fecha en la que se Econtró el Reporte Objeto Perdido.",
            'comments' => "Debe escribir un Comentario.",
            'created_by.required' => 'Debe seleccionar un Creador.',
            'created_by.exists' => 'El Creador no existe.',
        ];
    }
}
