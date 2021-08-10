<div class="card-body">
    <div class="form-group row">
        <div class="col-lg-6">
            <label for="product_name">Product Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name"
                   placeholder="Enter product name" value="{{ old('product_name') ?? $product->name }}"/>
            @error('product_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="product_category">Select Product Category <span class="text-danger">*</span></label>
            <select class="form-control @error('product_category') is-invalid @enderror" id="product_category" name="product_category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('product_category')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label for="product_price">Product Price <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price"
                   placeholder="Enter product price" value="{{ old('product_price') ?? $product->price }}"/>
            @error('product_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="product_label">Select Product Label <span class="text-danger">*</span></label>
            <select class="form-control @error('product_label') is-invalid @enderror" id="product_label" name="product_label">
                <option value="0" {{ $product->product_label_id === null ? 'selected' : '' }}>NONE</option>
                @foreach($labels as $label)
                    <option value="{{ $label->id }}" {{ $product->product_label_id == $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
                @endforeach
            </select>
            @error('product_label')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="product_description">Product Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('product_description') is-invalid @enderror" id="product_description" name="product_description"
                  placeholder="Enter product description">{{ old('product_description') ?? $product->description }}</textarea>
        @error('product_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="product_option">Product Option (Effect)</label>
        <textarea class="summernote @error('product_option') is-invalid @enderror" id="product_option" name="product_option">{!! old('product_option') ?? nl2br($product->option) !!}</textarea>
        @error('product_option')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-12 row">
        <div class="mr-5">
            <label for="product_half_image">Product Half Image <span class="text-danger">*</span></label>
            <div>
                <div class="image-input image-input-outline" id="kt_image_1">
                    <div class="image-input-wrapper" @isset($product->half_image) style="background-image:url({{ $product->productHalfImage }})" @endisset></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change image">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="product_half_image" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel image">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                    @isset($product->half_image)
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove image">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    @endisset
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
            @error('product_half_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div>
            <label for="product_full_image">Product Full Image <span class="text-danger">*</span></label>
            <div>
                <div class="image-input image-input-outline" id="kt_image_2">
                    <div class="image-input-wrapper" @isset($product->full_image) style="background-image:url({{ $product->productFullImage }})" @endisset></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change image">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="product_full_image" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel image">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                    @isset($product->full_image)
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove image">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    @endisset
                </div>
            </div>
            @error('product_full_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox-list">
            <label class="checkbox">
                <input type="checkbox" id="is_featured" name="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                <span></span>Is Featured
            </label>
            <label class="checkbox">
                <input type="checkbox" id="is_published"
                       name="is_published" {{ $product->is_published ? 'checked' : '' }} @isset($button) checked @endisset>
                <span></span>Is Published
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
    <a href="{{ url()->previous() }}" class="btn btn-info mr-2">Back</a>
</div>
