<div class="card-body">
    <div class="form-group">
        <label for="product_parent">Select Product Parent <span class="text-danger">*</span></label>
        <select class="form-control selectpicker @error('product_parent') is-invalid @enderror"
                data-size="7" data-live-search="true" name="product_parent">
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $item->product_id === $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
            @endforeach
        </select>
        @error('product_parent')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="item_name">Itemname <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name"
               placeholder="Enter item name" value="{{ old('item_name') ?? $item->name }}"/>
        @error('item_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label for="item_stock">Item Stock <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('item_stock') is-invalid @enderror" id="item_stock" name="item_stock"
                   placeholder="Enter item stock" value="{{ old('item_stock') ?? $item->stock }}"/>
            @error('item_stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="item_price">Item Price <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('item_price') is-invalid @enderror" id="item_price" name="item_price"
                   placeholder="Enter item price" value="{{ old('item_price') ?? $item->price }}"/>
            @error('item_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label for="item_description">Item Description <span class="text-danger">*</span></label>
            <textarea class="form-control @error('item_description') is-invalid @enderror" id="item_description" name="item_description"
                      placeholder="Enter item description">{{ old('item_description') ?? $item->description }}</textarea>
            @error('item_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="item_option">Item Option <span class="text-danger">*</span></label>
            <textarea class="form-control @error('item_option') is-invalid @enderror" id="item_option" name="item_option"
                      placeholder="Enter item option">{{ old('item_option') ?? $item->option }}</textarea>
            @error('item_option')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="mr-5">
            <label for="item_icon">Item Icon <span class="text-danger">*</span></label>
            <div>
                <div class="image-input image-input-outline" id="kt_image_1">
                    <div class="image-input-wrapper" @isset($item->icon) style="background-image:url({{ $item->itemIcon }})" @endisset></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="item_icon" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel icon">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                    @isset($item->icon)
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove icon">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    @endisset
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
            @error('item_icon')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox-list">
            <label class="checkbox">
                <input type="checkbox" id="is_limited" name="is_limited" {{ $item->is_limited ? 'checked' : '' }}>
                <span></span>Is Limited
            </label>
            <label class="checkbox">
                <input type="checkbox" id="is_published"
                       name="is_published" {{ $item->is_published ? 'checked' : '' }} @isset($button) checked @endisset>
                <span></span>Is Published
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
    <a href="{{ url()->previous() }}" class="btn btn-info mr-2">Back</a>
</div>
