@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    List Announcement
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('article.create') }}"><i class="fas fa-plus text-white mr-2"></i>New Announcement</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Info</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $index => $article)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $article->title }}</td>
                                <td>
                                    <span class="label {{ $article->article_category_id == 1 ? 'label-info' : 'label-danger' }} label-pill label-inline">
                                        {{ $article->category->name }}
                                    </span>
                                </td>
                                <td>{{ $article->created_at->format('d F Y') }}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{ route('article.edit', $article) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                                        <form action="{{ route('article.delete', $article) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm confirm-delete"
                                                    data-name="{{ $article->title }}">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('.confirm-delete').click(function (e) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            Swal.fire({
                title: `Are you sure want delete "${name}"?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            e.preventDefault();
        });
    </script>
@endpush
