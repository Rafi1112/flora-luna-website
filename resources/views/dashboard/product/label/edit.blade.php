@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Edit Product Label " {{ $label->name }} "
                </h3>
            </div>
            <form action="{{ route('label.edit', $label) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('dashboard.product.label._form-control')
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
@endpush
