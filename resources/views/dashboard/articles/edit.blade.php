@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Edit Announcement {{ $article->title }}
                </h3>
            </div>
            <form action="{{ route('article.edit', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('dashboard.articles.partials.form-control')
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/pages/crud/forms/editors/summernote.js') }}"></script>
    <script>
        var KTSummernoteDemo = function () {
            var demos = function () {
                $('.summernote').summernote({
                    height: 500,
                    callbacks: {
                        onMediaDelete : function(target) {
                            deleteFile(target[0].src);
                        }
                    }
                });
            }
            return {
                init: function() {
                    demos();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTSummernoteDemo.init();
        });

        function deleteFile(src) {
            $.ajax({
                data: {src : src, "_token": "{{ csrf_token() }}",},
                type: "POST",
                url: '{{ route("delete.content.image") }}',
                cache: false,
                success: function(resp) {
                    console.log(resp)
                }
            });
        }
    </script>
@endpush
