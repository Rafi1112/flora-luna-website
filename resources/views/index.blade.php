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
                    <div class="d-flex float-left mr-3">
                        <img src="http://blossom-luna-website.test/templates/images/news-event-s.png" alt="">
                    </div>
                    <div class="p-2">
                        <div class="d-block">
                            <h4 class="font-size-h3 font-weight-bolder text-dark">Welcoming Spring Blossoms</h4>
                            <hr class="m-0">
                            <div class="d-flex mt-3">
                                <span class="label label-info label-pill label-inline mr-2">Event</span>
                                <p>14 July 2021, 16:40:09</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 card card-body border-0">
                        <img src="{{ asset('assets/media/bg0.jpeg') }}" alt="">
                        <p class="mt-5">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi pariatur aspernatur dolore cumque ad nobis necessitatibus fuga quis architecto adipisci tenetur esse doloremque aliquid ab deleniti magni illo totam incidunt optio sapiente, molestiae labore veniam sequi earum. Doloremque obcaecati nulla nisi magnam quis temporibus mollitia provident, rerum beatae illum sapiente aspernatur eaque voluptatum, fugiat consequatur, minus expedita ratione iste perspiciatis nobis dolore iusto eos reprehenderit. Enim quia commodi architecto libero consequuntur maiores itaque ducimus ipsam sed fugit. Facilis possimus animi consectetur placeat, numquam ut dolorum quos aperiam sed earum illo magnam mollitia? Dolorem magni esse rem enim aperiam eligendi optio quasi quod, rerum quia exercitationem, laboriosam assumenda distinctio et hic doloribus quibusdam. Sapiente, mollitia quae. Vel consectetur odio fugiat sed vero ad delectus labore, aut, animi perferendis sequi? Ab quia iure incidunt dolores repudiandae ea non voluptas iusto ut necessitatibus quibusdam mollitia suscipit repellendus possimus accusamus perferendis dignissimos sunt error, inventore expedita earum corporis praesentium, odit rem. Unde consequatur illo cumque molestiae non, explicabo pariatur cupiditate dicta iste voluptate voluptatem odio deleniti inventore consequuntur! Nemo quisquam culpa at sint, quod voluptas deleniti veniam nobis molestiae et laboriosam nesciunt? Et iste ducimus accusamus sit cupiditate, officia quam aliquid voluptates in sint nulla repellendus voluptatum laudantium vel, dolorum dolor sunt odio? Esse quae quos at voluptas aliquid reiciendis nostrum harum molestias molestiae ipsa incidunt quam, vitae inventore ex laboriosam ipsum nemo dolores perspiciatis cumque architecto temporibus. Reiciendis perspiciatis omnis tempore, laboriosam sint explicabo molestiae natus provident. Beatae voluptates molestias aspernatur consequatur dolor!
                        </p>
                    </div>
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
                                <tr>
                                    <td width="80"><span class="label label-info label-pill label-inline mr-2">Event</span></td>
                                    <td>Take me back to flora!</td>
                                    <td width="120">14 July 2021</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
