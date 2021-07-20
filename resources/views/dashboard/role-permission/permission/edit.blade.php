@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Update Permission " <strong class="text-danger"> {{ $permission->name }} </strong> "
                </h3>
            </div>
            <form action="{{ route('permission.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.role-permission.permission.partials.form-control')
            </form>
        </div>
    </div>

@endsection
