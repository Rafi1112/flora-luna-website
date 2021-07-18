<div id="kt_header_mobile" class="header-mobile">
    <a href="/">
        <img alt="Logo" src="{{ asset('assets/media/logos/logo-default.png') }}" class="max-h-30px" />
    </a>
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <a href="#" class="btn p-0 ml-2">
            <span class="svg-icon svg-icon-xl">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
            </span>
        </a>
    </div>
</div>


<div id="kt_header" class="header header-fixed">
    <div class="container">
        <div class="d-none d-lg-flex align-items-center mr-3">
            <a href="/" class="mr-20">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-default.png') }}" class="logo-default max-h-35px" />
            </a>
        </div>

        @auth
            <div class="topbar topbar-minimize">
                <div class="dropdown">
                    <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                        <div class="btn btn-icon btn-clean h-40px w-40px btn-dropdown">
                        <span class="svg-icon svg-icon-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                        <div class="d-flex align-items-center p-8 rounded-top">
                            <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->username }}</div>
                            <span class="label label-primary label-lg font-weight-bold label-inline">{{ Auth::user()->balance }} &nbsp; <img src="{{ asset('assets/media/gem-coin.png') }}"></span>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="navi navi-spacer-x-0 pt-5">
                            <a href="#" class="navi-item px-8">
                                <div class="navi-link">
                                    <div class="navi-icon mr-2">
                                        <i class="flaticon2-calendar-3 text-success"></i>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold">My Profile</div>
                                        <div class="text-muted">Account settings and more</div>
                                    </div>
                                </div>
                            </a>
                            <div class="navi-separator mt-3"></div>
                            <div class="navi-footer px-8 py-5">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-light-primary font-weight-bold">Logout</button>
                                </form>
                                <a href="#" target="_blank" class="btn btn-clean font-weight-bold">Purchase Gems</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</div>

