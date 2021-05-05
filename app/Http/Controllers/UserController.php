<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = User::where('status',1)->get();
            // SQL COMMAND
            /*SELECT 
                users.id,
                users.f_name,
                users.l_name,
                users.username,
                users.password,
                roles.role_name AS roles,
                case when users.`status` = 1 then 'Active'
                        ELSE 'Inactive'
                        END AS status
                FROM roles INNER JOIN users ON roles.id = users.roles && users.`status` = 1*/
            $data = User::select(
                "users.id",
                "users.f_name",
                "users.l_name",
                "users.username",
                "users.password",
                "roles.role_name as roles",
                DB::raw("(CASE WHEN users.status = 1 THEN 'Active' ELSE 'Inactive' END) AS status" )
                )
                ->join("roles", "roles.id","=","users.roles")
                // ->where("users.status",1)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // return $actionBtn;
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
   
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Remove</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (session()->has('Loggedin')) {
            $user = User::where('id', '=', session('Loggedin'))->first();
            // $data = [
            //     'LoggedUserInfo'=>$user
            // ];
        } else {
            # code...
        }

        $role = Roles::where('status',1)->get();
        return view('pages/users.index', compact('user','role'));
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
        // $roles = Roles::where('status',1)->get();
        // foreach ($roles as $role){
        //     if ($role->id == $request->role) {
        //         $role_user = $role->users + 1;
        //     }
        //     return response()->json($role_user);
        // }
        // $roles = DB::select('select * from roles where status = 1');
        // return response()->json($roles);
        if (!empty($request->password)) {

            $default_status = 1;
            // $roles = Role::where('role_name',$request->role)->get();
            // $roles = NULL;
            User::updateOrCreate(['id' => $request->User_id],
                ['f_name'   => Str::ucfirst($request->f_name), 
                'l_name'    => Str::ucfirst($request->l_name), 
                'username'  => $request->username, 
                'password'  => Hash::make($request->password),
                'roles'     => $request->role,
                'status'    => $default_status]); 

            return response()->json(['success'=>'User saved successfully.']);
        }else {

            $default_status = 1;
            $roles = NULL;
            User::updateOrCreate(['id' => $request->User_id],
                ['f_name'   => Str::ucfirst($request->f_name), 
                'l_name'    => Str::ucfirst($request->l_name), 
                'username'  => $request->username, 
                'roles'     => $request->role,
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
