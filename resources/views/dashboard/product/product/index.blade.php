@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column mt-5">
                    <span class="card-label font-weight-bolder text-dark mb-1">Products</span>
                    <span class="text-muted mt-2 font-weight-bold font-size-sm">{{ $products->total() }} Total products found.</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Search products..." id="kt_datatable_search_query">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="button">Go!</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('product.create') }}"><i class="fas fa-plus text-white mr-2"></i>New Product</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-vertical-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Label</th>
                            <th scope="col">Featured</th>
                            <th scope="col">Published</th>
                            <th scope="col" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $index => $product)
                                <tr>
                                    <th scope="row">{{ $products->firstItem() + $index }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{ $product->price }}
                                            <img src="{{ asset('assets/media/gem-coin.png') }}" alt="gem" class="ml-1">
                                        </div>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        @if($product->label)
                                            <img src="{{ $product->label->labelImage }}" width="30px">
                                        @else
                                            <div class="label label-info label-sm label-inline font-weight-bold text-white">NULL</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="label {{ $product->is_featured ? 'label-success' : 'label-danger' }} label-sm label-inline font-weight-bold text-white">
                                            {{ $product->is_featured ? 'TRUE' : 'FALSE' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="label {{ $product->is_published ? 'label-success' : 'label-danger' }} label-sm label-inline font-weight-bold text-white">
                                            {{ $product->is_published ? 'TRUE' : 'FALSE' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                                                <ul class="navi flex-column navi-hover py-2">
                                                    <li class="navi-item">
                                                        <a href="{{ route('product.edit', $product) }}" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="far fa-edit"></i>
                                                            </span>
                                                            <span class="navi-text">Edit</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <form action="{{ route('product.delete', $product) }}" method="post" id="delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <span class="navi-icon">
                                                                    <i class="far fa-trash-alt mr-2"></i>
                                                                </span>
                                                                <span class="navi-text confirm-delete" data-name="{{ $product->name }}">Delete</span>
                                                            </form>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="fas fa-plus"></i>
                                                            </span>
                                                            <span class="navi-text">Add Item</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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
                <div class="d-flex justify-content-center">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/alert-delete.js') }}"></script>
@endpush
