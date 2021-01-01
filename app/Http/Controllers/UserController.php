<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.user.index', compact('user'));
    }

    public function changestatus($id)
    {
        $user = User::find($id);
        if($user->status == 0){
            $change ='1';
        }else{
            $change ='0';

        }
      User::where('id', $id)->update(['status'=>$change]);
        Alert::success('', 'Status user berhasil diperbaharui!');

        return redirect('admin/user');
    }

}
