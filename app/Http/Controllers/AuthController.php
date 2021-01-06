<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
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

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $cek  = User::where('id', Auth::user()->id)->first();
            if($cek->status == 0){
                // echo "Maaf Akun belom diverifikasi";
                Alert::success(' ', 'Maaf Akun belom diverifikas!');
                Auth::logout();//jika salah akan otomatis terlogout
                return redirect('auth/register');
            }else{
                Alert::success(' ', 'Anda Berhasil login!');
                return redirect('/');
            }

        }else{
            Alert::warning(' ', 'Email atau Password tidak sesuai!');
            return redirect()->back();
        }
        // echo Auth::user()->name;
    }
}
