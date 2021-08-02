@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Create Permission
                </h3>
            </div>
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                @include('dashboard.role-permission.permission.partials.form-control', ['button' => 'Submit'])
            </form>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Permission
                </h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Permission Name</th>
                        <th scope="col">Guard Name</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($permissions as $index => $permission)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('permission.update', $permission) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                                    <form action="{{ route('permission.delete', $permission) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm confirm-delete"
                                                data-name="{{ $permission->name }}">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/alert-delete.js') }}"></script>
@endpush
