<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportTicketsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Support Tickets
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Support Tickets
    |
    |   {
    |       "user_id" : 2,
    |       "comment" : "Lorem Ipsum Dolor"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
            "response": "success",
            "message": "Ticket de Soporte creado satisfactoriamente.",
            "data": {
                "headers": {},
                "original": {
                    "response": "success",
                    "message": "Ticket de Soporte recuperado satisfactoriamente.",
                    "data": [
                        {
                            "id": 1,
                            "user_id": 2,
                            "comment": "Lorem Ipsum Dolor",
                            "created_at": "2020-12-12T18:57:04.000000Z",
                            "updated_at": "2020-12-12T18:57:04.000000Z",
                            "deleted_at": null,
                            "attended_at": null,
                            "closed_at": null,
                            "resolved_at": null,
                            "user": {
                                "id": 2,
                                "user_id": null,
                                "type_id": null,
                                "created_by": null,
                                "names": "Jorge",
                                "surnames": "Laravel",
                                "username": "develop1",
                                "email": "develop1@wobisoft.com",
                                "mobile": "9797968543",
                                "curp": null,
                                "email_verified_at": "2020-11-24T23:09:39.000000Z",
                                "created_at": "2020-11-24T23:09:39.000000Z",
                                "updated_at": "2020-11-24T23:09:39.000000Z",
                                "deleted_at": null
                            }
                        }
                    ]
                },
                "exception": null
            }
        }
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
            $SupportTicket = SupportTicket::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Ticket de Soporte creado satisfactoriamente.",
                "data" => $this->getByID($SupportTicket->id)
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
    | Get All Support Ticket
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Accounts
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    {
    "response": "success",
    "message": "Lista recuperada satisfactoriamente.",
    "data": [
        {
            "id": 1,
            "user_id": 2,
            "comment": "Lorem Ipsum Dolor",
            "created_at": "2020-12-12T18:57:04.000000Z",
            "updated_at": "2020-12-12T18:57:04.000000Z",
            "deleted_at": null,
            "attended_at": null,
            "closed_at": null,
            "resolved_at": null,
            "user": {
                "id": 2,
                "user_id": null,
                "type_id": null,
                "created_by": null,
                "names": "Jorge",
                "surnames": "Laravel",
                "username": "develop1",
                "email": "develop1@wobisoft.com",
                "mobile": "9797968543",
                "curp": null,
                "email_verified_at": "2020-11-24T23:09:39.000000Z",
                "created_at": "2020-11-24T23:09:39.000000Z",
                "updated_at": "2020-11-24T23:09:39.000000Z",
                "deleted_at": null
            }
        },
        {
            "id": 2,
            "user_id": 1,
            "comment": "Lorem Ipsum Dolor",
            "created_at": "2020-12-12T18:58:21.000000Z",
            "updated_at": "2020-12-12T18:58:21.000000Z",
            "deleted_at": null,
            "attended_at": null,
            "closed_at": null,
            "resolved_at": null,
            "user": {
                "id": 1,
                "user_id": null,
                "type_id": null,
                "created_by": null,
                "names": "Carlos",
                "surnames": "Laravel",
                "username": "develop2",
                "email": "develop2@wobisoft.com",
                "mobile": "9797968543",
                "curp": null,
                "email_verified_at": "2020-11-24T23:09:39.000000Z",
                "created_at": "2020-11-24T23:09:39.000000Z",
                "updated_at": "2020-11-24T23:09:39.000000Z",
                "deleted_at": null
            }
        }
    ]
}
    */
    public function getAll() {
        try {
            $SupportTickets = SupportTicket::with('user')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $SupportTickets
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
    | Get Support Ticket by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Support Ticket
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Support    |
    |  |            |        |          | Ticket Example : 2                |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |{
    "response": "success",
    "message": "Ticket de Soporte recuperado satisfactoriamente.",
    "data": [
        {
            "id": 2,
            "user_id": 1,
            "comment": "Lorem Ipsum Dolor",
            "created_at": "2020-12-12T18:58:21.000000Z",
            "updated_at": "2020-12-12T18:58:21.000000Z",
            "deleted_at": null,
            "attended_at": null,
            "closed_at": null,
            "resolved_at": null,
            "user": {
                "id": 1,
                "user_id": null,
                "type_id": null,
                "created_by": null,
                "names": "Carlos",
                "surnames": "Laravel",
                "username": "develop2",
                "email": "develop2@wobisoft.com",
                "mobile": "9797968543",
                "curp": null,
                "email_verified_at": "2020-11-24T23:09:39.000000Z",
                "created_at": "2020-11-24T23:09:39.000000Z",
                "updated_at": "2020-11-24T23:09:39.000000Z",
                "deleted_at": null
            }
        }
    ]
}
    */
    public function getByID($id) {
        try{
            $SupportTicket = SupportTicket::find($id);

            if (is_null($SupportTicket)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Ticket de Soporte no encontrado.",
                    "data" => $SupportTicket
                ]);
            } else {
                $SupportTicket = $SupportTicket
                    ->with('user')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Ticket de Soporte recuperado satisfactoriamente.",
                "data" => $SupportTicket
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
    | Update Support Ticket
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Support Ticket
    |
    |   {
    |        "id" : 2,
    |        "user_id" : 2,
    |        "comment" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Ticket de Soporte actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Ticket de Soporte recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "user_id": 2,
    |                        "comment": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-12T18:58:21.000000Z",
    |                        "updated_at": "2020-12-12T18:59:57.000000Z",
    |                        "deleted_at": null,
    |                        "attended_at": null,
    |                        "closed_at": null,
    |                        "resolved_at": null,
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
            $SupportTicket = SupportTicket::findOrFail($request->id);

            $SupportTicket->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Ticket de Soporte actualizado satisafactoriamente.",
                "data" => $this->getByID($SupportTicket->id)
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
    | Delete Support Ticket
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Support Ticket
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Support    |
    |  |            |        |          | Ticket Example : 3                |
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
    |        "message": "Ticket de Soporte eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "user_id": 1,
    |            "comment": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T19:00:53.000000Z",
    |            "updated_at": "2020-12-12T19:00:53.000000Z",
    |            "deleted_at": null,
    |            "attended_at": null,
    |            "closed_at": null,
    |            "resolved_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $SupportTicket = SupportTicket::find($id);


            if (!is_null($SupportTicket)) {
                $SupportTicket->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Ticket de Soporte eliminado satisfactoriamente.",
                    "data" => $SupportTicket
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Ticket de Soporte no encontrado.",
                    "data" => $SupportTicket
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
    | Create or Update Support Tickets Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Support Tickets
    |
    */
    public function getRules() {
        return [
            'user_id' => 'required|exists:users,id',
            'comment' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'user_id.required' => 'Debe elegir un Usuario',
            'user_id.exists' => 'No existe el Usuario.',
            'comment' => 'Debe escribir un Comentario',
        ];
    }
}
