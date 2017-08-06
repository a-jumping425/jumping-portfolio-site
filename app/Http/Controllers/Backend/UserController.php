<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Save user
     */
    public function saveUser(Request $request) {
        $id = Input::get('id', 0);
        $profile = Input::get('profile', 0);
        if( $id ) {  // Update
            $userClass = User::find($id);
            $userClass->enable = Input::get('enable');
            if (Input::get('password'))
                $userClass->password = Hash::make( Input::get('password') );
        } else {    // New
            $userClass = new User();
            $userClass->password = Hash::make( Input::get('password') );
        }

        // Save thumbnail
        if ($request->file('avatar')) {
            $path = Storage::disk('public')->putFile('user_avatars', $request->file('avatar'));
            $userClass->avatar = $path;
            $url = Storage::disk('public')->url($path);
            $userClass->avatar_url = $url;
        }

        $userClass->first_name = Input::get('first_name');
        $userClass->last_name = Input::get('last_name');
        $userClass->username = Input::get('username');
        $userClass->email = Input::get('email');
        $userClass->user_level = Input::get('role');
        $userClass->save();

        if ($profile)
            return redirect('user/profile');
        else
            return redirect('users');
    }
}