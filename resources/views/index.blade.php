@extends('layouts.app')

@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">
                <div class="card card-custom mb-12">
                    <div class="card-body rounded p-0" style="background-color:#DAF0FD;">
                        <div id="carouselExConInd" class="carousel slide pointer-event" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExConInd" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExConInd" data-slide-to="1" class=""></li>
                                <li data-target="#carouselExConInd" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="http://blossom-luna-website.test/templates/images/loginrewards.jpg" class="w-100" alt="carousel">
                                </div>
                                <div class="carousel-item">
                                    <img src="http://blossom-luna-website.test/templates/images/new-allgacha-slider.png" class="w-100" alt="carousel">
                                </div>
                                <div class="carousel-item">
                                    <img src="http://blossom-luna-website.test/templates/images/slide-base-forums.png" class="w-100" alt="carousel">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExConInd" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExConInd" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    @foreach($articles->slice(0,1) as $article)
                    <div class="d-flex float-left mr-3">
                        <img src="http://blossom-luna-website.test/templates/images/news-event-s.png" alt="">
                    </div>
                    <div class="p-2">
                        <div class="d-block">
                            <h4 class="font-size-h3 font-weight-bolder text-dark">{{ $article->title }}</h4>
                            <hr class="m-0">
                            <div class="d-flex mt-3">
                                <span class="label {{ $article->article_category_id == 1 ? 'label-info' : 'label-danger' }} label-pill label-inline mr-2">{{ $article->category->name }}</span>
                                <p>{{ $article->created_at->format('d F Y, H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <p>
                            {!! nl2br($article->content) !!}
                        </p>
                    </div>
                    @endforeach
                    <div class="p-2">
                        <h2 class="font-size-h2 font-weight-bolder text-dark mb-5">Game Announcement</h2>
                        <div class="table-responsive">
                            <table class="table bg-gray-100">
                                <thead>
                                <tr>
                                    <th scope="col">Info</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($articles->slice(1, 6) as $article)
                                <tr>
                                    <td width="80">
                                        <span class="label {{ $article->article_category_id == 1 ? 'label-info' : 'label-danger' }} label-pill label-inline mr-2">
                                            {{ $article->category->name }}
                                        </span>
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td width="120">{{ $article->created_at->format('d F Y') }}</td>
                                </tr>
                                </tbody>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No announcement found.
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
