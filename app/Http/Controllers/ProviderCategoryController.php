<?php

namespace App\Http\Controllers;

use App\Models\ComplexProviderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderCategoryController extends Controller
{
    /*
|
|--------------------------------------------------------------------------
| Create Provider Category
|--------------------------------------------------------------------------
|   With The following JSON, you can create an Account
|
|   {
|       "name" : "Rubik",
|       "description" : "Lorem Impsun Dolor"
|   }
|
|--------------------------------------------------------------------------
| Response Success
|--------------------------------------------------------------------------
|
|   {
|        "response": "success",
|        "message": "Categoría creada satisfactoriamente.",
|        "data": {
|            "headers": {},
|            "original": {
|                "response": "error",
|                "message": "Call to undefined relationship [method] on model [App\\Models\\ComplexProviderCategory]."
|            },
|            "exception": null
|        }
|    }
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
            $ComplexProviderCategory = ComplexProviderCategory::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Categoría creada satisfactoriamente.",
                "data" => $this->getByID($ComplexProviderCategory->id)
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
    | Get All Provider Category
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Provider Category
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |
    */
    public function getAll() {
        try {
            $ComplexProviderCategories = ComplexProviderCategory::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexProviderCategories
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
    | Get Provider Category by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Provider Category
    |   using the following parameter:
    |
    |   _____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Provider    |
    |  |            |        |         | Category Example : 3               |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Categoría creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Categoría recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 3,
    |                    "name": "Clipper",
    |                    "description": "Lorem Impsun Dolor",
    |                    "created_at": "2020-12-03T20:50:47.000000Z",
    |                    "updated_at": "2020-12-03T20:50:47.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
    |
    */
    public function getByID($id) {
        try{
            $ComplexProviderCategory = ComplexProviderCategory::find($id);

            if (is_null($ComplexProviderCategory)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Categoría no encontrada.",
                    "data" => $ComplexProviderCategory
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Categoría recuperada satisfactoriamente.",
                "data" => $ComplexProviderCategory
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
    | Update Provider Category
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Account
    |
    |   {
    |       "id": 2,
    |       "name" : "Clipper II",
    |       "description" : "Lorem Impsun Dolor"
    |   }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Categoría actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Categoría recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "name": "Clipper II",
    |                    "description": "Lorem Impsun Dolor",
    |                    "created_at": "2020-12-03T20:46:10.000000Z",
    |                    "updated_at": "2020-12-03T20:56:56.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            "exception": null
    |        }
    |    }
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
            $ComplexProviderCategory = ComplexProviderCategory::findOrFail($request->id);

            $ComplexProviderCategory->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Categoría actualizada satisafactoriamente.",
                "data" => $this->getByID($ComplexProviderCategory->id)
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
    | Delete Provider Category
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Account
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Account    |
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
    |        "message": "Categoría eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "name": "Clipper II",
    |            "description": "Lorem Impsun Dolor",
    |            "created_at": "2020-12-03T20:46:10.000000Z",
    |            "updated_at": "2020-12-03T20:56:56.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($category_id)
    {
        try {
            $ComplexProviderCategory = ComplexProviderCategory::find($category_id);


            if (!is_null($ComplexProviderCategory)) {
                $ComplexProviderCategory->destroy($category_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Categoría eliminada satisfactoriamente.",
                    "data" => $ComplexProviderCategory
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Categoría no encontrada.",
                    "data" => $ComplexProviderCategory
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
    | Create or Update Provider Category Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Provider Category
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:complex_provider_categories',
            'description' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un Nombre',
            'description.required' => 'Debe escribir una Descripción',
        ];
    }
}
