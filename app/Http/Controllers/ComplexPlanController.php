<?php

namespace App\Http\Controllers;
use App\Models\ComplexPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexPlanController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Create ComplexPlan
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create a ComplexPlan
    |
    |   {
    |        "complex_id" : 1,
    |        "plan_id" : 1,
    |        "last_payment_at" : "2020-11-27T21:45:47",
    |        "next_payment_at" : "2020-11-27T21:45:47"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Complejo Plan creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Complejo Plan recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 1,
    |                        "plan_id": 1,
    |                        "last_payment_at": "2020-11-01 21:45:47",
    |                        "next_payment_at": "2020-11-30 21:45:47",
    |                        "created_at": "2020-11-28T20:10:52.000000Z",
    |                        "updated_at": "2020-11-30T02:37:32.000000Z",
    |                        "deleted_at": null,
    |                        "plan": {
    |                            "id": 1,
    |                            "name": "Plan One",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "slug": "SlugPlan",
    |                            "price": "1000.00",
    |                            "created_at": "2020-11-28T00:30:40.000000Z",
    |                            "updated_at": "2020-11-28T00:30:40.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 1,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Complex Paladium",
    |                            "created_at": "2020-11-28T00:30:50.000000Z",
    |                            "updated_at": "2020-11-28T00:30:50.000000Z",
    |                            "deleted_at": null
    |                        }
    |                    },
    |                    {
    |                        "id": 3,
    |                        "complex_id": 1,
    |                        "plan_id": 2,
    |                        "last_payment_at": "2020-11-27 21:45:47",
    |                        "next_payment_at": "2020-11-27 21:45:47",
    |                        "created_at": "2020-11-30T02:53:00.000000Z",
    |                        "updated_at": "2020-11-30T02:53:00.000000Z",
    |                        "deleted_at": null,
    |                        "plan": {
    |                            "id": 2,
    |                            "name": "Plan Ultimate",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "slug": "SlugPlan",
    |                            "price": "1000.00",
    |                            "created_at": "2020-11-28T16:05:06.000000Z",
    |                            "updated_at": "2020-11-28T16:05:06.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 1,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Complex Paladium",
    |                            "created_at": "2020-11-28T00:30:50.000000Z",
    |                            "updated_at": "2020-11-28T00:30:50.000000Z",
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
            $ComplexPlan = ComplexPlan::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Complejo Plan creado satisfactoriamente.",
                "data" => $this->getByID($ComplexPlan->id)
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
    | Get All ComplexPlan
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all ComplexPlan
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |        "response": "success",
    |        "message": "Lista recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 1,
    |                "plan_id": 2,
    |                "last_payment_at": "2020-11-27 21:45:47",
    |                "next_payment_at": "2020-11-27 21:45:47",
    |                "created_at": "2020-11-28T20:10:52.000000Z",
    |                "updated_at": "2020-11-28T20:10:52.000000Z",
    |                "deleted_at": null,
    |                "plan": {
    |                    "id": 2,
    |                    "name": "Plan Ultimate",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "SlugPlan",
    |                    "price": "1000.00",
    |                    "created_at": "2020-11-28T16:05:06.000000Z",
    |                    "updated_at": "2020-11-28T16:05:06.000000Z",
    |                    "deleted_at": null
    |                },
    |                "complex": {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium",
    |                    "created_at": "2020-11-28T00:30:50.000000Z",
    |                    "updated_at": "2020-11-28T00:30:50.000000Z",
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    */
    public function getAll() {
        try {
            $ComplexPlan = ComplexPlan::with('plan', 'complex')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ComplexPlan
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
    | Get ComplexPlan by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific ComplexPlan
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the ComplexPlan|
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
    |        "message": "Complejo Plan recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "complex_id": 1,
    |                "plan_id": 2,
    |                "last_payment_at": "2020-11-27 21:45:47",
    |                "next_payment_at": "2020-11-27 21:45:47",
    |                "created_at": "2020-11-28T20:10:52.000000Z",
    |                "updated_at": "2020-11-28T20:10:52.000000Z",
    |                "deleted_at": null,
    |                "plan": {
    |                    "id": 2,
    |                    "name": "Plan Ultimate",
    |                    "description": "Lorem Ipsum Dolor",
    |                    "slug": "SlugPlan",
    |                    "price": "1000.00",
    |                    "created_at": "2020-11-28T16:05:06.000000Z",
    |                    "updated_at": "2020-11-28T16:05:06.000000Z",
    |                    "deleted_at": null
    |                },
    |                "complex": {
    |                    "id": 1,
    |                    "owner_id": 1,
    |                    "admin_id": 1,
    |                    "created_by": 2,
    |                    "type_id": 1,
    |                    "use_id": 1,
    |                    "name": "Complex Paladium",
    |                    "created_at": "2020-11-28T00:30:50.000000Z",
    |                    "updated_at": "2020-11-28T00:30:50.000000Z",
    |                    "deleted_at": null
    |                }
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getByID($id) {
        try {
            $ComplexPlan = ComplexPlan::find($id);
            if (is_null($ComplexPlan)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Complejo Plan no encontrado.",
                    "data" => $ComplexPlan
                ]);
            }else {
                $ComplexPlan = $ComplexPlan->with('plan')->with('complex')->get();
            }
            return response()->json([
                "response" => "success",
                "message" => "Complejo Plan recuperado satisfactoriamente.",
                "data" => $ComplexPlan
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
    | Update a ComplexPlan
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a ComplexPlan
    |
    |    {
    |        "id": 1,
    |        "complex_id" : 1,
    |        "plan_id" : 1,
    |        "last_payment_at" : "2020-11-01 21:45:47",
    |        "next_payment_at" : "2020-11-30 21:45:47"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Complejo Plan actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Complejo Plan recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "complex_id": 1,
    |                        "plan_id": 1,
    |                        "last_payment_at": "2020-11-01 21:45:47",
    |                        "next_payment_at": "2020-11-30 21:45:47",
    |                        "created_at": "2020-11-28T20:10:52.000000Z",
    |                        "updated_at": "2020-11-30T02:37:32.000000Z",
    |                        "deleted_at": null,
    |                        "plan": {
    |                            "id": 1,
    |                            "name": "Plan One",
    |                            "description": "Lorem Ipsum Dolor",
    |                            "slug": "SlugPlan",
    |                            "price": "1000.00",
    |                            "created_at": "2020-11-28T00:30:40.000000Z",
    |                            "updated_at": "2020-11-28T00:30:40.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "complex": {
    |                            "id": 1,
    |                            "owner_id": 1,
    |                            "admin_id": 1,
    |                            "created_by": 2,
    |                            "type_id": 1,
    |                            "use_id": 1,
    |                            "name": "Complex Paladium",
    |                            "created_at": "2020-11-28T00:30:50.000000Z",
    |                            "updated_at": "2020-11-28T00:30:50.000000Z",
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
            $ComplexPlan = ComplexPlan::findOrFail($request->id);
            $ComplexPlan->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Complejo Plan actualizado satisafactoriamente.",
                "data" => $this->getByID($request->id)
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
    | Delete a ComplexPlan
    |--------------------------------------------------------------------------
    |   With The following JSON, you can delete a ComplexPlan
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the ComplexPlan|
    |  |            |        |          | Example : 1                       |
    |  |____________|________|__________|___________________________________|
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |        {
    |        "response": "success",
    |        "message": "Complejo Plan eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "complex_id": 1,
    |            "plan_id": 1,
    |            "last_payment_at": "2020-11-01 21:45:47",
    |            "next_payment_at": "2020-11-30 21:45:47",
    |            "created_at": "2020-11-28T00:31:19.000000Z",
    |            "updated_at": "2020-11-28T20:19:01.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($complex_plan_id)
    {
        try {
            $CompolexPlan = ComplexPlan::find($complex_plan_id);
            if(!is_null($CompolexPlan)) {
                $CompolexPlan->destroy($complex_plan_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Complejo Plan eliminado satisfactoriamente.",
                    "data" => $CompolexPlan
                ]);
            }else {
                return response()->json(
                    [
                        "response" => "error",
                        "message" => "Complejo no encontrado."
                    ]
                );
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
    | Create or Update ComplexPlan Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update a ComplexPlan
    |
    */
    public function getRules() {
        return [
            'complex_id' => 'required',
            'plan_id' => 'required',
            'last_payment_at' => 'required',
            'next_payment_at' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'complex_id.required' => 'Debe elegir el Complejo al que se le asigna el Plan.',
            'plan_id.required' => 'Debe elegir el Plan que se le asignará al Complejo.',
            'last_payment_at.required' => 'Debe elegir la Fecha de Pago.',
            'next_payment_at.required' => 'Debe elegir la Fecha de Vencimiento.'
        ];
    }

}
