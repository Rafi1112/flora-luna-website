<div class="card-body">
    <div class="form-group">
        <label for="label_name">Label Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('label_name') is-invalid @enderror" id="label_name" name="label_name"
               placeholder="Enter label name" value="{{ old('label_name') ?? $label->name }}"/>
        @error('label_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="label_description">Label Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('label_description') is-invalid @enderror" id="label_description" name="label_description"
                  placeholder="Enter label description">{{ old('label_description') ?? $label->description }}</textarea>
        @error('label_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="label_image">Label Image <span class="text-danger">*</span></label>
        <div>
            <div class="image-input image-input-outline" id="kt_image_1">
                <div class="image-input-wrapper" @isset($label->image) style="background-image:url({{ $label->labelImage }})" @endisset></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="label_image" accept=".png, .jpg, .jpeg">
                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel icon">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
        </div>
        @error('label_image')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
</div>
