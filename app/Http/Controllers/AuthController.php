<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    protected $category;
    public function __construct()
    {
        $this->category = Category::where('parent_id', null)->get(); //parent_id tidak null maka diambildatanya
    }
    public function register()
    {
        $category = $this->category;
        return view('homepage.register', compact('category'));
    }

    protected function store(Request $data)
    {
        $mydata =[
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ];
        User::create($mydata);
        Alert::success(' ', 'Pendaftaran  Berhasil!');

        return redirect('/');
    }
}
