@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Create Announcement
                </h3>
            </div>
            <form action="{{ route('article.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.articles.partials.form-control', ['button' => 'Submit'])
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/pages/crud/forms/editors/summernote.js') }}"></script>
@endpush
