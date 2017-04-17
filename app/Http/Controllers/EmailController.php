<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 4/17/17
 * Time: 2:44 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Show the form
     *
     * @return View
     */
    public function showForm()
    {
        return view('emails.barcode-send');
    }

    /**
     * Email the contact request
     *
     * @param ContactMeRequest $request
     * @return Redirect
     */
    public function sendContactInfo( )
    {

//        $data = $request->only('name', 'email', 'phone');
        $data['messageLines'] = ['whrbfvhljvbah','egtwgr','kregfjh'];

        $data['email'] = 'mitchell.dawkinsjr@gmail.com';
        $data['phone'] = '4077168886';
        $data['name'] = 'mitchell dawkins';
        $message = 'blank';

       Mail::send('emails.contact', $data, function($message)
        {
            $message->to('mitchell.dawkinsjr@gmail.com', 'John Smith')->subject('Welcome!');
        });

//        Mail::send('emails.contact', $data, function ($message) use ($data) {
//            $message->subject('Blog Contact Form: '.$data['name'])
//                ->to('mitchell.dawkinsjr@gmail.com')
//                ->replyTo($data['email']);
//        });

        return back()->withSuccess("Thank you for your message. It has been sent.");
    }
}
