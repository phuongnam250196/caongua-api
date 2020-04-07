<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Contact;
use Validator;

class ContactController extends BaseController
{

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
            'name' => 'required',
            'email' => 'required | email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator is error', $validator->errors(), 202);
        }
        $contact = Contact::create($input);
        return $this->sendResponse($contact->toArray(), 'Contact created successfully!');
    }
}
