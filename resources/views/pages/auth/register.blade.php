@extends('layout.app')
@section('content')
    <div class="container">
        <div class="card card-reg card-transparent col-6">
            <div class="row no-gutters m-0">
                <div class="col-12 col-md-3 h-100 d-none d-md-block">
                    <img src="{{ asset('images/background2.jpg') }}" class="card-img h-100">
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="card-body">
                            <form action="{{ route('create_user') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-field">
                                            <input id="f_name" name="f_name" type="text"style="text-transform: capitalize;" @error('f_name') class="invalid" @enderror value="{{ old('f_name') ?: '' }}"/>
                                            <label for="f_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-field">
                                            <input id="l_name" name="l_name" type="text"style="text-transform: capitalize;" @error('l_name') class="invalid" @enderror value="{{ old('l_name') ?: '' }}"/>
                                            <label for="l_name">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-field">
                                            <input id="username" name="username" type="text" @error('username') class="invalid" @enderror value="{{ old('username') ?: '' }}"/>
                                            <label for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-field">
                                            <input id="password" name="password" type="password" @error('password') class="invalid" @enderror value="{{ old('password') ?: '' }}"/>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-left">
                                        <a href="/" class="btn btn-back yellow accent-3 waves-effect waves-dark grey-text text-darken-3"> <i class="fas fa-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn yellow accent-3 waves-effect waves-dark grey-text text-darken-3" type="submit"><i class="fas fa-lock"></i> Submit</button>
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