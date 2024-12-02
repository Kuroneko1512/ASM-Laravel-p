<div class="site-navbar-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                <form action="{{ route('search.product') }}" class="site-block-top-search" method="GET">
                    <span class="icon icon-search2"></span>
                    <input type="text" class="form-control border-0" placeholder="Search" name="search" />
                </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                <div class="site-logo">
                    <a href="{{ route('home') }}" class="js-logo-clone">Hydra</a>
                </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                <div class="site-top-icons">
                    <ul class="">
                        
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon icon-person"></span>
                                @if (Auth::check())
                                    {{ Auth::user()->username }}
                                @endif
                                
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::check())
                                    <li class="dropdown-item">
                                        <a href="{{ route('dashboard') }}">Thông Tin</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('logout') }}">Đăng xuất</a>
                                    </li>
                                @else
                                    <li class="dropdown-item">
                                        <a href="{{ route('login') }}">Đăng nhập</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('register') }}">Đăng ký</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="icon icon-heart-o"></span></a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}" class="site-cart">
                                <span class="icon icon-shopping_cart"></span>
                                <span class="count cart-count">{{ session()->get('cart_count', 0) }}</span>
                            </a>
                        </li>
                        <li class="d-inline-block d-md-none ml-md-0">
                            <a href="#" class="site-menu-toggle js-menu-toggle"><span
                                    class="icon-menu"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
