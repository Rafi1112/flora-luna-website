@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Add item to product "<strong class="text-danger">{{ $product->name }}</strong>"
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('product.detail', $product) }}"><i class="fas fa-eye text-white mr-2"></i>Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('product.index') }}"><i class="far fa-list-alt text-white mr-2"></i>Products List</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <h1 class="display-4 font-weight-boldest">{{ $product->name }}</h1>
                </div>
                <div class="row mb-10">
                    <div class="col-xxl-5 mb-11 mb-xxl-0">
                        <div class="card card-custom card-stretch">
                            <div class="card-body p-0 rounded px-10 py-15 d-flex align-items-center justify-content-center" style="background-color: #dac69f;">
                                <img src="{{ $product->productFullImage }}" alt="{{ $product->slug }}" class="mw-100 w-200px" style="transform: scale(1.2);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator separator-dashed my-8"></div>
                <div>
                    <form action="{{ route('add.product.item', $product) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="item_name">Itemname <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name"
                                   placeholder="Enter item name" value="{{ old('item_name') }}"/>
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="item_stock">Item Stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('item_stock') is-invalid @enderror" id="item_stock" name="item_stock"
                                       placeholder="Enter item stock" value="{{ old('item_stock') }}"/>
                                @error('item_stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="item_price">Item Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('item_price') is-invalid @enderror" id="item_price" name="item_price"
                                       placeholder="Enter item price" value="{{ old('item_price') }}"/>
                                @error('item_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="item_description">Item Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('item_description') is-invalid @enderror" id="item_description" name="item_description"
                                          placeholder="Enter item description">{{ old('item_description') }}</textarea>
                                @error('item_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="item_option">Item Option <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('item_option') is-invalid @enderror" id="item_option" name="item_option"
                                          placeholder="Enter item option">{{ old('item_option') }}</textarea>
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
                                        <div class="image-input-wrapper"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="item_icon" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel icon">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
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
                                    <input type="checkbox" id="is_limited" name="is_limited">
                                    <span></span>Is Limited
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="is_published" name="is_published" checked>
                                    <span></span>Is Published
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/alert-delete.js') }}"></script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
@endpush
