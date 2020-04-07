<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News;
use Validator;

class NewsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return $this->sendResponse($news->toArray(), 'News list success!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator is error', $validator->errors(), 202);
        }
        $new = News::where('slug', str_slug($input['title']))->first();
        if (!empty($new)) {
            $input['slug'] = str_slug($input['title']."-".time());
        } else {
            $input['slug'] = str_slug($input['title']);
        }
        $news = News::create($input);
        return $this->sendResponse($news->toArray(), 'News created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = News::find($id);
        if (empty($new)) {
            return $this->sendError('New not found!');
        }
        return $this->sendResponse($new->toArray(), 'New retrieved successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
