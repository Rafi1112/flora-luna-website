@extends('layouts.app')

@section('content')
    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="{{ route('account') }}">
                                <span class="nav-text font-weight-bold">Account Information</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link active" href="{{ route('change.password') }}">
                                <span class="nav-text font-weight-bold">Change Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-success mr-2" onclick="document.getElementById('changePassword').submit();">Save Changes</button>
                </div>
            </div>
            <form action="{{ route('change.password') }}" method="POST" class="form" id="changePassword">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid @error('current_password') is-invalid @enderror"
                                   type="password" id="current_password" name="current_password" placeholder="Current password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                   type="password" id="password" name="password" placeholder="New Password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Confirm New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid"
                                   type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
