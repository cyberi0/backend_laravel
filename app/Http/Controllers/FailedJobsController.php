<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FailedJobsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Failed Jobs
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Failed Jobs
    |
    |   {
    |        "uuid" : "tyt876876uyg",
    |        "connection":"yugiojpk",
    |        "queue" : "iugy87t87",
    |        "payload" : "fytugipih",
    |        "exception" : "fuugytry4789",
    |        "failed_at" : "2020-12-04 17:30:40"
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Fallo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Fallo recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "uuid": "tyt876876uyg",
    |                    "connection": "yugiojpk",
    |                    "queue": "iugy87t87",
    |                    "payload": "fytugipih",
    |                    "exception": "fuugytry4789",
    |                    "failed_at": "2020-12-04 17:30:40",
    |                    "created_at": "2020-12-11T19:46:22.000000Z",
    |                    "updated_at": "2020-12-11T19:46:22.000000Z",
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
            $FailedJob = FailedJob::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Fallo creado satisfactoriamente.",
                "data" => $this->getByID($FailedJob->id)
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
    | Get All Failed Jobs
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Failed Jobs
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
    |                "uuid": "tyt876876uyg",
    |                "connection": "yugiojpk",
    |                "queue": "iugy87t87",
    |                "payload": "fytugipih",
    |                "exception": "fuugytry4789",
    |                "failed_at": "2020-12-04 17:30:40",
    |                "created_at": "2020-12-11T19:46:22.000000Z",
    |                "updated_at": "2020-12-11T19:46:22.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "uuid": "cbt854876uty",
    |                "connection": "yogiojpk",
    |                "queue": "iugy88943s",
    |                "payload": "fresdgipih",
    |                "exception": "wergytry4789",
    |                "failed_at": "2020-12-04 17:30:40",
    |                "created_at": "2020-12-11T19:48:35.000000Z",
    |                "updated_at": "2020-12-11T19:48:35.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $FailedJobs = FailedJob::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $FailedJobs
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
    | Get Failed Job by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Failed Job
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Failed Job |
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
    |        "message": "Fallo recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "uuid": "cbt854876uty",
    |            "connection": "yogiojpk",
    |            "queue": "iugy88943s",
    |            "payload": "fresdgipih",
    |            "exception": "wergytry4789",
    |            "failed_at": "2020-12-04 17:30:40",
    |            "created_at": "2020-12-11T19:48:35.000000Z",
    |            "updated_at": "2020-12-11T19:48:35.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $FailedJob = FailedJob::find($id);

            if (is_null($FailedJob)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Fallo no encontrado.",
                ]);
            }
            return response()->json([
                "response" => "success",
                "message" => "Fallo recuperado satisfactoriamente.",
                "data" => $FailedJob
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
    | Update an Failed Job
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Failed Job
    |
    |   {
    |        "id" : 2,
    |        "uuid" : "cbt854876uty",
    |        "connection":"yo23ojpk",
    |        "queue" : "iugt78967s",
    |        "payload" : "fresdgipih",
    |        "exception" : "rerhtgry4789",
    |        "failed_at" : "2020-12-04 18:20:40"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Fallo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Fallo recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "uuid": "cbt854876uty",
    |                    "connection": "yo23ojpk",
    |                    "queue": "iugt78967s",
    |                    "payload": "fresdgipih",
    |                    "exception": "rerhtgry4789",
    |                    "failed_at": "2020-12-04 18:20:40",
    |                    "created_at": "2020-12-11T19:48:35.000000Z",
    |                    "updated_at": "2020-12-11T19:52:09.000000Z",
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
            $FailedJob = FailedJob::findOrFail($request->id);

            $FailedJob->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Fallo actualizado satisafactoriamente.",
                "data" => $this->getByID($FailedJob->id)
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
    | Delete an Failed Job
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Failed Job
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Failed Job |
    |  |            |        |          | Example : 2                       |
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
    |        "message": "Fallo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "uuid": "cbt854876uty",
    |            "connection": "yo23ojpk",
    |            "queue": "iugt78967s",
    |            "payload": "fresdgipih",
    |            "exception": "rerhtgry4789",
    |            "failed_at": "2020-12-04 18:20:40",
    |            "created_at": "2020-12-11T19:48:35.000000Z",
    |            "updated_at": "2020-12-11T19:52:09.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $FailedJob = FailedJob::find($id);


            if (!is_null($FailedJob)) {
                $FailedJob->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Fallo eliminado satisfactoriamente.",
                    "data" => $FailedJob
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Fallo no encontrada.",
                    "data" => $FailedJob
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
    | Create or Update Failed Jobs Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Failed Jobs
    |
    */
    public function getRules() {
        return [
            'uuid' => 'required',
            'connection' => 'required',
            'queue' => 'required',
            'payload' => 'required',
            'exception' => 'required',
            'failed_at' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'uuid.required' => 'Debe escribir un UUID',
            'connection.required' => 'Debe escribir la Conección',
            'queue.required' => 'Debe escribir una Cola',
            'payload.required' => 'Debe escribir el Cargo',
            'exception.required' => 'Debe escribir una Excepción',
            'failed_at.required' => 'Debe elegir una Fecha del fallo',
        ];
    }
}
