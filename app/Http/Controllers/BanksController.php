<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BanksController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Bank
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Bank
    |   {
    |        "name" : "Nick Cave",
    |        "company" : "Grinderman"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Banco creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Banco recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Nick Cave",
    |                    "company": "Grinderman",
    |                    "created_at": "2020-12-09T21:26:35.000000Z",
    |                    "updated_at": "2020-12-09T21:26:35.000000Z",
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
            $Bank = Bank::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Banco creado satisfactoriamente.",
                "data" => $this->getByID($Bank->id)
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
    | Get All Banks
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Banks
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Lista recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "name": "Grinderman",
    |                "company": "Bad Seds",
    |                "created_at": null,
    |                "updated_at": "2020-12-04T11:41:11.000000Z",
    |                "deleted_at": "2020-12-04 11:41:11"
    |            },
    |            {
    |                "id": 2,
    |                "name": "Nick Cave",
    |                "company": "Grinderman",
    |                "created_at": "2020-12-09T21:26:35.000000Z",
    |                "updated_at": "2020-12-09T21:26:35.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Polly Jean Harvey",
    |                "company": "Dry",
    |                "created_at": "2020-12-09T21:30:44.000000Z",
    |                "updated_at": "2020-12-09T21:30:44.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    */
    public function getAll() {
        try {
            $Banks = Bank::all();

            return response()->json([
                "response" => "success",
                "message" => "Lista recuperado satisfactoriamente.",
                "data" => $Banks
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
    | Get Bank by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Bank
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Bank        |
    |  |            |        |          | Example : 2                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Banco recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Nick Cave",
    |            "company": "Grinderman",
    |            "created_at": "2020-12-09T21:26:35.000000Z",
    |            "updated_at": "2020-12-09T21:26:35.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $Bank = Bank::find($id);

            if (is_null($Bank)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Banco no encontrado.",
                    "data" => $Bank
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Banco recuperado satisfactoriamente.",
                "data" => $Bank
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
    | Update a Bank
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Bank
    |
    |   {
    |        "id" : 3,
    |        "name" : "P.J Harvey",
    |        "company" : "Dry"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Banco actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Banco recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "P.J Harvey",
    |                    "company": "Dry",
    |                    "created_at": "2020-12-09T21:30:44.000000Z",
    |                    "updated_at": "2020-12-09T21:40:11.000000Z",
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
            $Bank = Bank::findOrFail($request->id);

            $Bank->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Banco actualizado satisafactoriamente.",
                "data" => $this->getByID($Bank->id)
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
    | Delete a Bank
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Bank
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Bank       |
    |  |            |        |          | Example : 2                       |
    |  |            |        |          |                                   |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Banco eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Nick Cave",
    |            "company": "Grinderman",
    |            "created_at": "2020-12-09T21:26:35.000000Z",
    |            "updated_at": "2020-12-09T21:26:35.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($bank_id)
    {
        try {
            $Bank = Bank::find($bank_id);


            if (!is_null($Bank)) {
                $Bank->destroy($bank_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Banco eliminado satisfactoriamente.",
                    "data" => $Bank
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Banco no encontrado.",
                    "data" => $Bank
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
    | Create or Update Banks Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Bank
    |
    */
    public function getRules() {
        return [
            'name' => 'required',
            'company' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name' => 'Debe escribir un Nombre',
            'company' => 'Debe escribir una Compañía',
        ];
    }
}
