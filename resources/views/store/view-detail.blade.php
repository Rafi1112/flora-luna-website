@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header card-header-tabs-line nav-tabs-line-3x justify-content-center">
                <div class="card-toolbar">
                    <x-store-category :product="$product"></x-store-category>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-11">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-title">
                                <h1 class="display-4 font-weight-boldest">{{ $product->name }}</h1>
                            </div>
                            <div class="row mb-17">
                                <div class="col-xxl-5 mb-11 mb-xxl-0">
                                    <div class="card card-custom card-stretch">
                                        <div class="card-body p-0 rounded px-10 py-15 d-flex align-items-center justify-content-center" style="background-color: #dac69f;">
                                            <img src="{{ $product->productFullImage }}" alt="{{ $product->name }}" class="mw-100 w-200px" style="transform: scale(1.2);">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-7 pl-xxl-11">
                                    <div class="font-size-lg line-height-xl flex-grow-1 font-weight-bold text-dark-50 py-lg-2">
                                        {!! nl2br($product->description) !!}
                                    </div>
                                    @if($product->option)
                                        <div class="card-body rounded px-10 py-8" style= "background-color: #6b6b6b;">
                                           {!! nl2br($product->option) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-center d-lg-flex">
                                <div class="col-lg-10">
                                    <form action="{{ route('item.purchase') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                @error('item')
                                                    <div class="alert alert-custom alert-danger fade show" role="alert">
                                                        <div class="alert-text">Select at least one item.</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @enderror
                                                @if(session('error'))
                                                <div class="alert alert-custom alert-danger fade show" role="alert">
                                                    <div class="alert-text">{{ session('error') }}</div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endif
                                                @forelse($items as $item)
                                                    <label class="option m-0 p-3 d-flex align-items-center">
                                                        <span class="option-control">
                                                            <span class="radio radio-outline">
                                                                <input type="radio" name="item" value="{{ $item->id }}" @if($item->stock < 1) disabled @endif>
                                                                <span></span>
                                                            </span>
                                                        </span>
                                                        <div class="symbol symbol-35 mr-3">
                                                            <span data-theme="dark" data-html="true"
                                                                  data-toggle="tooltip" data-placement="bottom" title="{!! nl2br($item->option) !!}">
                                                                <div class="symbol-label" style="background-image: url('{{ $item->itemIcon }}')"></div>
                                                            </span>
                                                        </div>
                                                        <span class="option-label ml-4">
                                                            <span class="option-head">
                                                                <span>
                                                                    {{ $item->name }}
                                                                    @if($item->option)
                                                                        <div class="label label-dark label-inline ml-2 font-weight-bold" style="color: #83ff37;">
                                                                            {{ $item->option }}
                                                                        </div>
                                                                    @endif
                                                                    @if($item->is_limited)
                                                                        <div class="label label-danger label-inline font-weight-bold text-white">
                                                                            Limited
                                                                        </div>
                                                                    @endif
                                                                    @if($item->stock < 1)
                                                                        <div class="label label-danger label-inline font-weight-bold text-white">
                                                                            Out of stock!
                                                                        </div>
                                                                    @endif
                                                                </span>
                                                                <span class="text-dark-75">
                                                                    {{ $item->price }}
                                                                    <img src="{{ asset('assets/media/gem-coin.png') }}" alt="gem">
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                @empty
                                                    <label class="option m-0 p-3 d-flex align-items-center">
                                                        <span class="option-label ml-4">
                                                            <span class="option-title">There's no item to display.</span>
                                                        </span>
                                                    </label>
                                                @endforelse
                                                @if($product->items()->exists())
                                                    <button type="submit" class="btn btn-info btn-block font-weight-bolder mt-2">Buy</button>
                                                @endif
                                                <a href="{{ url()->previous() }}" class="btn btn-light btn-block font-weight-bolder">Back</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
