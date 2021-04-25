<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test_data;
use App\Models\User;

class TestController extends Controller
{
    // public function create()
    // {

    //   return view('pages/ajax-request');
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     #create or update your data here

    //     return response()->json(['success'=>'Ajax request submitted successfully']);
    // }
    public function index()
    {
        
        $todos = Test_data::all();
        return view('pages/test', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required',
            ]);

        $todo = new Test_data();
        $todo->todo = $request->todo;
        $todo->save();
        return Response::json($todo);
    }

    public function update(Todo $todo, Request $request)
    {
        $request->validate([
            'todo' => 'required',
            ]);

        $todo->todo = $request->todo;
        $todo->save();
        return Response::json($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return Response::json($todo);
    }

}
