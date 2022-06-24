<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactSupport;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function store(ContactRequest $request)
    {
        try {

            Mail::to(config('app.supportMail'))->send(new ContactSupport($request->name, $request->email, $request->message));

            return response()->json(
                [
                'status' => true,
                "message" => "Thanks for contacting us, We will get back to you soon"
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                'status' => false,
                'message' => $e->getMessage()
                ]
            );
        }
    }

}
