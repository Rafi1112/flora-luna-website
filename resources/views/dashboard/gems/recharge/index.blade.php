@extends('layouts.app')
@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Recharge User Gems
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="#"><i class="far fa-list-alt text-white mr-2"></i>User List</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('recharge.gems') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">Select Username <span class="text-danger">*</span></label>
                        <select class="form-control selectpicker @error('username') is-invalid @enderror"
                                data-size="7" data-live-search="true" name="username">
                            @foreach($users as $user)
                                <option value="{{ $user->username }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">Enter gems amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount"
                               placeholder="Enter amount"/>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info btn-block font-weight-bolder mt-2">Recharge</button>
                </form>
            </div>
        </div>
    </div>

@endsection
