<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status','1')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // return $actionBtn;
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
   
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (session()->has('Loggedin')) {
            $user = User::where('id', '=', session('Loggedin'))->first();
            $data = [
                'LoggedUserInfo'=>$user
            ];
        } else {
            # code...
        }
        return view('pages/users.index', $data);
    }

    // public function getUsers(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = User::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<button type="button" name="edit" id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</button>';
    //                 $actionBtn .= '&nbsp;&nbsp; <button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</button> ';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    public function store(Request $request)
    {
            if (!empty($request->password)) {
                $default_status = 1;
                $roles = NULL;
                User::updateOrCreate(['id' => $request->User_id],
                    ['f_name'   => Str::ucfirst($request->f_name), 
                    'l_name'    => Str::ucfirst($request->l_name), 
                    'username'  => $request->username, 
                    'password'  => Hash::make($request->password),
                    'roles'     => $roles,
                    'status'    => $default_status]); 

                return response()->json(['success'=>'User saved successfully.']);
            }else {

                $default_status = 1;
                $roles = NULL;
                User::updateOrCreate(['id' => $request->User_id],
                    ['f_name'   => Str::ucfirst($request->f_name), 
                    'l_name'    => Str::ucfirst($request->l_name), 
                    'username'  => $request->username, 
                    'roles'     => $roles,
                    'status'    => $default_status]); 
                return response()->json(['success'=>'User saved successfully.']);
            }
        
    }

    public function edit($id)
    {
        $item = User::find($id);
        return response()->json($item);
    }

    public function deleteUser(Request $request)
    {
        $default_status = 0;
        User::updateOrCreate(['id' => $request->User_remove_id],
                    ['status'    => $default_status]); 

        return response()->json(['success'=>'User removed successfully.']);

        // return response()->json($request->User_remove_id);
    }

}
