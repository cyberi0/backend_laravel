<?php

namespace App\Http\Controllers;

use App\Models\ComplexFeeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexFeeTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Complex Fee Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Complex Fee Type
    |
    |   {
    |       "name" : "Akufen",
    |       "description" : "Lorem Ipsum Dolor"
    |   }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Cuota creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Cuota recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "Akufen",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T04:54:52.000000Z",
    |                    "updated_at": "2020-12-11T04:54:52.000000Z",
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
            $ComplexFeeType = ComplexFeeType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Cuota creada satisfactoriamente.",
                "data" => $this->getByID($ComplexFeeType->id)
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
    |                "name": "Akufen",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T04:54:52.000000Z",
    |                "updated_at": "2020-12-11T04:54:52.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Akufen My Way",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-11T04:56:04.000000Z",
    |                "updated_at": "2020-12-11T04:56:04.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $ComplexFeeTypes = ComplexFeeType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexFeeTypes
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
    | Get Complex Fee Type by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific ComplexFeeType
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex Fee|
    |  |            |        |          | Type Example : 2                  |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Cuota recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Akufen Bolier Room Berlin",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-11T04:56:04.000000Z",
    |            "updated_at": "2020-12-11T05:07:58.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {

        try{
            $ComplexFeeType = ComplexFeeType::find($id);
            if (is_null($ComplexFeeType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Cuota no encontrada.",
                    "data" => $ComplexFeeType
                ]);
            } else {
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Cuota recuperada satisfactoriamente.",
                    "data" => $ComplexFeeType
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
    | Update a Complex Fee Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a Complex FeeType
    |
    |   {
    |        "id": 2,
    |        "name" : "Akufen Bolier Room Berlin Live",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Cuota actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Cuota recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Akufen Bolier Room Berlin Live",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-11T04:56:04.000000Z",
    |                    "updated_at": "2020-12-11T05:13:40.000000Z",
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
            $ComplexFeeType = ComplexFeeType::findOrFail($request->id);

            $ComplexFeeType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Cuota actualizada satisafactoriamente.",
                "data" => $this->getByID($ComplexFeeType->id)
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
    | Delete a Complex Fee Type
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Fee Type
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Complex Fee|
    |  |            |        |          | Type. Example : 2                 |
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
    |        "message": "Tipo de Cuota eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Akufen Bolier Room Berlin Live",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-11T04:56:04.000000Z",
    |            "updated_at": "2020-12-11T05:13:40.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($account_id)
    {
        try {
            $ComplexFeeType = ComplexFeeType::find($account_id);


            if (!is_null($ComplexFeeType)) {
                $ComplexFeeType->destroy($account_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Cuota eliminada satisfactoriamente.",
                    "data" => $ComplexFeeType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Cuota no encontrada.",
                    "data" => $ComplexFeeType
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
    | Create or Update Complex Fee Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Complex Fee Types
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:complex_fee_types',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre.',
            'name.unique' => 'El Nombre ya existe.',
            'description.required' => 'Debe escribir una Descripción.',
        ];
    }
}
