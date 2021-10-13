<?php

namespace App\Http\Controllers;

use App\Models\AgreementPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgreementPaymentsController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Create Agreement Payment
   |--------------------------------------------------------------------------
   |   With The following JSON, you can create an Agreement Payment
   |
   |   {
   |       "agreement_id" : 1,
   |       "payment_id" : 3
   |   }
   |
   |--------------------------------------------------------------------------
   | Response Success
   |--------------------------------------------------------------------------
   |
   |    {
   |         "response": "success",
   |         "message": "Acuerdo creado satisfactoriamente.",
   |         "data": {
   |             "headers": {},
   |             "original": {
   |                 "response": "success",
   |                 "message": "Acuerdo pago recuperado satisfactoriamente.",
   |                 "data": [
   |                     {
   |                         "id": 1,
   |                         "agreement_id": 1,
   |                         "payment_id": 3,
   |                         "created_at": "2020-12-04T23:33:25.000000Z",
   |                         "updated_at": "2020-12-04T23:33:25.000000Z",
   |                         "deleted_at": null,
   |                         "payment": {
   |                             "id": 3,
   |                             "method_id": 1,
   |                             "account_id": 1,
   |                             "card_id": 1,
   |                             "provider_id": 1,
   |                             "complex_id": 2,
   |                             "property_id": 1,
   |                             "type_id": 1,
   |                             "registered_by": 1,
   |                             "cdr": "SDFGSG",
   |                             "reference": "SDFGSDFG",
   |                             "way": "1",
   |                             "month": "1",
   |                             "year": "2312",
   |                             "name": "ASDFASFA",
   |                             "description": "ASDFASDFSA",
   |                             "amount": "1234.00",
   |                             "paid": "423.00",
   |                             "fee": "23423.00",
   |                             "charge": "12331.00",
   |                             "config": null,
   |                             "receipt": "ASDFASDF",
   |                             "comments": "ASDFASDF AS DA ASDF ",
   |                             "created_at": null,
   |                             "updated_at": null,
   |                             "deleted_at": null,
   |                             "registered_at": null,
   |                             "paid_at": null,
   |                             "expired_at": null,
   |                             "withdrawal_requested_at": null,
   |                             "withdrawn_at": null,
   |                             "chargedback_at": null,
   |                             "chargeback_covered_at": null
   |                         },
   |                         "agreement": {
   |                             "id": 1,
   |                             "complex_id": 2,
   |                             "created_by": 1,
   |                             "owner_id": 2,
   |                             "occupant_id": 1,
   |                             "property_id": 1,
   |                             "name": "Pink Pop",
   |                             "description": "Lorem Ipsun Dolor",
   |                             "amount": "1000.00",
   |                             "total": "1300.00",
   |                             "document": null,
   |                             "created_at": "2020-12-04T23:32:50.000000Z",
   |                             "updated_at": "2020-12-04T23:32:50.000000Z",
   |                             "deleted_at": null
   |                         }
   |                     }
   |                 ]
   |             },
   |             "exception": null
   |         }
   |     }
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
            $AgreementPayment = AgreementPayment::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Acuerdo creado satisfactoriamente.",
                "data" => $this->getByID($AgreementPayment->id)
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
    | Get All Agreement Payments
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all Agreement Payments
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
    |                "id": 6,
    |                "agreement_id": 4,
    |                "payment_id": 16,
    |                "created_at": "2020-11-30T04:47:06.000000Z",
    |                "updated_at": "2020-11-30T04:47:06.000000Z",
    |                "deleted_at": null,
    |                "agreement": {
    |                    "id": 4,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Pink Pop",
    |                    "description": "Lorem Ipsun Dolor",
    |                    "amount": "1000.00",
    |                    "total": "1300.00",
    |                    "document": null,
    |                    "created_at": "2020-11-30T03:33:54.000000Z",
    |                    "updated_at": "2020-11-30T03:47:45.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payments": null
    |            },
    |            {
    |                "id": 7,
    |                "agreement_id": 4,
    |                "payment_id": 16,
    |                "created_at": "2020-11-30T04:49:15.000000Z",
    |                "updated_at": "2020-11-30T04:49:15.000000Z",
    |                "deleted_at": null,
    |                "agreement": {
    |                    "id": 4,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Pink Pop",
    |                    "description": "Lorem Ipsun Dolor",
    |                    "amount": "1000.00",
    |                    "total": "1300.00",
    |                    "document": null,
    |                    "created_at": "2020-11-30T03:33:54.000000Z",
    |                    "updated_at": "2020-11-30T03:47:45.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payments": null
    |            },
    |            {
    |                "id": 8,
    |                "agreement_id": 4,
    |                "payment_id": 17,
    |                "created_at": "2020-11-30T04:49:31.000000Z",
    |                "updated_at": "2020-11-30T04:49:31.000000Z",
    |                "deleted_at": null,
    |                "agreement": {
    |                    "id": 4,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Pink Pop",
    |                    "description": "Lorem Ipsun Dolor",
    |                    "amount": "1000.00",
    |                    "total": "1300.00",
    |                    "document": null,
    |                    "created_at": "2020-11-30T03:33:54.000000Z",
    |                    "updated_at": "2020-11-30T03:47:45.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payments": null
    |            },
    |            {
    |                "id": 9,
    |                "agreement_id": 4,
    |                "payment_id": 17,
    |                "created_at": "2020-11-30T04:52:46.000000Z",
    |                "updated_at": "2020-11-30T04:52:46.000000Z",
    |                "deleted_at": null,
    |                "agreement": {
    |                    "id": 4,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Pink Pop",
    |                    "description": "Lorem Ipsun Dolor",
    |                    "amount": "1000.00",
    |                    "total": "1300.00",
    |                    "document": null,
    |                    "created_at": "2020-11-30T03:33:54.000000Z",
    |                    "updated_at": "2020-11-30T03:47:45.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payments": null
    |            },
    |            {
    |                "id": 10,
    |                "agreement_id": 4,
    |                "payment_id": 17,
    |                "created_at": "2020-11-30T04:53:21.000000Z",
    |                "updated_at": "2020-11-30T04:53:21.000000Z",
    |                "deleted_at": null,
    |                "agreement": {
    |                    "id": 4,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Pink Pop",
    |                    "description": "Lorem Ipsun Dolor",
    |                    "amount": "1000.00",
    |                    "total": "1300.00",
    |                    "document": null,
    |                    "created_at": "2020-11-30T03:33:54.000000Z",
    |                    "updated_at": "2020-11-30T03:47:45.000000Z",
    |                    "deleted_at": null
    |                },
    |                "payments": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $AgreementPayments = AgreementPayment::with('agreement')
                ->with('payment')
                ->get();

            if(count($AgreementPayments) > 0) {
                return response()->json([
                    "response" => "success",
                    "message" => "Lista recuperada satisfactoriamente.",
                    "data" => $AgreementPayments
                ]);
            } else {
                return response()->json([
                    "response" => "success",
                    "message" => "No se encontraron registros.",
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
    | Get Agreement Payments by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific Agreement Payments
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the Agreement  |
    |  |            |        |          | Example : 7                       |
    |  |____________|________|__________|___________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acuerdo recuperado satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 7,
    |                "agreement_id": 5,
    |                "payment_id": 17,
    |                "created_at": "2020-11-30T04:49:15.000000Z",
    |                "updated_at": "2020-11-30T06:13:35.000000Z",
    |                "deleted_at": null,
    |                "payment": {
    |                    "id": 17,
    |                    "method_id": 1,
    |                    "account_id": 2,
    |                    "card_id": 1,
    |                    "provider_id": 1,
    |                    "complex_id": 1,
    |                    "property_id": 2,
    |                    "type_id": 1,
    |                    "registered_by": 1,
    |                    "cdr": null,
    |                    "reference": null,
    |                    "way": "1",
    |                    "month": null,
    |                    "year": null,
    |                    "name": "",
    |                    "description": "",
    |                    "amount": "0.00",
    |                    "paid": null,
    |                    "fee": null,
    |                    "charge": null,
    |                    "config": null,
    |                    "receipt": null,
    |                    "comments": null,
    |                    "created_at": null,
    |                    "updated_at": null,
    |                    "deleted_at": null,
    |                    "registered_at": null,
    |                    "paid_at": null,
    |                    "expired_at": null,
    |                    "withdrawal_requested_at": null,
    |                    "withdrawn_at": null,
    |                    "chargedback_at": null,
    |                    "chargeback_covered_at": null
    |                },
    |                "agreement": {
    |                    "id": 5,
    |                    "complex_id": 1,
    |                    "created_by": 1,
    |                    "owner_id": 2,
    |                    "occupant_id": 1,
    |                    "property_id": 2,
    |                    "name": "Masive Attack",
    |                    "description": "Lorem Ipsun Dolor",
    |                    "amount": "1000.00",
    |                    "total": "1300.00",
    |                    "document": null,
    |                    "created_at": "2020-11-30T06:04:27.000000Z",
    |                    "updated_at": "2020-11-30T06:04:27.000000Z",
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
            $AgreementPayment = AgreementPayment::find($id);

            if (is_null($AgreementPayment)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Acuerdo pago no encontrado.",
                    "data" => $AgreementPayment
                ]);
            } else {
                $AgreementPayment = $AgreementPayment->with('payment')
                        ->with('agreement')
                        ->where('id', $id)
                        ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Acuerdo pago recuperado satisfactoriamente.",
                "data" => $AgreementPayment
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
    | Update an Agreement
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update an Agreement
    |
    |    {
    |        "id" : 7,
    |        "agreement_id" : 5,
    |        "payment_id" : 17
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Acuerdo pago actualizado satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Acuerdo recuperado satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 7,
    |                        "agreement_id": 5,
    |                        "payment_id": 17,
    |                        "created_at": "2020-11-30T04:49:15.000000Z",
    |                        "updated_at": "2020-11-30T06:13:35.000000Z",
    |                        "deleted_at": null,
    |                        "payment": {
    |                            "id": 17,
    |                            "method_id": 1,
    |                            "account_id": 2,
    |                            "card_id": 1,
    |                            "provider_id": 1,
    |                            "complex_id": 1,
    |                            "property_id": 2,
    |                            "type_id": 1,
    |                            "registered_by": 1,
    |                            "cdr": null,
    |                            "reference": null,
    |                            "way": "1",
    |                            "month": null,
    |                            "year": null,
    |                            "name": "",
    |                            "description": "",
    |                            "amount": "0.00",
    |                            "paid": null,
    |                            "fee": null,
    |                            "charge": null,
    |                            "config": null,
    |                            "receipt": null,
    |                            "comments": null,
    |                            "created_at": null,
    |                            "updated_at": null,
    |                            "deleted_at": null,
    |                            "registered_at": null,
    |                            "paid_at": null,
    |                            "expired_at": null,
    |                            "withdrawal_requested_at": null,
    |                            "withdrawn_at": null,
    |                            "chargedback_at": null,
    |                            "chargeback_covered_at": null
    |                        },
    |                        "agreement": {
    |                            "id": 5,
    |                            "complex_id": 1,
    |                            "created_by": 1,
    |                            "owner_id": 2,
    |                            "occupant_id": 1,
    |                            "property_id": 2,
    |                            "name": "Masive Attack",
    |                            "description": "Lorem Ipsun Dolor",
    |                            "amount": "1000.00",
    |                            "total": "1300.00",
    |                            "document": null,
    |                            "created_at": "2020-11-30T06:04:27.000000Z",
    |                            "updated_at": "2020-11-30T06:04:27.000000Z",
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
            $AgreementPayment = AgreementPayment::findOrFail($request->id);

            $AgreementPayment->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Acuerdo pago actualizado satisafactoriamente.",
                "data" => $this->getByID($AgreementPayment->id)
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
    | Delete an Agreement Payment
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific Agreement Payment
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the            |
    |  |            |        |          | Agreement Payment                 |
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
    |        "message": "Acuerdo eliminado satisfactoriamente.",
    |        "data": {
    |            "id": 11,
    |            "agreement_id": 4,
    |            "payment_id": 16,
    |            "created_at": "2020-11-30T06:28:10.000000Z",
    |            "updated_at": "2020-11-30T06:28:10.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($agreement_id)
    {
        try {
            $AgreementPayment = AgreementPayment::find($agreement_id);


            if (!is_null($AgreementPayment)) {
                $AgreementPayment->destroy($agreement_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Acuerdo pago eliminado satisfactoriamente.",
                    "data" => $AgreementPayment
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Acuerdo pago no encontrado.",
                    "data" => $AgreementPayment
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
    | Create or Update Agreement Payments Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an Agreement
    |
    */
    public function getRules() {
        return [
            'agreement_id' => 'required|exists:agreements,id',
            'payment_id' => 'required|exists:payments,id',
        ];
    }

    public function getMessages() {
        return [
            'agreement_id.required' => 'Debe elegir un Acuerdo.',
            'agreement_id.exists' => 'No existe el Acuerdo.',
            'payment_id.required' => 'Debe elegir un Pago.',
            'payment_id.exists' => 'No existe el Pago.',
        ];
    }
}
