@extends('layouts.app')
@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Edit Gems " {{ $gem->tittle }} "
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('gems.index') }}"><i class="far fa-list-alt text-white mr-2"></i>List Gems Price</a>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="{{ route('gems.edit', $gem) }}" method="post">
                @csrf
                @method('PUT')
                @include('dashboard.gems._form-control')
            </form>
        </div>
    </div>

@endsection
