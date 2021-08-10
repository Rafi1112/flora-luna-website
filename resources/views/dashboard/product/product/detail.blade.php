@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column mt-5">
                    <span class="card-label font-weight-bolder text-dark mb-1">Products</span>
                    <span class="text-muted mt-2 font-weight-bold font-size-sm">Detail {{ $product->name }} product.</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('store.detail', $product) }}" target="_blank"><i class="fas fa-eye text-white mr-2"></i>Store</a>
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
                    <div class="col-xxl-7 pl-xxl-11">
                        <div class="font-size-lg line-height-xl flex-grow-1 font-weight-bold text-dark-50 py-lg-2">
                            {!! nl2br($product->description) !!}
                        </div>
                        <div class="card-body rounded px-10 py-8" style="background-color: #6b6b6b;">
                            {!! nl2br($product->option) !!}
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="font-weight-bolder text-dark font-size-h3 mb-0">List Items</h2>
                    <a href="{{ route('add.product.item', $product) }}" class="btn btn-primary btn-sm font-weight-bolder">
                        <i class="fas fa-plus"></i>
                        Add Item
                    </a>
                </div>
                <div>
                    <div class="table-responsive-lg">
                        <table class="table table-vertical-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Itemname</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Description</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Limited</th>
                                <th scope="col">Published</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($product->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{ $item->price }}
                                            <img src="{{ asset('assets/media/gem-coin.png') }}" alt="gem" class="ml-1">
                                        </div>
                                    </td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ Str::limit($item->description, 20) }}</td>
                                    <td>
                                    <span data-theme="dark" data-html="true"
                                          data-toggle="tooltip" data-placement="bottom" title="{!! nl2br($item->option) !!}">
                                        <img src="{{ $item->itemIcon }}" alt="icon" width="30px">
                                    </span>
                                    </td>
                                    <td>
                                        <div class="label {{ $item->is_limited ? 'label-success' : 'label-danger' }} label-sm label-inline font-weight-bold text-white">
                                            {{ $item->is_limited ? 'TRUE' : 'FALSE' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="label {{ $item->is_published ? 'label-success' : 'label-danger' }} label-sm label-inline font-weight-bold text-white">
                                            {{ $item->is_published ? 'TRUE' : 'FALSE' }}
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="row">
                                            <a href="{{ route('item.edit', $item) }}" class="btn btn-primary btn-sm mr-2">
                                                <span class="far fa-edit"></span>
                                            </a>
                                            <form action="{{ route('item.delete', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm confirm-delete"
                                                        data-name="{{ $item->name }}"><span class="fas fa-trash"></span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/alert-delete.js') }}"></script>
@endpush
