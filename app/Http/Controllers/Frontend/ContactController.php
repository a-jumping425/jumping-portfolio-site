<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactToAdmin;
use App\Mail\ContactToUser;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {
    public function index() {
        return view('frontend.contact');
    }

    public function thank_you() {
        return view('frontend.contact', ['success' => 1]);
    }

    public function send() {
        $email = Input::get('email');

        // to admin
        Mail::to('a.jumping425@gmail.com')
            ->send(new ContactToAdmin());

        // to user
        Mail::to($email)
            ->send(new ContactToUser());

        return redirect('contact/thank-you');
    }
}