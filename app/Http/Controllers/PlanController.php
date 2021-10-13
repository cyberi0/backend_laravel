<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Plan
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Plan
    |
    |    {
    |        "name" : "Plan Premium",
    |        "description" : "Lorem Ipsum Dolor",
    |        "slug": "SlugPlan",
    |        "price" : 1000
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |        "response": "success",
    |        "message": "Plan creado satisfactoriamente.",
    |        "data": {
    |            "name": "Plan Premium",
    |            "description": "Lorem Ipsum Dolor",
    |            "slug": "SlugPlan",
    |            "price": 1500,
    |            "updated_at": "2020-11-28T17:59:20.000000Z",
    |            "created_at": "2020-11-28T17:59:20.000000Z",
    |            "id": 3
    |        }
    |    }
    |
    */
    public function create(Request $request) {
        $input = $request->all();
        $validatedData = Validator::make($request->all(), $this->getRules(), $this->getMessages());

        if($validatedData->fails()) {
            return response()->json([
                "response" => "error",
                "message" => $validatedData->errors()->first(),
                "code" => 400
            ]);
        }

        try {
            $plan = Plan::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Plan creado satisfactoriamente.",
                "data" => $plan
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
    | Get All Plans
    |--------------------------------------------------------------------------
    |   With this service you can get all Plans
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |            "response": "success",
    |            "message": "Lista de Planes recuperada satisfactoriamente.",
    |            "data": [
    |                {
    |                    "id": 1,
    |                    "name": "Plan One",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "SlugPlan",
    |                    "price": "1000.00",
    |                    "created_at": "2020-11-28T00:30:40.000000Z",
    |                    "updated_at": "2020-11-28T00:30:40.000000Z",
    |                    "deleted_at": null
    |                },
    |                {
    |                    "id": 2,
    |                    "name": "Plan Ultimate",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "SlugPlan",
    |                    "price": "1000.00",
    |                    "created_at": "2020-11-28T16:05:06.000000Z",
    |                    "updated_at": "2020-11-28T16:05:06.000000Z",
    |                    "deleted_at": null
    |                },
    |                {
    |                    "id": 3,
    |                    "name": "Plan Premium",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "SlugPlan",
    |                    "price": "1500.00",
    |                    "created_at": "2020-11-28T17:59:20.000000Z",
    |                    "updated_at": "2020-11-28T17:59:20.000000Z",
    |                    "deleted_at": null
    |                }
    |            ]
    |        }
    |
    */
    public function getAll() {
        try {
            $plans = Plan::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista de Planes recuperada satisfactoriamente.",
                "data" => $plans
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
    | Get Plan by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Plan
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Plan       |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |       "message": "Datos del Plan recuperados satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "name": "Plan One",
    |            "description": "Lorem Ipsum Dolor",
    |            "slug": "SlugPlan",
    |            "price": "1000.00",
    |            "created_at": "2020-11-28T00:30:40.000000Z",
    |            "updated_at": "2020-11-28T00:30:40.000000Z",
    |            "deleted_at": null
    |        }
    |    }

*/
    public function getByID($id) {
        try{
            $plan = Plan::find($id);
            if (is_null($plan)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Plan no encontrado.",
                    "data" => $plan
                ]);
            }
            return response()->json([
                "response" => "success",
                "message" => "Datos del Plan recuperados satisfactoriamente.",
                "data" => $plan
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
    | Update a Plan
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a Plan
    |
    |    {
    |        "id" : 3,
    |        "name" : "Plan Premium II",
    |        "description" : "Lorem Ipsum Dolor",
    |        "slug":"SlugPlan",
    |        "price" : 1800
    |     }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |        "response": "success",
    |        "message": "Plan creado satisfactoriamente.",
    |        "data": {
    |            "name": "Plan Premium",
    |            "description": "Lorem Ipsum Dolor",
    |            "slug": "SlugPlan",
    |            "price": 1500,
    |            "updated_at": "2020-11-28T17:59:20.000000Z",
    |            "created_at": "2020-11-28T17:59:20.000000Z",
    |            "id": 3
    |        }
    |    }
    |
    */
    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), $this->getRules(), $this->getMessages());
        if($validatedData->fails()) {
            return response()->json([
                "response" => "error",
                "message" => $validatedData->errors()->first(),
                "code" => 400
            ]);
        }
        try{
            $input = $request->all();
            $plan = new Plan();
            $plan->name = $input['name'];
            $plan->description = $input['description'];
            $plan->slug = $input['slug'];
            $plan->price = $input['price'];
            $plan->save();

            return response()->json([
                "response" => "success",
                "message" => "Plan actualizado satisfactoriamente.",
                "data" => $plan
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
    | Delete a Plan
    |--------------------------------------------------------------------------
    |   With The following JSON, you can delete a Plan
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Plan       |
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |    "response": "success",
    |    "message": "Plan eliminado satisfactoriamente.",
    |    "data": {
    |        "id": 5,
    |        "name": "Plan 4 Delete",
    |        "description": "Lorem Ipsum Dolor",
    |        "slug": "SlugPlan",
    |        "price": "500.00",
    |        "created_at": "2020-11-28T19:40:41.000000Z",
    |        "updated_at": "2020-11-28T19:40:41.000000Z",
    |        "deleted_at": null
    |    }
    |   }
    |
    |
    */
    public function delete($plan_id)
    {
        try {
            $Plan = Plan::find($plan_id);
            if(!is_null($Plan)) {
                $Plan->destroy($plan_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Plan eliminado satisfactoriamente.",
                    "data" => $Plan
                ]);
            }else {
                return response()->json([
                    "response" => "error",
                    "message" => "Plan no encontrado.",
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
    | Create / Update Plan  Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a Plan
    |
    */
    public function getRules() {
        return [
            'name' => 'required|unique:plans',
            'description' => 'required',
            'slug' => 'required',
            'price' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'name.required' => 'Debe escribir un nombre para el Plan.',
            'name.unique' => 'Nombre del Plan existente.',
            'description.required' => 'Debe escribir la Descripción del Plan.',
            'slug.required' => 'Debe escribir el identificador del Plan.',
            'price.required' => 'Debe ingresar el precio del Plan.',
        ];
    }

}
