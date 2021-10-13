<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /*
    |
    |--------------------------------------------------------------------------
    | Create News
    |--------------------------------------------------------------------------
    |   With The following JSON, you can create News
    |
    |   {
    |        "title" : "Massive Attack",
    |        "content" :"Lorem Ipsum Dolor",
    |        "cover" : "Lorem Ipsum Dolor",
    |        "thumb" : "Lorem Ipsum Dolor",
    |        "views" : 1,
    |        "expires_at" : "2021-01-05 10:00:00"
    |    }
    |
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |   {
    |        "response": "success",
    |        "message": "Noticia creada satisfactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Noticia recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "title": "Massive Attack",
    |                    "content": "Lorem Ipsum Dolor",
    |                    "cover": "Lorem Ipsum Dolor",
    |                    "thumb": "Lorem Ipsum Dolor",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:23:56.000000Z",
    |                    "updated_at": "2020-12-04T19:23:56.000000Z",
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
            $New = News::create($input);
            return response()->json([
                "response" => "success",
                "message" => "Noticia creada satisfactoriamente.",
                "data" => $this->getByID($New->id)
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
    | Get All News
    |--------------------------------------------------------------------------
    |   With The following Service, you can get all News
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
    |                "title": "Massive Attack",
    |                "content": "Lorem Ipsum Dolor1",
    |                "cover": "Lorem Ipsum Dolor2",
    |                "thumb": "Lorem Ipsum Dolor3",
    |                "views": 1,
    |                "expires_at": "2021-01-05",
    |                "created_at": "2020-12-04T19:15:27.000000Z",
    |                "updated_at": "2020-12-04T19:15:27.000000Z",
    |                "deleted_at": null
    |            },
    |            {
    |                "id": 2,
    |                "title": "Massive Attack",
    |                "content": "Lorem Ipsum Dolor",
    |                "cover": "Lorem Ipsum Dolor",
    |                "thumb": "Lorem Ipsum Dolor",
    |                "views": 1,
    |                "expires_at": "2021-01-05",
    |                "created_at": "2020-12-04T19:23:56.000000Z",
    |                "updated_at": "2020-12-04T19:23:56.000000Z",
    |                "deleted_at": null
    |            }
    |        ]
    |    }
    |
    |
    */
    public function getAll() {
        try {
            $News = News::all();
            return response()->json([
                "response" => "success",
                "message" => "Lista recuperada satisfactoriamente.",
                "data" => $News
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
    | Get News by ID
    |--------------------------------------------------------------------------
    |   With this service you can get an specific News
    |   using the following parameter:
    |
    |   ____________________________________________________________________
    |  | Parameter  | Kind	| Required  | Details                           |
    |  |--------------------------------------------------------------------|
    |  |    id      | number | True	    | Indicate the ID of the New        |
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
    |        "message": "Noticia recuperada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "title": "Massive Attack",
    |            "content": "Lorem Ipsum Dolor",
    |            "cover": "Lorem Ipsum Dolor",
    |            "thumb": "Lorem Ipsum Dolor",
    |            "views": 1,
    |            "expires_at": "2021-01-05",
    |            "created_at": "2020-12-04T19:23:56.000000Z",
    |            "updated_at": "2020-12-04T19:23:56.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function getByID($id) {
        try{
            $New = News::find($id);

            if (is_null($New)) {
                return response()->json([
                    "response" => "error",
                    "message" => "Noticia no encontrada.",
                    "data" => $New
                ]);
            }

            return response()->json([
                "response" => "success",
                "message" => "Noticia recuperada satisfactoriamente.",
                "data" => $New
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
    | Update a New
    |--------------------------------------------------------------------------
    |   With The following JSON, you can update a New
    |
    |   {
    |        "id" : 2,
    |        "title" : "Massive Attack MX",
    |        "content" :"Lorem Ipsum Dolor",
    |        "cover" : "Lorem Ipsum Dolor",
    |        "thumb" : "Lorem Ipsum Dolor",
    |        "views" : 1,
    |        "expires_at" : "2021-01-05 10:00:00"
    |    }
    |--------------------------------------------------------------------------
    | Response Success
    |--------------------------------------------------------------------------
    |
    |   {
    |        "response": "success",
    |        "message": "Noticia actualizada satisafactoriamente.",
    |        "data": {
    |            "headers": {},
    |            "original": {
    |                "response": "success",
    |                "message": "Noticia recuperada satisfactoriamente.",
    |                "data": {
    |                    "id": 2,
    |                    "title": "Massive Attack MX",
    |                    "content": "Lorem Ipsum Dolor",
    |                    "cover": "Lorem Ipsum Dolor",
    |                    "thumb": "Lorem Ipsum Dolor",
    |                    "views": 1,
    |                    "expires_at": "2021-01-05",
    |                    "created_at": "2020-12-04T19:23:56.000000Z",
    |                    "updated_at": "2020-12-04T19:30:40.000000Z",
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
            $New = News::findOrFail($request->id);

            $New->fill($input)->save();

            return response()->json([
                "response" => "success",
                "message" => "Noticia actualizada satisafactoriamente.",
                "data" => $this->getByID($New->id)
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
    | Delete a New
    |--------------------------------------------------------------------------
    |   With this service you can delete an specific New
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
    |        "message": "Noticia eliminada satisfactoriamente.",
    |        "data": {
    |            "id": 2,
    |            "title": "Massive Attack MX",
    |            "content": "Lorem Ipsum Dolor",
    |            "cover": "Lorem Ipsum Dolor",
    |            "thumb": "Lorem Ipsum Dolor",
    |            "views": 1,
    |            "expires_at": "2021-01-05",
    |            "created_at": "2020-12-04T19:23:56.000000Z",
    |            "updated_at": "2020-12-04T19:30:40.000000Z",
    |            "deleted_at": null
    |        }
    |    }
    |
    |
    */
    public function delete($new_id)
    {
        try {
            $New = News::find($new_id);


            if (!is_null($New)) {
                $New->destroy($new_id);
                return response()->json([
                    "response" => "success",
                    "message" => "Noticia eliminada satisfactoriamente.",
                    "data" => $New
                ]);
            } else {
                return response()->json([
                    "response" => "error",
                    "message" => "Noticia no encontrada.",
                    "data" => $New
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
    | Create or Update News Validations
    |--------------------------------------------------------------------------
    |   With The following methods just get de rules and custom messages
    |    for validations when you create or update News
    |
    */
    public function getRules() {
        return [
            'title' => 'required',
            'content' => 'required',
            'cover' => 'required',
            'thumb' => 'required',
            'views' => 'required',
            'expires_at' => 'required'
        ];
    }

    public function getMessages() {
        return [
            'title.required' => 'Debe escribir un Título',
            'content.required' => 'Debe escribir un Contenido',
            'cover.required' => 'Debe enviar un Cover',
            'thumb.required' => 'Debe enviar un Thumb',
            'views.required' => 'Debe enviar una Noticia',
            'expires_at.required' => 'Debe seleccionar una Fecha de Vencimiento',
        ];
    }
}
