<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class UserController extends Controller {
    /**
     * Show users
     */
    public function showUsers() {
        return view('backend.user.index');
    }

    /**
     * New user
     */
    public function newUser() {
        return view('backend.user.new');
    }
}