@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column mt-5">
                    <span class="card-label font-weight-bolder text-dark mb-1">Items</span>
                    <span class="text-muted mt-2 font-weight-bold font-size-sm">{{ $items->total() }} Total items found.</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Search items..." id="kt_datatable_search_query">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="button">Go!</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('item.create') }}"><i class="fas fa-plus text-white mr-2"></i>New Item</a>
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
                            <th scope="col">Itemname</th>
                            <th scope="col">Price</th>
                            <th scope="col">Product Parent</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Limited</th>
                            <th scope="col">Published</th>
                            <th scope="col" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <th scope="row">{{ $items->firstItem() + $index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{ $item->price }}
                                        <img src="{{ asset('assets/media/gem-coin.png') }}" alt="gem" class="ml-1">
                                    </div>
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->stock }}</td>
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
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                                            <ul class="navi flex-column navi-hover py-2">
                                                <li class="navi-item">
                                                    <a href="{{ route('item.edit', $item) }}" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="far fa-edit"></i>
                                                            </span>
                                                        <span class="navi-text">Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <form action="{{ route('item.delete', $item) }}" method="post" id="delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <span class="navi-icon">
                                                                    <i class="far fa-trash-alt mr-2"></i>
                                                                </span>
                                                            <span class="navi-text confirm-delete" data-name="{{ $item->name }}">Delete</span>
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
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
                <div class="d-flex justify-content-center">
                    {{ $items->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/alert-delete.js') }}"></script>
@endpush
