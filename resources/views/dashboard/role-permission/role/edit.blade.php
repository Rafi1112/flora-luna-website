@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Update Role " <strong class="text-danger">{{ $role->name }}</strong> "
                </h3>
            </div>
            <form action="{{ route('role.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.role-permission.role.partials.form-control')
            </form>
        </div>
    </div>

@endsection
