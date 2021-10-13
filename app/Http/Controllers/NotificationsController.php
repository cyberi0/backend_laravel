<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationsController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Create Notification
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Notification
    |
    |    {
    |        "occupant_id" : 1,
    |        "type" : 1,
    |        "name" : "Meet Daily",
    |        "description" : "Lorem Ipsum Dolor",
    |        "periodicity" : 1,
    |        "day" : 1,
    |        "time" : "10:30:00"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Complejo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos de la Notificación recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "occupant_id": 1,
    |                        "type": "1",
    |                        "name": "Meet Daily",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "periodicity": "1",
    |                        "day": 1,
    |                        "time": "10:30:00",
    |                        "created_at": "2020-11-30T19:28:20.000000Z",
    |                        "updated_at": "2020-11-30T19:28:20.000000Z",
    |                        "deleted_at": null,
    |                        "occupant": {
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

        if($validatedData->fails()) {
            return response()->json([
                "response" => "error",
                "message" => $validatedData->errors()->first(),
                "code" => 400
            ]);
        }

        try {
            $notification = Notification::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Complejo creado satisfactoriamente.",
                "data" => $this->getByID($notification->id)
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
    | Get All Notifications
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Notifications
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Lista de Notificaciones recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "occupant_id": 1,
    |                "type": "1",
    |                "name": "Meet Daily",
    |                "description": "Lorem Ipsum Dolor",
    |                "periodicity": "1",
    |                "day": 1,
    |                "time": "10:45:00",
    |                "created_at": "2020-11-30T21:44:23.000000Z",
    |                "updated_at": "2020-11-30T21:44:23.000000Z",
    |                "deleted_at": null,
    |                "occupant": {
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
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "occupant_id": 1,
    |                "type": "1",
    |                "name": "Meet Deliveries",
    |                "description": "Lorem Ipsum Dolor",
    |                "periodicity": "1",
    |                "day": 1,
    |                "time": "10:45:00",
    |                "created_at": "2020-11-30T21:44:48.000000Z",
    |                "updated_at": "2020-11-30T21:44:48.000000Z",
    |                "deleted_at": null,
    |                "occupant": {
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
    |                }
    |            }
    |        ]
    |    }
    */
    public function getAll() {
        try {
            $notifications = Notification::with('occupant')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista de Notificaciones recuperada satisfactoriamente.",
                "data" => $notifications
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
    | Get Notification by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Notification
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the            |
    |  |            |        |          | Notification. Example : 1         |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Datos de la Notificación recuperados satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "occupant_id": 1,
    |                "type": "1",
    |                "name": "Meet Daily",
    |                "description": "Lorem Ipsum Dolor",
    |                "periodicity": "1",
    |                "day": 1,
    |                "time": "10:30:00",
    |                "created_at": "2020-11-30T19:28:20.000000Z",
    |                "updated_at": "2020-11-30T19:28:20.000000Z",
    |                "deleted_at": null,
    |                "occupant": {
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
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try {
            $notification = Notification::find($id);

            if (is_null($notification)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Notificación no encontrada.",
                    "data" => $notification
                ]);
            } else {
                $notification = $notification->with('occupant')->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Datos de la Notificación recuperados satisfactoriamente.",
                "data" => $notification
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
    | Update Notifications
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Notification
    |
    |    {
    |        "id" : 2,
    |        "occupant_id" : 1,
    |        "type" : 1,
    |        "name" : "Meet Daily Time",
    |        "description" : "Lorem Ipsum Dolor",
    |        "periodicity" : 1,
    |        "day" : 1,
    |        "time" : "10:50:00"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Notificación actualizada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos de la Notificación recuperados satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "occupant_id": 1,
    |                        "type": "1",
    |                        "name": "Meet Daily Time",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "periodicity": "1",
    |                        "day": 1,
    |                        "time": "10:50:00",
    |                        "created_at": "2020-11-30T19:28:20.000000Z",
    |                        "updated_at": "2020-11-30T19:36:33.000000Z",
    |                        "deleted_at": null,
    |                        "occupant": {
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
            $Notification= Notification::findOrFail($request->id);
            $Notification->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Notificación actualizada satisfactoriamente.",
                "data" => $this->getByID($request->id)
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
    | Delete a Notification
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Notification
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the            |
    |  |            |        |          | Notification. Example : 3         |
    |  |____________|________|__________|___________________________________|
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Notificación eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "occupant_id": 1,
    |            "type": "1",
    |            "name": "Meet Daily 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "periodicity": "1",
    |            "day": 1,
    |            "time": "10:45:00",
    |            "created_at": "2020-11-30T19:38:52.000000Z",
    |            "updated_at": "2020-11-30T19:38:52.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($notification_id)
    {
        try {
            $Notification= Notification::find($notification_id);
            if(!is_null($Notification)){
                $Notification->destroy($notification_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Notificación eliminada satisfactoriamente.",
                    "data" => $Notification
                ]);
            }else {
                return response()->json([
                    "response" => "error",
                    "message" => "Notificación no encontrada.",
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
    | Create or Update Notification Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Notification
    |
    */
    public function getRules() {
        return [
            'occupant_id' => 'required|exists:users,id',
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'periodicity' => 'required',
            'day' => 'required',
            'time' => 'required',
        ];
    }
    public function getMessages() {
        return [
            'occupant_id.required' => 'Debe elegir el Ocupante para la Notificación.',
            'occupant_id.exists' => 'El Ocupante para la Notificación no existe.',
            'type.required' => 'Debe elegir un tipo para la Notificación.',
            'name.required' => 'Debe escribir un nombre para la Notificación.',
            'description.required' => 'Debe escribir una Descripción para la Notificación.',
            'periodicity.required' => 'Debe elegir la periodicidad.',
            'day.required' => 'Debe escribir un día para la Notificación..',
            'time.required' => 'Debe escribir un timpo para la Notificación.'
        ];
    }
}
