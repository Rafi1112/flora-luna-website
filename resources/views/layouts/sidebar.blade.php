<div class="col-xl-4">
    <div class="card card-custom gutter-b">
        <div class="card-header border-0 pt-5 justify-content-center align-items-center">
            <div class="d-flex mr-2">
                <img src="{{ asset('assets/media/baby.png') }}" alt="icon-member">
            </div>
            <h3 class="card-title pt-2">
                <span class="font-size-h3 font-weight-bolder text-dark">Member Panel</span>
            </h3>
        </div>
        <div class="card-body pt-5">
            @auth
                <div>
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td>{{ Auth::user()->username }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                {{ substr(Auth::user()->email, 0, 2).'**'.substr(Auth::user()->email, strpos(Auth::user()->email, "@")) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Balance</td>
                            <td>:</td>
                            <td class="d-flex align-items-center">{{ Auth::user()->balance }} <img src="{{ asset('assets/media/gem-coin.png') }}" class="ml-1"> </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <a href="{{ route('account') }}" class="btn btn-primary btn-block font-weight-bolder btn-sm">Account Setting</a>
                    <a href="#" class="btn btn-primary btn-block font-weight-bolder btn-sm">History</a>
                    <a href="#" class="btn btn-success btn-block font-weight-bolder btn-sm">Purchase Gems</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block font-weight-bolder btn-sm mt-2">Logout</button>
                    </form>
                </div>
            @else
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-block font-weight-bolder btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-light-success btn-block font-weight-bolder btn-sm">Register</a>
            </div>
            @endauth
        </div>
    </div>
    <div class="card card-custom gutter-b">
        <div class="card-header justify-content-center border-0 pt-5">
            <h3 class="card-title flex-column mb-5">
                <span class="font-size-h3 font-weight-bolder text-dark">Featured items</span>
            </h3>
        </div>
        <div class="card-body pt-2">
            <div id="carouselExCap" class="carousel slide pointer-event" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <div class="d-block">
                            <img src="{{ asset('assets/media/bachelor_h.png') }}" class="rounded mx-auto d-block" style="width:160px;height:auto;" alt="...">
                        </div>
                        <div class="d-block text-center">
                            <div class="d-block mt-2"><span class="card-label font-weight-bolder text-dark">Bachelor</span></div>
                            <a href="#" class="btn btn-sm btn-primary mt-2">150 <img src="{{ asset('assets/media/gem-coin.png') }}"></a>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <div class="d-block">
                            <img src="{{ asset('assets/media/costume_bwl_h.png') }}" class="rounded mx-auto d-block" style="width:160px;height:auto;" alt="...">
                        </div>
                        <div class="d-block text-center">
                            <div class="d-block mt-2"><span class="card-label font-weight-bolder text-dark">BWL</span></div>
                            <a href="#" class="btn btn-sm btn-primary mt-2">200 <img src="{{ asset('assets/media/gem-coin.png') }}"></a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExCap" role="button" data-slide="prev">
                    <em class="fas fa-arrow-alt-circle-left text-dark"></em>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExCap" role="button" data-slide="next">
                    <em class="fas fa-arrow-alt-circle-right text-dark"></em>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
