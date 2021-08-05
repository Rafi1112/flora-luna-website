@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Create Product
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('product.index') }}"><i class="far fa-list-alt text-white mr-2"></i>Product List</a>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.product.product._form-control', ['button' => 'Submit'])
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
