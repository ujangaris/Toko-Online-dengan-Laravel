<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
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
        $remember_token= base64_encode($data['email']);
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
            'remember_token' => $remember_token,
        ];
        User::create($mydata);
        Mail::send('home', array('firstname' => $data['name'], 'remember_token' => $remember_token), function($pesan) use ($data){
            $pesan->to($data['email'], 'Verifikasi')->subject('Verifikasi Email');
            $pesan->from('ujangaja@gmail.com', 'Verifikasi Akun Email Anda');
        });
        Alert::success(' ', 'Pendaftaran  Berhasil!');

        return redirect('/');
    }

    public function verif($token)
    {
        $user = User::where('remember_token', $token)->first();
        if($user->status == "0"){
            $user->status = "1";
        }
        $user->save();
        Alert::success(' ', 'Verifikasi Sukses Silahkan login!');

        return redirect('auth/register');
    }
}
