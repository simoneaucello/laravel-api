<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'name' => 'required|min:3|max:100',
                'email' => 'required|email',
                'message' => 'required|min:3',
            ],
            [
                'name.required' => 'Il nome è un campo obbligatorio',
                'name.min' => 'Il nome deve avere almeno :min caratteri',
                'name.max' => 'Il nome non può contenere più di :max caratteri',
                'email.required' => 'L\'email è un campo obbligatorio',
                'email.email' => 'formato email non corretto',
                'message.required' => 'Il messaggio è un campo obbligatorio',
                'message.min' => 'Il messaggio deve avere almeno :min caratteri',
            ]
        );

        if ($validator->fails()) {
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        };

        // salvo l'email nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // invio l'email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($new_lead));


        // restituisco il json con l'avvenuto invio

        $success = true;
        return response()->json(compact('success', 'errors'));
    }
}
