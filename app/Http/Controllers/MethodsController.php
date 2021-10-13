<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MethodsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Method
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Method
    |
    |   {
    |        "name" : "Credit Card",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuenta creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "Credit Card",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-12T00:41:49.000000Z",
    |                    "updated_at": "2020-12-12T00:41:49.000000Z",
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
            $Method = Method::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuenta creada satisfactoriamente.",
                "data" => $this->getByID($Method->id)
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
    | Get All Methods
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Methods
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
    |                "name": "Credit Card",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-12T00:41:49.000000Z",
    |                "updated_at": "2020-12-12T00:41:49.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "name": "Paypal",
    |                "description": "Lorem Ipsum Dolor",
    |                "created_at": "2020-12-12T00:43:07.000000Z",
    |                "updated_at": "2020-12-12T00:43:07.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $Methods = Method::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $Methods
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
    | Get Method by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Method
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Method     |
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
    |        "message": "Cuenta recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Paypal",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T00:43:07.000000Z",
    |            "updated_at": "2020-12-12T00:43:07.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $account = Method::find($id);

            if (is_null($account)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Cuenta recuperada satisfactoriamente.",
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
    | Update Method
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Method
    |
    |   {
    |        "id" : 2,
    |        "name" : "Paypal 2.0",
    |        "description" : "Lorem Ipsum Dolor"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuenta actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Paypal 2.0",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "created_at": "2020-12-12T00:43:07.000000Z",
    |                    "updated_at": "2020-12-12T00:48:55.000000Z",
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
            $Method = Method::findOrFail($request->id);

            $Method->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuenta actualizada satisafactoriamente.",
                "data" => $this->getByID($Method->id)
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
    | Delete an Method
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Method
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Method     |
    |  |            |        |          | Example : 3                       |
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
    |        "message": "Cuenta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "name": "Method 4 Delete",
    |            "description": "Lorem Ipsum Dolor",
    |            "created_at": "2020-12-12T00:51:46.000000Z",
    |            "updated_at": "2020-12-12T00:51:46.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $Method = Method::find($id);


            if (!is_null($Method)) {
                $Method->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuenta eliminada satisfactoriamente.",
                    "data" => $Method
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $Method
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
    | Create or Update Methods Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Methods
    |
    */
    public function getRules() {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name' => 'Debe escribir un Nombre',
            'description' => 'Debe escribir una Descripción',
        ];
    }
}
