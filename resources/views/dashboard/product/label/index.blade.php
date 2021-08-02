@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Create Product Label
                </h3>
            </div>
            <form action="{{ route('label.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.product.label._form-control', ['button' => 'Submit'])
            </form>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Product Label
                </h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($labels as $index => $label)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->slug }}</td>
                            <td>
                                <img src="{{ $label->labelImage }}" alt="{{ $label->slug }}" width="30px" height="30px">
                            </td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('label.edit', $label) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                                    <form action="{{ route('label.destroy', $label) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm confirm-delete"
                                                data-name="{{ $label->name }}">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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
