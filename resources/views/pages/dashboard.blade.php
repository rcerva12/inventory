@extends('layout.app')
@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>{{session('username')}}</p>
        <a href="/logout">Logout</a>
    </div>
@endsection