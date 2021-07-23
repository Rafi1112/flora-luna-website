<div class="card-body">
    <div class="form-group">
        <label for="category_name">Category Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name"
               placeholder="Enter category name" value="{{ old('category_name') ?? $category->name }}"/>
        @error('category_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="category_description">Category Description <span class="text-danger">*</span></label>
        <textarea class="form-control" id="category_description" name="category_description" rows="5" placeholder="Enter description">{{ old('category_description') ?? $category->description }}</textarea>
        @error('category_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
</div>
