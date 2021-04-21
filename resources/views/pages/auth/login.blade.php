@extends('layout.app')
@section('content')
    {{-- <div class="container">
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
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="row">
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
    </div> --}}

    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/background1.png);">
					<span class="login100-form-title-1">
						Inventory Tool
					</span>
				</div>

				<form class="login100-form validate-form" action="{{ route('login') }}" method="post">
                    @csrf
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" id="username" name="username" placeholder="Enter username" @error('username') class="invalid" @enderror value="{{ old('username') ?: '' }}"/>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" id="password" name="password" placeholder="Enter password" @error('password') class="invalid" @enderror value="{{ old('password') ?: '' }}"/>
						<span class="focus-input100"></span>
					</div>

					{{-- <div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div> --}}

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection