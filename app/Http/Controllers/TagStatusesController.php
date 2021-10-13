<?php

namespace App\Http\Controllers;

use App\Models\TagStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagStatusesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Tag Status
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Tag Status
    |
    |   {
    |       "name" : "Zen To Chihiro"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Etiqueta de Estatus creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Etiqueta de Estatus recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Zen To Chihiro",
    |                    "created_at": "2020-12-12T19:46:44.000000Z",
    |                    "updated_at": "2020-12-12T19:46:44.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
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
            $TagStatus = TagStatus::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Etiqueta de Estatus creada satisfactoriamente.",
                "data" => $this->getByID($TagStatus->id)
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
    | Get All Tag Statuses
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Tag Statuses
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
    |                "name": "Aka Ringu",
    |                "created_at": "2020-12-12T19:44:54.000000Z",
    |                "updated_at": "2020-12-12T19:44:54.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Zen To Chihiro",
    |                "created_at": "2020-12-12T19:46:44.000000Z",
    |                "updated_at": "2020-12-12T19:46:44.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $TagStatuses = TagStatus::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $TagStatuses
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
    | Get Tag Status by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Tag Status
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Tag Status |
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
    |        "message": "Etiqueta de Estatus recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Zen To Chihiro",
    |            "created_at": "2020-12-12T19:46:44.000000Z",
    |            "updated_at": "2020-12-12T19:46:44.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $TagStatus = TagStatus::find($id);

            if (is_null($TagStatus)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Etiqueta de Estatus no encontrada.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Etiqueta de Estatus recuperada satisfactoriamente.",
                "data" => $TagStatus
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
    | Update Tag Status
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Tag Status
    |
    |
    |    {
    |        "id" : 2,
    |        "name" : "Zen To Chihiro II"
    |    }
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    |    {
    |        "response": "success",
    |        "message": "Etiqueta de Estatus actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Etiqueta de Estatus recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Zen To Chihiro II",
    |                    "created_at": "2020-12-12T19:46:44.000000Z",
    |                    "updated_at": "2020-12-12T19:55:37.000000Z",
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
            $TagStatus = TagStatus::findOrFail($request->id);

            $TagStatus->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Etiqueta de Estatus actualizada satisafactoriamente.",
                "data" => $this->getByID($TagStatus->id)
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
    | Delete Tag Statuses
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Tag Status
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Tag Status |
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
    |        "message": "Etiqueta de Estatus eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Zen To Chihiro II",
    |            "created_at": "2020-12-12T19:46:44.000000Z",
    |            "updated_at": "2020-12-12T19:55:37.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($TagStatus_id)
    {
        try {
            $TagStatus = TagStatus::find($TagStatus_id);


            if (!is_null($TagStatus)) {
                $TagStatus->destroy($TagStatus_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Etiqueta de Estatus eliminada satisfactoriamente.",
                    "data" => $TagStatus
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Etiqueta de Estatus no encontrada.",
                    "data" => $TagStatus
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
    | Create or Update Tag Statuses Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Tag Status
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:tag_statuses',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre.',
            'name.unique' => 'El Nombre ya existe.',
        ];
    }
}
