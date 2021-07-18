@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('assets/media/bg/bg-3.jpg') }}');">
                    <div class="login-form text-center p-7 position-relative overflow-hidden">
                        <div class="login-signup">
                            <div class="mb-15">
                                <h3>Sign Up</h3>
                                <div class="text-muted font-weight-bold">Enter your <strong>credentials</strong> to create your account</div>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="form">
                                @csrf
                                <div class="form-group mb-5">
                                    <input class="form-control form-control-solid py-4 px-8 @error('name') is-invalid @enderror"
                                           type="text" placeholder="Full name" name="name" autocomplete="off" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control form-control-solid py-4 px-8 @error('username') is-invalid @enderror"
                                           type="text" placeholder="Username" name="username" autocomplete="off" value="{{ old('username') }}" />
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                                           type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" />
                                    @error('email')
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
                                <div class="form-group mb-5">
                                    <input class="form-control form-control-solid py-4 px-8"
                                           type="password" placeholder="Confirm Password" name="password_confirmation" />
                                </div>
                                <div class="form-group mb-5 text-left fv-plugins-icon-container">
                                    <div class="checkbox-inline">
                                        <label class="checkbox m-0">
                                            <input type="checkbox" name="agree" required>
                                            <span></span>I Agree the
                                            <a href="#" class="font-weight-bold ml-1">terms and conditions</a>.</label>
                                        @error('agree')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center mt-10">
                                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
