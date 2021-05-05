<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Roles::where('status',1)->get();
                // SQL COMMAND
                /*SELECT roles.id, roles.role_name, 
                    COUNT(users.roles) AS users, 
                    roles.permission,
                    case when roles.`status` = 1 then 'Active'
                    ELSE 'Inactive' 
                    END AS `status`
                FROM roles
                    INNER JOIN users ON roles.id = users.roles
                GROUP BY roles.id*/
                // Still not working the count in users column
            // $data = Roles::select(
            //         "roles.id",
            //         "roles.role_name",
            //         "roles.users",
            //         DB::raw("roles.permission, (CASE WHEN roles.status = 1 THEN 'Active' ELSE 'Inactive' END) as status")
            //     )
            //     ->get();

            $data = Roles::select(
                "roles.id",
                "roles.role_name",
                DB::raw("count(users.roles) as users, roles.permission, (CASE WHEN roles.status = 1 THEN 'Active' ELSE 'Inactive' END) as status")
                )
                ->join("users", "users.roles","=","roles.id")
                ->groupBy("roles.id")
                ->get();

                // return response()->json($data);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // return $actionBtn;
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editRole">Edit</a>';
   
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteRole">Remove</a>';
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
        return view('pages/roles.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $permission['role'] = $request->role;
        $default_status = 1;
        $default_user = 0;
        $permission = implode(',',$request->role);
        Roles::updateOrCreate(['id' => $request->role_id],
            ['users'        => $default_user,
            'role_name'     => Str::ucfirst($request->role_name),
            'permission'    => $permission,
            'status'        => $default_status
            ]);
        return response()->json(['success'=>'User saved successfully.']);

            
        
        // $permission = $request->role;
        // $role_name = Str::ucfirst($request->role_name);
        // 
        // return response()->json(['permission' => $permission, 'role_name' => $role_name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Roles::find($id);
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRole(Request $request)
    {
        $default_status = 0;
        Roles::updateOrCreate(['id' => $request->role_remove_id],
                    ['status'    => $default_status]); 

        return response()->json(['success'=>'Role removed successfully.']);

        // return response()->json($request->User_remove_id);
    }
}
