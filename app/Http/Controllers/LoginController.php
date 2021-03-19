<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget(['user', 'authentication_token']);
        return view('pages.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_login(Request $req)
    {
        $user_name = $req->input();
        $req->session()->put('username', $user_name['username']);
        return redirect('dashboard');
    }

    public function create_user (Request $req)
    {
        // return Str::ucfirst($req->l_name);

        //VALIDATE $req
        $req->validate([
            'f_name'=>'required',
            'l_name'=>'required',
            'username'=>'required|unique:users',
            'password'=>'required|min:5|max:30'
        ]);

        //REGISTER USER
        $user = new User;
        $user->f_name = Str::ucfirst($req->f_name);
        $user->l_name = Str::ucfirst($req->l_name);
        $user->username = $req->username;
        $user->password = Hash::make($req->password);

        if ($user->save()) {
            return back()->with(session(['message' => 'Registered successfuly']));
        }else {
            return back()->with(session(['message' => 'Opps.. something went wrong!']));
        }

    }

    
}
