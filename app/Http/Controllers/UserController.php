<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'auth.admin']);
    }

    public function index()
    {
    	$users = User::paginate(5);
    	return view('user-all', compact('users'));
    }

    public function updateAccess($id)
    {
    	$user = User::find($id);
    	$user->have_access = $user->have_access ? false : true;
    	$user->save();

    	return back();
    }
}
