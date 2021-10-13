<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Vehicle Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Vehicle Types
    |
    |   {
    |        "name" : "Motocicleta"
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Vehículo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Vehículo recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Motocicleta",
    |                    "created_at": "2020-12-14T22:18:44.000000Z",
    |                    "updated_at": "2020-12-14T22:18:44.000000Z",
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
            $VehicleType = VehicleType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Vehículo creado satisfactoriamente.",
                "data" => $this->getByID($VehicleType->id)
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
    | Get All Vehicle Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Vehicle Types
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
    |                "name": "4x4",
    |                "created_at": "2020-12-14T13:19:04.000000Z",
    |                "updated_at": null,
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Auto",
    |                "created_at": "2020-12-14T22:17:38.000000Z",
    |                "updated_at": "2020-12-14T22:17:38.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 3,
    |                "name": "Motocicleta",
    |                "created_at": "2020-12-14T22:18:44.000000Z",
    |                "updated_at": "2020-12-14T22:18:44.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $VehicleTypes = VehicleType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $VehicleTypes
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
    | Get Vehicle Types by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Vehicle Types
    |   using the following parameter:
    |
    |   ___________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                           |
    |  |-------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the VehicleType|
    |  |            |        |         | Example : 2                       |
    |  |____________|________|_________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Vehículo recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Auto",
    |            "created_at": "2020-12-14T22:17:38.000000Z",
    |            "updated_at": "2020-12-14T22:17:38.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $VehicleType = VehicleType::find($id);

            if (is_null($VehicleType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Vehículo no encontrado.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Vehículo recuperado satisfactoriamente.",
                "data" => $VehicleType
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
    | Update an Vehicle Types
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Vehicle Types
    |
    |   {
    |        "id" : 2,
    |        "name" : "Motocicleta 4 Llantas"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Vehículo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Vehículo recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Motocicleta 4 Llantas",
    |                    "created_at": "2020-12-14T22:17:38.000000Z",
    |                    "updated_at": "2020-12-14T22:22:30.000000Z",
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
            $VehicleType = VehicleType::findOrFail($request->id);

            $VehicleType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Vehículo actualizado satisafactoriamente.",
                "data" => $this->getByID($VehicleType->id)
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
    | Delete Vehicle Types
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Vehicle Type
    |   using the following parameter:
    |
    |   _____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                            |
    |  |---------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Vehicle Type|
    |  |            |        |          | Example : 2                        |
    |  |            |        |          |                                    |
    |  |____________|________|__________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |        "response": "success",
    |        "message": "Tipo de Vehículo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Motocicleta 4 Llantas",
    |            "created_at": "2020-12-14T22:17:38.000000Z",
    |            "updated_at": "2020-12-14T22:22:30.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $VehicleType = VehicleType::find($id);

            if (!is_null($VehicleType)) {
                $VehicleType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Vehículo eliminado satisfactoriamente.",
                    "data" => $VehicleType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Vehículo no encontrado.",
                    "data" => $VehicleType
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
    | Create or Update Vehicle Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Vehicle Types
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:vehicle_types',

        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre.',
            'name.unique' => 'el Nombre ya existe.'

        ];
    }
}
