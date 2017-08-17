<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            if (Input::get('active') !== false)
                $userClass->active = Input::get('active');
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
        if (Input::get('role'))
            $userClass->user_level = Input::get('role');
        $userClass->save();

        if ($profile)
            return redirect('user/profile');
        else
            return redirect('users');
    }

    /**
     * Get users
     */
    public function getUsers() {
        $data = [];

        $rows = User::orderBy('created_at', 'desc')
            ->get();
        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->DT_RowData = ['id' => $row->id];
            if ($row->avatar_url) {
                $row->thumbnail = '<img class="thumbnail" src="'. $row->avatar_url .'" />';
            }
            $row->name = $row->first_name .' '. $row->last_name;
            $row->active = $row->active ? '<span class="label label-sm label-success"> Yes </span>' : '<span class="label label-sm label-danger"> No </span>';
            $row->role = ($row->user_level == 1) ? ' Administrator ' : ' User ';
        }
        $data['data'] = $rows;

        return response()->json($data);
    }

    /**
     * Edit user
     */
    public function editUser($id) {
        // Get user
        $user = User::find($id);

        return view('backend.user.edit', ['user' => $user]);
    }

    /**
     * Delete user
     */
    public function deleteUser($id) {
        // Get data in database
        $obj = User::find($id);

        // Remove avatar
        if ($obj->avatar) {
            Storage::disk('public')->delete($obj->avatar);
        }

        // Remove data in database
        User::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * User profile
     */
    public function userProfile() {
        $id = Auth::id();

        // Get user
        $user = User::find($id);

        return view('backend.user.profile', ['user' => $user]);
    }
}