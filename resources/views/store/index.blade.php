@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header card-header-tabs-line nav-tabs-line-3x justify-content-center">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x justify-content-center">
                        @foreach($categories as $category)
                            <li class="nav-item mr-3">
                                <a class="nav-link" href="#">
                                    <div class="d-block text-center">
                                        <div>
                                            <img src="{{ $category->takeIcon }}" height="42px" alt="{{ $category->slug }}">
                                        </div>
                                        <div class="nav-text font-size-lg mt-3" style="margin-bottom: -20px;">{{ $category->name }}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-11">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xxl-4">
                            <div class="card card-custom gutter-b card-stretch">
                                <img src="assets/media/NEW.png" style="width: 50px;position: absolute" alt="label">
                                <div class="card-body d-flex flex-column rounded bg-light justify-content-between">
                                    <div class="text-center rounded mb-7">
                                        <img src="assets/media/costume_bwl_h.png" class="mw-100 w-200px">
                                    </div>
                                    <div>
                                        <h4 class="font-size-h5" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width: 170px">
                                            <span class="text-dark-75 font-weight-bolder">Black Widow Leader</span>
                                        </h4>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-sm text-white font-weight-bolder d-inline-flex align-items-center justify-content-center">
                                        350 <img src="assets/media/gem-coin.png" class="ml-1">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
