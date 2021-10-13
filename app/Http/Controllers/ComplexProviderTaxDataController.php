<?php

namespace App\Http\Controllers;

use App\Models\ProviderTaxData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplexProviderTaxDataController extends Controller
{
    /*
    |
    |--------------------------------------------------------------------------
    | Create Provider Tax Data
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create Provider Tax Data
    |
    |   {
    |        "provider_id" : 1,
    |        "rfc" : "LOOC790119938",
    |        "name" : "P.J. Harvey",
    |        "address" : "Lorem Ipsum Dolor",
    |        "postal_code" : "71350"
    |    }
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Datos Fiscales creados satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos Fiscales recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "provider_id": 1,
    |                        "rfc": "LOOC790119938",
    |                        "name": "P.J. Harvey",
    |                        "address": "Lorem Ipsum Dolor",
    |                        "postal_code": "71350",
    |                        "created_at": "2020-12-03T21:50:27.000000Z",
    |                        "updated_at": "2020-12-03T21:50:27.000000Z",
    |                        "deleted_at": null,
    |                        "provider": {
    |                            "id": 1,
    |                            "category_id": 1,
    |                            "company": "Murder Ballads",
    |                            "contact_names": "Nick Polly",
    |                            "contact_surnames": "Cave Harvey",
    |                            "email": "herny@lee.cav",
    |                            "phone": "44888521156",
    |                            "mobile": "987321542",
    |                            "created_at": "2020-12-03T12:49:29.000000Z",
    |                            "updated_at": "2020-12-03T12:49:29.000000Z",
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
            $ProviderTaxData = ProviderTaxData::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Datos Fiscales creados satisfactoriamente.",
                "data" => $this->getByID($ProviderTaxData->id)
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
    | Get All Provider Tax Data
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Provider Tax Data
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
    |                "provider_id": 1,
    |                "rfc": "LOOC790119938",
    |                "name": "P.J. Harvey",
    |                "address": "Lorem Ipsum Dolor",
    |                "postal_code": "71350",
    |                "created_at": "2020-12-03T21:48:14.000000Z",
    |                "updated_at": "2020-12-03T21:48:14.000000Z",
    |                "deleted_at": null,
    |                "provider": {
    |                    "id": 1,
    |                    "category_id": 1,
    |                    "company": "Murder Ballads",
    |                    "contact_names": "Nick Polly",
    |                    "contact_surnames": "Cave Harvey",
    |                    "email": "herny@lee.cav",
    |                    "phone": "44888521156",
    |                    "mobile": "987321542",
    |                    "created_at": "2020-12-03T12:49:29.000000Z",
    |                    "updated_at": "2020-12-03T12:49:29.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "provider_id": 1,
    |                "rfc": "LOOC790119938",
    |                "name": "P.J. Harvey",
    |                "address": "Lorem Ipsum Dolor",
    |                "postal_code": "71350",
    |                "created_at": "2020-12-03T21:50:27.000000Z",
    |                "updated_at": "2020-12-03T21:50:27.000000Z",
    |                "deleted_at": null,
    |                "provider": {
    |                    "id": 1,
    |                    "category_id": 1,
    |                    "company": "Murder Ballads",
    |                    "contact_names": "Nick Polly",
    |                    "contact_surnames": "Cave Harvey",
    |                    "email": "herny@lee.cav",
    |                    "phone": "44888521156",
    |                    "mobile": "987321542",
    |                    "created_at": "2020-12-03T12:49:29.000000Z",
    |                    "updated_at": "2020-12-03T12:49:29.000000Z",
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
            $ProviderTaxData = ProviderTaxData::with('provider')->get();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $ProviderTaxData
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
    | Get Provider Tax Data by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Provider Tax Data
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                           |
    |  |-------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the Provider   |
    |  |            |        |         | Tax Data. Example : 1             |
    |  |____________|________|_________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Datos Fiscales recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 1,
    |                "provider_id": 1,
    |                "rfc": "LOOC790119938",
    |                "name": "P.J. Harvey",
    |                "address": "Lorem Ipsum Dolor",
    |                "postal_code": "71350",
    |                "created_at": "2020-12-03T21:48:14.000000Z",
    |                "updated_at": "2020-12-03T21:48:14.000000Z",
    |                "deleted_at": null,
    |                "provider": {
    |                    "id": 1,
    |                    "category_id": 1,
    |                    "company": "Murder Ballads",
    |                    "contact_names": "Nick Polly",
    |                    "contact_surnames": "Cave Harvey",
    |                    "email": "herny@lee.cav",
    |                    "phone": "44888521156",
    |                    "mobile": "987321542",
    |                    "created_at": "2020-12-03T12:49:29.000000Z",
    |                    "updated_at": "2020-12-03T12:49:29.000000Z",
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
            $ProviderTaxData = ProviderTaxData::find($id);

            if (is_null($ProviderTaxData)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Datos Fiscales no encontrada.",
                    "data" => $ProviderTaxData
                ]);
            } else {
                $ProviderTaxData = $ProviderTaxData
                    ->with('provider')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Datos Fiscales recuperada satisfactoriamente.",
                "data" => $ProviderTaxData
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
    | Update Provider Tax Data
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update Provider Tax Data
    |
    |   {
    |        "id": 2,
    |        "provider_id" : 1,
    |        "rfc" : "LOOC790118947",
    |        "name" : "Polly Harvey",
    |        "address" : "Lorem Ipsum Dolor",
    |        "postal_code" : "98981"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Datos Fiscales actualizados satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Datos Fiscales recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "provider_id": 1,
    |                        "rfc": "LOOC790118947",
    |                        "name": "Polly Harvey",
    |                        "address": "Lorem Ipsum Dolor",
    |                        "postal_code": "98981",
    |                        "created_at": "2020-12-03T21:50:27.000000Z",
    |                        "updated_at": "2020-12-03T21:57:14.000000Z",
    |                        "deleted_at": null,
    |                        "provider": {
    |                            "id": 1,
    |                            "category_id": 1,
    |                            "company": "Murder Ballads",
    |                            "contact_names": "Nick Polly",
    |                            "contact_surnames": "Cave Harvey",
    |                            "email": "herny@lee.cav",
    |                            "phone": "44888521156",
    |                            "mobile": "987321542",
    |                            "created_at": "2020-12-03T12:49:29.000000Z",
    |                            "updated_at": "2020-12-03T12:49:29.000000Z",
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
            $ProviderTaxData = ProviderTaxData::findOrFail($request->id);

            $ProviderTaxData->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Datos Fiscales actualizados satisafactoriamente.",
                "data" => $this->getByID($ProviderTaxData->id)
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
    | Delete Provider Tax Data
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Provider Tax Data
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Provider   |
    |  |            |        |          | Tax Data. Example : 2             |
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
    |        "message": "Datos Fiscales eliminados satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "provider_id": 1,
    |            "rfc": "LOOC790118947",
    |            "name": "Polly Harvey",
    |            "address": "Lorem Ipsum Dolor",
    |            "postal_code": "98981",
    |            "created_at": "2020-12-03T21:50:27.000000Z",
    |            "updated_at": "2020-12-03T21:57:14.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($provider_taxdata_id)
    {
        try {
            $ProviderTaxData = ProviderTaxData::find($provider_taxdata_id);


            if (!is_null($ProviderTaxData)) {
                $ProviderTaxData->destroy($provider_taxdata_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Datos Fiscales eliminados satisfactoriamente.",
                    "data" => $ProviderTaxData
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Datos Fiscales no encontrados.",
                    "data" => $ProviderTaxData
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
    | Create or Update Accounts Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update Provider Tax Data
    |
    */
    public function getRules() {
        return [
            'provider_id' => 'required',
            'rfc' => 'required',
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ];
    }

    public function getMessages() {
        return [
            'provider_id.required' => 'Debe elegir un Proveedor.',
            'provider_id.exists' => 'No existe el Proveedir.',
            'rfc.required' => 'Debe escribir un R.F.C.',
            'name.required' => 'Debe escribir un Nombre.',
            'address.required' => 'Debe escribir una presentación.',
            'postal_code' => 'Debe escribir un Código Postal.',
        ];
    }
}
