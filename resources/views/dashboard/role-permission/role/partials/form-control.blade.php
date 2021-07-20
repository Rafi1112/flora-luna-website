<div class="card-body">
    <div class="form-group">
        <label for="role_name">Role Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name" name="role_name"
               placeholder="Enter role name" value="{{ old('role_name') ?? $role->name }}"/>
        @error('role_name')
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
