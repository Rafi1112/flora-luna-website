@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Edit Product " {{ $product->name }} "
                </h3>
            </div>
            <form action="{{ route('product.edit', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('dashboard.product.product._form-control')
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/pages/crud/forms/editors/summernote.js') }}"></script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
        var avatar2 = new KTImageInput('kt_image_2');
    </script>
@endpush
