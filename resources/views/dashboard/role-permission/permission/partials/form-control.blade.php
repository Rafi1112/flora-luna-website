<div class="card-body">
    <div class="form-group">
        <label for="permission_name">Permission Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('permission_name') is-invalid @enderror" id="permission_name" name="permission_name"
               placeholder="Enter permission name" value="{{ old('permission_name') ?? $permission->name }}"/>
        @error('permission_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="guard_name">Guard Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name"
               placeholder="default to 'web'" value="{{ $role->guard_name ?? 'web' }}"/>
        @error('guard_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
</div>
