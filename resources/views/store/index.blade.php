@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header card-header-tabs-line nav-tabs-line-3x justify-content-center">
                <div class="card-toolbar">
                    <x-store-category></x-store-category>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-7">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-3 col-lg-12 col-xxl-3">
                            <div class="card card-custom gutter-b card-stretch">
                                @isset($product->label)
                                    <img src="{{ $product->label->labelImage }}" style="width: 50px;position: absolute" alt="label">
                                @endisset
                                <div class="card-body d-flex flex-column rounded bg-light justify-content-between">
                                    <a href="{{ route('store.detail', $product) }}">
                                        <div class="text-center rounded mb-4">
                                            <img src="{{ $product->productHalfImage }}" alt="{{ $product->name }}" class="mw-100 w-200px">
                                        </div>
                                    </a>
                                    <div class="text-center d-flex flex-column">
                                        <span class="font-weight-bolder text-dark-75 mb-1">
                                            {{ $product->name }}
                                        </span>
                                        <a href="{{ route('store.detail', $product) }}" class="btn btn-primary btn-sm text-white font-weight-bolder d-inline-flex align-items-center justify-content-center mt-2">
                                            {{ $product->price }} <img src="{{ asset('assets/media/gem-coin.png') }}" alt="gem" class="ml-1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
