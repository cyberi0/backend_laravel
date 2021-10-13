<?php

namespace App\Http\Controllers;

use App\Models\NewsViews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsViewsController extends Controller
{
    /*
    |
    |--------------------------------------------------------------------------
    | Create News Views
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create News Views
    |
    |   {
    |        "news_id" : 1,
    |        "property_id" : 1,
    |        "owner_id" : 1,
    |        "occupant_id" : 2
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |    {
    |        "response": "success",
    |        "message": "Cuenta creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 5,
    |                        "news_id": 1,
    |                        "property_id": 1,
    |                        "owner_id": 1,
    |                        "occupant_id": 2,
    |                        "created_at": "2020-12-04T22:36:39.000000Z",
    |                        "updated_at": "2020-12-04T22:36:39.000000Z",
    |                        "deleted_at": null,
    |                        "news": {
    |                            "id": 1,
    |                            "title": "Massive Attack",
    |                            "content": "Lorem Ipsum Dolor1",
    |                            "cover": "Lorem Ipsum Dolor2",
    |                            "thumb": "Lorem Ipsum Dolor3",
    |                            "views": 1,
    |                            "expires_at": "2021-01-05",
    |                            "created_at": "2020-12-04T19:15:27.000000Z",
    |                            "updated_at": "2020-12-04T19:15:27.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "property": {
    |                            "id": 1,
    |                            "title": "Massive Attack",
    |                            "content": "Lorem Ipsum Dolor1",
    |                            "cover": "Lorem Ipsum Dolor2",
    |                            "thumb": "Lorem Ipsum Dolor3",
    |                            "views": 1,
    |                            "expires_at": "2021-01-05",
    |                            "created_at": "2020-12-04T19:15:27.000000Z",
    |                            "updated_at": "2020-12-04T19:15:27.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "owner": {
    |                            "id": 1,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Carlos",
    |                            "surnames": "Laravel",
    |                            "username": "develop2",
    |                            "email": "develop2@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "occupant": {
    |                            "id": 2,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Jorge",
    |                            "surnames": "Laravel",
    |                            "username": "develop1",
    |                            "email": "develop1@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
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
            $NewsViews = NewsViews::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Cuenta creada satisfactoriamente.",
                "data" => $this->getByID($NewsViews->id)
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
    | Get All News Views
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all News Views
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
    |                "news_id": 1,
    |                "property_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "created_at": "2020-12-04T21:58:10.000000Z",
    |                "updated_at": "2020-12-04T21:58:10.000000Z",
    |                "deleted_at": null,
    |                "news": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "occupant": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 2,
    |                "news_id": 1,
    |                "property_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "created_at": "2020-12-04T22:27:42.000000Z",
    |                "updated_at": "2020-12-04T22:27:42.000000Z",
    |                "deleted_at": null,
    |                "news": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "occupant": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 3,
    |                "news_id": 1,
    |                "property_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "created_at": "2020-12-04T22:30:56.000000Z",
    |                "updated_at": "2020-12-04T22:30:56.000000Z",
    |                "deleted_at": null,
    |                "news": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "occupant": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 4,
    |                "news_id": 1,
    |                "property_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "created_at": "2020-12-04T22:31:23.000000Z",
    |                "updated_at": "2020-12-04T22:31:23.000000Z",
    |                "deleted_at": null,
    |                "news": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "occupant": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                }
    |            },
    |            {
    |                "id": 5,
    |                "news_id": 1,
    |                "property_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "created_at": "2020-12-04T22:36:39.000000Z",
    |                "updated_at": "2020-12-04T22:36:39.000000Z",
    |                "deleted_at": null,
    |                "news": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "occupant": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
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
            $agreements = NewsViews::with('news')
                ->with('property')
                ->with('owner')
                ->with('occupant')->get();
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
    | Get News View by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific News View
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required | Details                            |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	   | Indicate the ID of the News View   |
    |  |            |        |         | Example : 2                        |
    |  |____________|________|_________|____________________________________|
    |
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuenta recuperada satisfactoriamente.",
    |        "data": [
    |            {
    |                "id": 2,
    |                "news_id": 1,
    |                "property_id": 1,
    |                "owner_id": 1,
    |                "occupant_id": 2,
    |                "created_at": "2020-12-04T22:27:42.000000Z",
    |                "updated_at": "2020-12-04T22:27:42.000000Z",
    |                "deleted_at": null,
    |                "news": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "property": {
    |                    "id": 1,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor1",
    |                    "cover": "Lorem Ipsum Dolor2",
    |                    "thumb": "Lorem Ipsum Dolor3",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:15:27.000000Z",
    |                    "updated_at": "2020-12-04T19:15:27.000000Z",
    |                    "deleted_at": null
    |                },
    |                "owner": {
    |                    "id": 1,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Carlos",
    |                    "surnames": "Laravel",
    |                    "username": "develop2",
    |                    "email": "develop2@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
    |                    "deleted_at": null
    |                },
    |                "occupant": {
    |                    "id": 2,
    |                    "user_id": null,
    |                    "type_id": null,
    |                    "created_by": null,
    |                    "names": "Jorge",
    |                    "surnames": "Laravel",
    |                    "username": "develop1",
    |                    "email": "develop1@wobisoft.com",
    |                    "mobile": "9797968543",
    |                    "curp": null,
    |                    "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                    "created_at": "2020-11-24T23:09:39.000000Z",
    |                    "updated_at": "2020-11-24T23:09:39.000000Z",
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
            $NewsView = NewsViews::find($id);

            if (is_null($NewsView)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $NewsView
                ]);
            } else {
                $NewsView = $NewsView
                    ->with('news')
                    ->with('property')
                    ->with('owner')
                    ->with('occupant')
                    ->where('id', $id)
                    ->get();
            }

            return response()->json([
                "response" => "success",
                "message" => "Cuenta recuperada satisfactoriamente.",
                "data" => $NewsView
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
    | Update News Views
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update News Views
    |
    |   {
    |        "id" : 2,
    |        "news_id" : 1,
    |        "property_id" : 1,
    |        "owner_id" : 2,
    |        "occupant_id" : 1
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Cuenta actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Cuenta recuperada satisfactoriamente.",
    |                "data": [
    |                    {
    |                        "id": 2,
    |                        "news_id": 1,
    |                        "property_id": 1,
    |                        "owner_id": 2,
    |                        "occupant_id": 1,
    |                        "created_at": "2020-12-04T22:27:42.000000Z",
    |                        "updated_at": "2020-12-04T22:42:16.000000Z",
    |                        "deleted_at": null,
    |                        "news": {
    |                            "id": 1,
    |                            "title": "Massive Attack",
    |                            "content": "Lorem Ipsum Dolor1",
    |                            "cover": "Lorem Ipsum Dolor2",
    |                            "thumb": "Lorem Ipsum Dolor3",
    |                            "views": 1,
    |                            "expires_at": "2021-01-05",
    |                            "created_at": "2020-12-04T19:15:27.000000Z",
    |                            "updated_at": "2020-12-04T19:15:27.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "property": {
    |                            "id": 1,
    |                            "title": "Massive Attack",
    |                            "content": "Lorem Ipsum Dolor1",
    |                            "cover": "Lorem Ipsum Dolor2",
    |                            "thumb": "Lorem Ipsum Dolor3",
    |                            "views": 1,
    |                            "expires_at": "2021-01-05",
    |                            "created_at": "2020-12-04T19:15:27.000000Z",
    |                            "updated_at": "2020-12-04T19:15:27.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "owner": {
    |                            "id": 2,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Jorge",
    |                            "surnames": "Laravel",
    |                            "username": "develop1",
    |                            "email": "develop1@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        },
    |                        "occupant": {
    |                            "id": 1,
    |                            "user_id": null,
    |                            "type_id": null,
    |                            "created_by": null,
    |                            "names": "Carlos",
    |                            "surnames": "Laravel",
    |                            "username": "develop2",
    |                            "email": "develop2@wobisoft.com",
    |                            "mobile": "9797968543",
    |                            "curp": null,
    |                            "email_verified_at": "2020-11-24T23:09:39.000000Z",
    |                            "created_at": "2020-11-24T23:09:39.000000Z",
    |                            "updated_at": "2020-11-24T23:09:39.000000Z",
    |                            "deleted_at": null
    |                        }
    |                    }
    |                ]
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
            $NewsViews = NewsViews::findOrFail($request->id);

            $NewsViews->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Cuenta actualizada satisafactoriamente.",
                "data" => $this->getByID($NewsViews->id)
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
    | Delete News Views
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific News View
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter	| Kind	 | Required | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id    	| number | True	    | Indicate the ID of the News View  |
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
    |        "message": "Cuenta eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 1,
    |            "news_id": 1,
    |            "property_id": 1,
    |            "owner_id": 1,
    |            "occupant_id": 2,
    |            "created_at": "2020-12-04T21:58:10.000000Z",
    |            "updated_at": "2020-12-04T21:58:10.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    */
    public function delete($account_id)
    {
        try {
            $NewsViews = NewsViews::find($account_id);


            if (!is_null($NewsViews)) {
                $NewsViews->destroy($account_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Cuenta eliminada satisfactoriamente.",
                    "data" => $NewsViews
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Cuenta no encontrada.",
                    "data" => $NewsViews
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
    | Create or Update News Views Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update an News View
    |
    */
    public function getRules() {
        return [
            "news_id" => "required|exists:news,id",
            "property_id" => "required|exists:properties,id",
            "owner_id" => "required|exists:users,id",
            "occupant_id" => "required|exists:users,id"
        ];
    }

    public function getMessages() {
        return [
            "news_id.required" => "Debe elegir una Noticia",
            "news_id.exists" => "La Noticia no existe",
            "property_id.required" => "Debe elegir una Propiedad",
            "property_id.exists" => "La Propiedad no existe",
            "owner_id.required" => "Debe elegir un Propietario",
            "owner_id.exists" => "El Propietario no existe",
            "occupant_id.required" => "Debe elegir un Ocupante",
            "occupant_id.exists" => "El Ocupante no existe"
        ];
    }
}
