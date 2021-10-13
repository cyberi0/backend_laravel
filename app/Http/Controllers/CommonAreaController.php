<?php

namespace App\Http\Controllers;

use App\Models\CommonArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonAreaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Common Areas
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Account
    |
    |   {
    |        "complex_id" : 1,
    |        "name" : "Nine Inch Nails",
    |        "description" : "Lorem Ipsum Dolor",
    |        "price" : 15000,
    |        "price_type" : 1,
    |        "price_unit" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Área Común creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Área Común recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 1,
    |                        "name": "Nine Inch Nails",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "price": "15000.00",
    |                        "price_type": "1",
    |                        "price_unit": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-03T23:19:18.000000Z",
    |                        "updated_at": "2020-12-03T23:19:18.000000Z",
    |                        "deleted_at": null,
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 2,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Cluster BRC",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": null,
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
            $CommonArea = CommonArea::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Área Común creada satisfactoriamente.",
                "data" => $this->getByID($CommonArea->id)
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
    | Get All Common Areas
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Common Areas
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Lista recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "complex_id": 1,
    |                "name": "Nine Inch Nails",
    |                "description": "Lorem Ipsum Dolor",
    |                "price": "15000.00",
    |                "price_type": "1",
    |                "price_unit": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-03T23:19:18.000000Z",
    |                "updated_at": "2020-12-03T23:19:18.000000Z",
    |                "deleted_at": null,
    |                "complex": {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 2,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Cluster BRC",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
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
            $CommonAreas = CommonArea::with('complex')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $CommonAreas
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
    | Get Common Area by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Common Area
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Common Area |
    |  |            |        |         | Example : 1                        |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Área Común recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "complex_id": 1,
    |                "name": "Nine Inch Nails",
    |                "description": "Lorem Ipsum Dolor",
    |                "price": "15000.00",
    |                "price_type": "1",
    |                "price_unit": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-03T23:19:18.000000Z",
    |                "updated_at": "2020-12-03T23:19:18.000000Z",
    |                "deleted_at": null,
    |                "complex": {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 2,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Cluster BRC",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": null,
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
            $account = CommonArea::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Área Común no encontrada.",
                    "data" => $account
                ]);
            } else {
                $account = $account
                    ->with('complex')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Área Común recuperada satisfactoriamente.",
                "data" => $account
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
    | Update an Account
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Account
    |
    |   {
    |        "id" : 1,
    |        "complex_id" : 1,
    |        "name" : "Nine Inch Nails",
    |        "description" : "Lorem Ipsum Dolor",
    |        "price" : 18000,
    |        "price_type" : 1,
    |        "price_unit" : "Lorem Ipsum Dolor"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Área Común actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Área Común recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "complex_id": 1,
    |                        "name": "Nine Inch Nails",
    |                        "description": "Lorem Ipsum Dolor",
    |                        "price": "18000.00",
    |                        "price_type": "1",
    |                        "price_unit": "Lorem Ipsum Dolor",
    |                        "created_at": "2020-12-03T23:19:18.000000Z",
    |                        "updated_at": "2020-12-03T23:26:33.000000Z",
    |                        "deleted_at": null,
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 2,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Cluster BRC",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": null,
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
            $CommonArea = CommonArea::findOrFail($request->id);

            $CommonArea->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Área Común actualizada satisafactoriamente.",
                "data" => $this->getByID($CommonArea->id)
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
    | Delete Common Area
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Common Area
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Common Area|
    |  |            |        |          | Example : 1                       |
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
    |        "message": "Área Común eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "complex_id": 1,
    |            "name": "Nine Inch Nails",
    |            "description": "Lorem Ipsum Dolor",
    |            "price": "18000.00",
    |            "price_type": "1",
    |            "price_unit": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-03T23:19:18.000000Z",
    |            "updated_at": "2020-12-03T23:26:33.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($common_area_id)
    {
        try {
            $CommonArea = CommonArea::find($common_area_id);

            if (!is_null($CommonArea)) {
                $CommonArea->destroy($common_area_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Área Común eliminada satisfactoriamente.",
                    "data" => $CommonArea
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Área Común no encontrada.",
                    "data" => $CommonArea
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
    | Create or Update Common Areas Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Common Areas
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required|exists:complexes,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_type' => 'required',
            'price_unit' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir un Complejo',
            'complex_id.exists' => 'No existe el Complejo',
            'name.required' => 'Debe escribir un propietario',
            'description.required' => 'Debe escribir una Descripción',
            'price.required' => 'Debe escribir una Clabe',
            'price_type.required' => 'Debe escribir Tipo de Precio',
            'price_unit.required' => 'Debe escribir Unidad del Precio',
        ];
    }
}
