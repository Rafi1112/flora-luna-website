@extends('layouts.app')

@section('content')
    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                        <li class="nav-item mr-3">
                            <a class="nav-link active" href="{{ route('account') }}">
                                <span class="nav-text font-weight-bold">Account Information</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="{{ route('change.password') }}">
                                <span class="nav-text font-weight-bold">Change Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-success mr-2" onclick="document.getElementById('account').submit();">Save Changes</button>
                </div>
            </div>
            <form action="{{ route('account') }}" method="POST" class="form" id="account">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->username }}" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                   type="email" id="email" name="email"
                                   value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                   type="text" id="name" name="name"
                                   value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
