@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Edit Category Announcement " <strong class="text-danger">{{ $category->name }}</strong> "
                </h3>
            </div>
            <form action="{{ route('article.category.update', $category->slug) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.articles.category.partials.form-control')
            </form>
        </div>
    </div>

@endsection
