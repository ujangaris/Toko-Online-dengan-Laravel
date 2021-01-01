<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.user.index', compact('user'));
    }
}
