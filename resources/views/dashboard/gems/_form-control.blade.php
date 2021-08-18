<div class="card-body">
    <div class="form-group">
        <label for="title">Enter Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
               placeholder="Enter title" value="{{ old('title') ?? $gem->title }}"/>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="amount">Enter Gems Amount <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount"
               placeholder="Enter amount" value="{{ old('amount') ?? $gem->gems_amount }}"/>
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="price">Enter Price <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
               placeholder="Enter price" value="{{ old('price') ?? $gem->price }}"/>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Gems Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                  placeholder="Enter gems description">{{ old('description') ?? $gem->description }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="discount_amount">Enter Discount Amount</label>
        <input type="number" class="form-control @error('discount_amount') is-invalid @enderror" id="discount_amount" name="discount_amount"
               placeholder="Enter discount amount" value="{{ old('discount_amount') ?? $gem->discount_amount }}"/>
        @error('discount_amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <div class="checkbox-list">
            <label class="checkbox">
                <input type="checkbox" id="is_discount" name="is_discount" {{ $gem->is_discount ? 'checked' : '' }}>
                <span></span>Is Discount
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-info font-weight-bolder mt-2">{{ $button ?? 'Update' }}</button>
</div>
