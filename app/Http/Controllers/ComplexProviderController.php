<?php

namespace App\Http\Controllers;

use App\Models\ComplexProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexProviderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
| Create Account
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create an Account
    |
    |   {
    |        "category_id" : 1,
    |        "company" : "GMS",
    |        "contact_names" : "Rinka",
    |        "contact_surnames" : "Dink",
    |        "email" : "edv@google.com" ,
    |        "phone" : "0234798234",
    |        "mobile" : "192038492"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Proveedor para el Complejo creado satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Proveedor para el Complejo recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 3,
    |                        "category_id": 1,
    |                        "company": "GMS",
    |                        "contact_names": "Rinka",
    |                        "contact_surnames": "Dink",
    |                        "email": "edv@google.com",
    |                        "phone": "0234798234",
    |                        "mobile": "192038492",
    |                        "created_at": "2020-12-04T00:50:19.000000Z",
    |                        "updated_at": "2020-12-04T00:50:19.000000Z",
    |                        "deleted_at": null,
    |                        "category": {
    |                            "id": 1,
    |                            "name": "Set Mee Free",
    |                            "description": "Free Set Data",
    |                            "created_at": "2020-12-03T12:49:24.000000Z",
    |                            "updated_at": "2020-12-03T12:49:24.000000Z",
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
            $Account = ComplexProvider::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Proveedor para el Complejo creado satisfactoriamente.",
                "data" => $this->getByID($Account->id)
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
    | Get All Complex Providers
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Agreements
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
    |                "category_id": 1,
    |                "company": "Murder Ballads",
    |                "contact_names": "Nick Polly",
    |                "contact_surnames": "Cave Harvey",
    |                "email": "herny@lee.cav",
    |                "phone": "44888521156",
    |                "mobile": "987321542",
    |                "created_at": "2020-12-03T12:49:29.000000Z",
    |                "updated_at": "2020-12-03T12:49:29.000000Z",
    |                "deleted_at": null,
    |                "category": {
    |                    "id": 1,
    |                    "name": "Set Mee Free",
    |                    "description": "Free Set Data",
    |                    "created_at": "2020-12-03T12:49:24.000000Z",
    |                    "updated_at": "2020-12-03T12:49:24.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "category_id": 1,
    |                "company": "GMS",
    |                "contact_names": "Rinka",
    |                "contact_surnames": "Dink",
    |                "email": "edv@google.com",
    |                "phone": "0234798234",
    |                "mobile": "192038492",
    |                "created_at": "2020-12-04T00:44:45.000000Z",
    |                "updated_at": "2020-12-04T00:44:45.000000Z",
    |                "deleted_at": null,
    |                "category": {
    |                    "id": 1,
    |                    "name": "Set Mee Free",
    |                    "description": "Free Set Data",
    |                    "created_at": "2020-12-03T12:49:24.000000Z",
    |                    "updated_at": "2020-12-03T12:49:24.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 3,
    |                "category_id": 1,
    |                "company": "GMS",
    |                "contact_names": "Rinka",
    |                "contact_surnames": "Dink",
    |                "email": "edv@google.com",
    |                "phone": "0234798234",
    |                "mobile": "192038492",
    |                "created_at": "2020-12-04T00:50:19.000000Z",
    |                "updated_at": "2020-12-04T00:50:19.000000Z",
    |                "deleted_at": null,
    |                "category": {
    |                    "id": 1,
    |                    "name": "Set Mee Free",
    |                    "description": "Free Set Data",
    |                    "created_at": "2020-12-03T12:49:24.000000Z",
    |                    "updated_at": "2020-12-03T12:49:24.000000Z",
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
            $agreements = ComplexProvider::with('category')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $agreements
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
    | Get Complex Provider by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Complex Provider
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the Complex    |
    |  |            |        |          | ProviderExample : 1               |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    | --------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Proveedor para el Complejo recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "category_id": 1,
    |                "company": "Murder Ballads",
    |                "contact_names": "Nick Polly",
    |                "contact_surnames": "Cave Harvey",
    |                "email": "herny@lee.cav",
    |                "phone": "44888521156",
    |                "mobile": "987321542",
    |                "created_at": "2020-12-03T12:49:29.000000Z",
    |                "updated_at": "2020-12-03T12:49:29.000000Z",
    |                "deleted_at": null,
    |                "category": {
    |                    "id": 1,
    |                    "name": "Set Mee Free",
    |                    "description": "Free Set Data",
    |                    "created_at": "2020-12-03T12:49:24.000000Z",
    |                    "updated_at": "2020-12-03T12:49:24.000000Z",
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
            $ComplexProvider = ComplexProvider::find($id);

            if (is_null($ComplexProvider)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Proveedor para el Complejo no encontrado.",
                    "data" => $ComplexProvider
                ]);
            } else {
                $ComplexProvider = $ComplexProvider
                    ->with('category')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Proveedor para el Complejo recuperado satisfactoriamente.",
                "data" => $ComplexProvider
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
    | Update Complex Provider
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Complex Provider
    |
    |   {
    |        "id" : 1,
    |        "category_id" : 1,
    |        "company" : "GMS",
    |        "contact_names" : "Zentura",
    |        "contact_surnames" : "Raja Ram",
    |        "email" : "edv@google.com" ,
    |        "phone" : "0234798234",
    |        "mobile" : "192038492"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Proveedor para el Complejo actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Proveedor para el Complejo recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 1,
    |                        "category_id": 1,
    |                        "company": "GMS",
    |                        "contact_names": "Zentura",
    |                        "contact_surnames": "Raja Ram",
    |                        "email": "edv@google.com",
    |                        "phone": "0234798234",
    |                        "mobile": "192038492",
    |                        "created_at": "2020-12-03T12:49:29.000000Z",
    |                        "updated_at": "2020-12-04T00:56:09.000000Z",
    |                        "deleted_at": null,
    |                        "category": {
    |                            "id": 1,
    |                            "name": "Set Mee Free",
    |                            "description": "Free Set Data",
    |                            "created_at": "2020-12-03T12:49:24.000000Z",
    |                            "updated_at": "2020-12-03T12:49:24.000000Z",
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
            $ComplexProvider = ComplexProvider::findOrFail($request->id);

            $ComplexProvider->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Proveedor para el Complejo actualizado satisafactoriamente.",
                "data" => $this->getByID($ComplexProvider->id)
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
    | Delete Complex Provider
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Complex Provider
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Account    |
    |  |            |        |          | Example : 3                       |
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
    |        "message": "Proveedor para el Complejo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 3,
    |            "category_id": 1,
    |            "company": "GMS",
    |            "contact_names": "Rinka",
    |            "contact_surnames": "Dink",
    |            "email": "edv@google.com",
    |            "phone": "0234798234",
    |            "mobile": "192038492",
    |            "created_at": "2020-12-04T00:50:19.000000Z",
    |            "updated_at": "2020-12-04T00:50:19.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($complex_provider_id)
    {
        try {
            $ComplexProvider = ComplexProvider::find($complex_provider_id);

            if (!is_null($ComplexProvider)) {
                $ComplexProvider->destroy($complex_provider_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Proveedor para el Complejo eliminado satisfactoriamente.",
                    "data" => $ComplexProvider
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $ComplexProvider
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
    | Create or Update Complex Providers Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Complex Providers
    |
    */
    public function getRules() {
        return [
            'category_id' => 'required|exists:complex_provider_categories,id',
            'company' => 'required',
            'contact_names' => 'required',
            'contact_surnames' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'category_id.required' => 'Debe elegir una Categoría.',
            'category_id.exists' => 'No existe la Categoría.',
            'company.required' => 'Debe escribir la Compañía.',
            'contact_names.required' => 'Debe escribir Nombre(s) de contacto.',
            'contact_surnames.required' => 'Debe escribir Apellido(s) de contacto.',
            'email.required' => 'Debe escribir un correo.',
            'phone.required' => 'Debe escribir un Teléfono Fijo.',
            'mobile.required' => 'Debe escribir un Teléfono Celular.',
        ];
    }
}
