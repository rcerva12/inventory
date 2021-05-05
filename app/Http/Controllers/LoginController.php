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
        return view('pages/auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_login(Request $req)
    {
    //    return $req->input();
        // $req->session()->put('username', $user_name['username']);
        // return redirect('dashboard');

        //VALIDATE $req
        $req->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $user_check = User::where('status',1)
                    ->where('username', $req->username)
                    ->first();

        if ($user_check) {
            if (Hash::check($req->password, $user_check->password)) {
                $req->session()->put('Loggedin', $user_check->id);
                session(['UserName' => $user_check->f_name]);
                return redirect('dashboard'); 
            } else {
                return back()->with(session(['message' => 'Invalid Password', 'background'  => 'bg-warning']));
            }
            
        } else {
            return back()->with(session(['message' => 'No User found for this username', 'background'  => 'bg-warning']));
        }
               
    }

    public function dashboard ()
    {
        if (session()->has('Loggedin')) {
            $user = User::where('id', '=', session('Loggedin'))->first();
            // $data = [
            //     'LoggedUserInfo'=>$user
            // ];
        } else {
            # code...
        }
        
        return view('pages.dashboard', compact('user'));
    }

    public function logout ()
    {
        if (session()->has('Loggedin')) {
            session()->pull('Loggedin');
            return redirect('/');
        } else {
            # code...
        }
        
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
        $default_status = 1;
        $user = new User;
        $user->f_name = Str::ucfirst($req->f_name);
        $user->l_name = Str::ucfirst($req->l_name);
        $user->username = $req->username;
        $user->status = $default_status;
        $user->password = Hash::make($req->password);

        if ($user->save()) {
            return back()->with(session(['message' => 'Registered successfuly']));
        }else {
            return back()->with(session(['message' => 'Opps.. something went wrong!']));
        }

    }

    

    
}
