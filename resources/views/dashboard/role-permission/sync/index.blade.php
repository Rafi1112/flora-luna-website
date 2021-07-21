@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Assign Role has permissions
                </h3>
            </div>

            <form action="{{ route('sync.role.permission') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">Role <span class="text-danger">*</span></label>
                        <div class="dropdown bootstrap-select form-control">
                            <select class="form-control selectpicker @error('role') is-invalid @enderror" tabindex="null" id="role" name="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="kt_select2_3" name="permissions[]" multiple="multiple">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permission')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Synchronize</button>
                </div>
            </form>

        </div>
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Role has permissions
                </h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Permission</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($roles as $index => $role)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->getPermissionNames()->toArray() as $item)
                                    <span class="label label-info label-pill label-inline mr-2">{{ $item }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="row">
                                    <a href="" class="btn btn-primary btn-sm mr-2">Synchronize</a>
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
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        $('#kt_select2_3').select2({
            placeholder: "Select a permissions",
        });
    </script>
@endpush
