<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <div class="container">
        <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default header-menu-root-arrow">
            <ul class="menu-nav">
                <li class="menu-item {{ Request::is('/') ? 'menu-item-here' : '' }}">
                    <a href="{{ route('index') }}" class="menu-link">
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Community</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Forums</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Discord</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Game Guide</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Getting Started</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Zone Guide</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Rankings</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Top Players</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Top Guilds</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item {{ Request::is('itemshop') ? 'menu-item-here' : '' }}">
                    <a href="{{ route('store') }}" class="menu-link">
                        <span class="menu-text">Item Store</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Media</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Screenshots</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Wallpapers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item" data-menu-toggle="click" aria-haspopup="true">
                    <a href="/" class="menu-link menu-toggle">
                        <span class="menu-text">Terms of Service</span>
                    </a>
                </li>
                <li class="menu-item" data-menu-toggle="click" aria-haspopup="true">
                    <a href="/" class="menu-link menu-toggle">
                        <span class="menu-text">Help</span>
                    </a>
                </li>
                @hasanyrole('Game Master|Moderator')
                <li class="menu-item menu-item-submenu menu-item-rel menu-item-open-dropdown
                    {{ Request::segment(1) === 'p' ? 'menu-item-open menu-item-here' : '' }}"
                    data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Dashboard</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                                    <span class="menu-text">Orders</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">List Gems Orders</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">List Items Orders</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <div class="menu-icon"><i class="fas fa-user-friends"></i></div>
                                    <span class="menu-text">List Players</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-icon"><i class="fas fa-donate"></i></span>
                                    <span class="menu-text">Gems</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Gems Price</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Recharge Gems</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu {{ Request::segment(2) === 'announcement' ? 'menu-item-open menu-item-here' : '' }}"
                                data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-icon"><i class="fas fa-newspaper"></i></span>
                                    <span class="menu-text">Announcement</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item {{ Request::segment(3) === '/' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('article.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">List Announcement</span>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ Request::segment(3) === 'create' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('article.create') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Create Announcement</span>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ Request::segment(3) === 'category' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('article.category') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Category Announcement</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu {{ Request::segment(2) === 'product' ? 'menu-item-open menu-item-here' : '' }}"
                                data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-icon"><i class="fas fa-cubes"></i></span>
                                    <span class="menu-text">Product</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">List Product</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">List Item</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Create Product</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="#" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Create Item</span>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ Request::segment(3) === 'category' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('product.category.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu {{ Request::segment(2) === 'role-permission' ? 'menu-item-open menu-item-here' : '' }}"
                                data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-icon"><i class="fas fa-exchange-alt"></i></span>
                                    <span class="menu-text">Role and Permission</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item {{ Request::segment(3) === 'role' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('role.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Role</span>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ Request::segment(3) === 'permission' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('permission.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Permission</span>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ Request::segment(3) === 'sync' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('sync.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Synchronize Role Permission</span>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ Request::segment(3) === 'user-role' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('user.role') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">User Role</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
            </ul>
        </div>
    </div>
</div>
