<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigurationsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Configuration
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a  Configuration
    |
    |   {
    |        "key" : "bobba6755DASFG",
    |        "value" : "Lorem Ipsum Dolor",
    |        "level" : "Premium"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |  {
    |        "response": "success",
    |        "message": "a  Configuración creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "a  Configuración recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "key": "bobba6755DASFG",
    |                    "value": "Lorem Ipsum Dolor",
    |                    "level": "Premium",
    |                    "created_at": "2020-12-11T15:45:19.000000Z",
    |                    "updated_at": "2020-12-11T15:45:19.000000Z",
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
            $Configuration = Configuration::create($input);
            return response()->json([
                "response" => "success",
                "message" => "a  Configuración creada satisfactoriamente.",
                "data" => $this->getByID($Configuration->id)
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
    |                "id": 1,
    |                "key": "oasisFASE234",
    |                "value": "Lorem Ipsum Dolor",
    |                "level": "High",
    |                "created_at": "2020-12-11T15:42:42.000000Z",
    |                "updated_at": "2020-12-11T15:42:42.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "key": "manndo4234DASFG",
    |                "value": "Lorem Ipsum Dolor",
    |                "level": "Medium",
    |                "created_at": "2020-12-11T15:43:59.000000Z",
    |                "updated_at": "2020-12-11T15:43:59.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "key": "bobba6755DASFG",
    |                "value": "Lorem Ipsum Dolor",
    |                "level": "Premium",
    |                "created_at": "2020-12-11T15:45:19.000000Z",
    |                "updated_at": "2020-12-11T15:45:19.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $Configurations = Configuration::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Configurations
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
    | Get Configuration by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Configuration
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                              |
    |  |----------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Configuration|
    |  |            |        |          | Example : 3                         |
    |  |____________|________|__________|_____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "a  Configuración recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "key": "bobba6755DASFG",
    |            "value": "Lorem Ipsum Dolor",
    |            "level": "Premium",
    |            "created_at": "2020-12-11T15:45:19.000000Z",
    |            "updated_at": "2020-12-11T15:45:19.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $Configuration = Configuration::find($id);

            if (is_null($Configuration)) {
                return response()->json([
                    "response" => "error",
                    "message" => "a  Configuración no encontrada.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "a  Configuración recuperada satisfactoriamente.",
                "data" => $Configuration
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
    | Update a Configuration
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Configuration
    |
    |   {
    |        "id" : 3,
    |        "key" : "bobba6755DASFG",
    |        "value" : "Lorem Ipsum Dolor",
    |        "level" : "Premium II"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "a  Configuración actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "a  Configuración recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "key": "bobba6755DASFG",
    |                    "value": "Lorem Ipsum Dolor",
    |                    "level": "Premium II",
    |                    "created_at": "2020-12-11T15:45:19.000000Z",
    |                    "updated_at": "2020-12-11T15:50:23.000000Z",
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
            $Configuration = Configuration::findOrFail($request->id);

            $Configuration->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "a  Configuración actualizada satisafactoriamente.",
                "data" => $this->getByID($Configuration->id)
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
    | Delete a Configuration
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Configuration
    |   using the following parameter:
    |
    |   ______________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                             |
    |  |----------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Configuration|
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
    |        "message": "a  Configuración eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "key": "bobba6755DASFG",
    |            "value": "Lorem Ipsum Dolor",
    |            "level": "Premium II",
    |            "created_at": "2020-12-11T15:45:19.000000Z",
    |            "updated_at": "2020-12-11T15:50:23.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $Configuration = Configuration::find($id);


            if (!is_null($Configuration)) {
                $Configuration->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "a  Configuración eliminada satisfactoriamente.",
                    "data" => $Configuration
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "a  Configuración no encontrada.",
                    "data" => $Configuration
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
    | Create or Update Configurations Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Configuration
    |
    */
    public function getRules() {
        return [
            'key' => 'required',
            'value' => 'required',
            'level' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'key' => 'Debe escribir un Llave',
            'value' => 'Debe escribir un Valor',
            'level' => 'Debe escribir un Nivel',
        ];
    }
}
