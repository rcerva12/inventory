@extends('layout.app')
@section('content')
    <div class="container">
        <div class="inv">
            <h1>Inventory Tool</h1>
        </div>
        <div class="card card-transparent col-6">
            <div class="row no-gutters m-0">
                <div class="col-12 col-md-3 h-100 d-none d-md-block">
                    <img src="{{ asset('images/background2.jpg') }}" class="card-img h-100">
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="card-body">
                            <form action="login" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-field">
                                            <input id="username" name="username" type="text"/>
                                            <label for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-field">
                                            <input id="password" name="password" type="password"/>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button class="btn yellow accent-3 waves-effect waves-dark grey-text text-darken-3" type="submit"><i class="fas fa-lock"></i> Login</button>
                                    </div>
                                    <div class="col-9 text-center">
                                        <a href="/register" class="accent-3 waves-effect waves-dark grey-text text-darken-3"><em>Register Account</em></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection