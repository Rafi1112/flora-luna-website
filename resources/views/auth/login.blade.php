@extends('layouts.app')

@section('content')
    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('assets/media/bg/bg-3.jpg') }}');">
                    <div class="login-form text-center p-7 position-relative overflow-hidden">
                        <div class="login-signin">
                            <div class="mb-20">
                                <h3>Sign In</h3>
                                <div class="text-muted font-weight-bold">Enter your <strong>credentials</strong> to login to your account:</div>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="form">
                                @csrf
                                <div class="form-group mb-5">
                                    <input class="form-control form-control-solid py-4 px-8 @error('username') is-invalid @enderror"
                                           type="text" placeholder="Username" name="username" autocomplete="off" />
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control form-control-solid py-4 px-8 @error('password') is-invalid @enderror"
                                           type="password" placeholder="Password" name="password" />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="checkbox-inline">
                                        <label class="checkbox m-0 text-muted">
                                            <input type="checkbox" name="remember" />
                                            <span></span>Remember me</label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="text-muted text-hover-primary">Forgot Password ?</a>
                                </div>
                                <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                            </form>
                            <div class="mt-10">
                                <span class="opacity-70 mr-1">Don't have an account yet?</span>
                                <a href="{{ route('register') }}" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

