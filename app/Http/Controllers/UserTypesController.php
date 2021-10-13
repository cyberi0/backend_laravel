<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserTypesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create User Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an User Type
    |
    |   {
    |        "name" : "Administrator",
    |        "description" : "Lorem Ipsum Dolor",
    |        "slug" : "ADMIN"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Usuario creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Usuario recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "Administrator",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "ADMIN",
    |                    "created_at": "2020-12-14T21:58:21.000000Z",
    |                    "updated_at": "2020-12-14T21:58:21.000000Z",
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
            $UserType = UserType::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Tipo de Usuario creado satisfactoriamente.",
                "data" => $this->getByID($UserType->id)
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
    | Get All User Types
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all User Types
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
    |                "name": "Administrator",
    |                "description": "Lorem Ipsum Dolor",
    |                "slug": "ADMIN",
    |                "created_at": "2020-12-14T21:58:21.000000Z",
    |                "updated_at": "2020-12-14T21:58:21.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $UserTypes = UserType::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $UserTypes
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
    | Get User Type by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific User Type
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the User Type   |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Tipo de Usuario recuperado satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "name": "Administrator",
    |            "description": "Lorem Ipsum Dolor",
    |            "slug": "ADMIN",
    |            "created_at": "2020-12-14T21:58:21.000000Z",
    |            "updated_at": "2020-12-14T21:58:21.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $UserType = UserType::find($id);

            if (is_null($UserType)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Usuario no encontrado.",
                    "data" => $UserType
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Usuario recuperado satisfactoriamente.",
                "data" => $UserType
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
    | Update an User Type
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an User Type
    |
    |   {
    |        "id" : 1,
    |        "name" : "Administrator C",
    |        "description" : "Lorem Ipsum Dolor",
    |        "slug" : "ADMIN.C"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Tipo de Usuario actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Tipo de Usuario recuperado satisfactoriamente.",
    |                "data": {
    |                    "id": 1,
    |                    "name": "Administrator C",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "ADMIN.C",
    |                    "created_at": "2020-12-14T21:58:21.000000Z",
    |                    "updated_at": "2020-12-14T22:03:30.000000Z",
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
            $UserType = UserType::findOrFail($request->id);

            $UserType->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Tipo de Usuario actualizado satisafactoriamente.",
                "data" => $this->getByID($UserType->id)
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
    | Delete an User Type
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific User Type
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the User Type  |
    |  |            |        |          | Example : 1                       |
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
    |        "message": "Tipo de Usuario eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "name": "Administrator C",
    |            "description": "Lorem Ipsum Dolor",
    |            "slug": "ADMIN.C",
    |            "created_at": "2020-12-14T21:58:21.000000Z",
    |            "updated_at": "2020-12-14T22:03:30.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($id)
    {
        try {
            $UserType = UserType::find($id);


            if (!is_null($UserType)) {
                $UserType->destroy($id);
                return response()->json([
                    "response" => "success",
                    "message" => "Tipo de Usuario eliminado satisfactoriamente.",
                    "data" => $UserType
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Tipo de Usuario no encontrado.",
                    "data" => $UserType
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
    | Create or Update User Types Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an User Type
    |
    */
    public function getRules() {
        return [
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name' => 'Debe escribir un Nombre.',
            'description' => 'Debe escribir una Descripción',
            'slug' => 'Debe escribir un Slug',
        ];
    }
}
