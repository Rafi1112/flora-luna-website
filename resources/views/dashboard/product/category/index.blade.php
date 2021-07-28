@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Create Product Category
                </h3>
            </div>
            <form action="{{ route('product.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.product.category.partials.form-control', ['button' => 'Submit'])
            </form>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Product Category
                </h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Position</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->url }}</td>
                            <td>
                                <img src="{{ $category->takeIcon }}" alt="{{ $category->slug }}" width="30px" height="30px">
                            </td>
                            <td>{{ $category->position }}</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('product.category.edit', $category) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                                    <form action="{{ route('product.category.delete', $category) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm confirm-delete"
                                                data-name="{{ $category->name }}">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('.confirm-delete').click(function (e) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            Swal.fire({
                title: `Are you sure want delete "${name}"?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            e.preventDefault();
        });
    </script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
@endpush
