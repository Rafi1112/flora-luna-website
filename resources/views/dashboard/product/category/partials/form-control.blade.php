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
        <label for="category_url">Category Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('category_url') is-invalid @enderror" id="category_url" name="category_url"
               placeholder="Enter category url" value="{{ old('category_url') ?? $category->url }}"/>
        @error('category_url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="category_description">Category Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('category_description') is-invalid @enderror" id="category_description" name="category_description"
                  placeholder="Enter category description">{{ old('category_description') ?? $category->description }}</textarea>
        @error('category_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="category_position">Category Position <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('category_position') is-invalid @enderror" id="category_position" name="category_position"
                  placeholder="Enter category position" value="{{ old('category_position') ?? $category->position }}">
        @error('category_position')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="category_icon">Category Icon <span class="text-danger">*</span></label>
        <div>
            <div class="image-input image-input-outline" id="kt_image_1">
                <div class="image-input-wrapper" @isset($category->icon) style="background-image:url({{ $category->takeIcon }})" @endisset></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="category_icon" accept=".png, .jpg, .jpeg">
                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel icon">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
        </div>
        @error('category_icon')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
</div>
