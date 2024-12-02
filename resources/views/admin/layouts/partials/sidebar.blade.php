<div class="d-flex flex-column p-3 text-white">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Admin Panel</span>
    </a>
    <hr>

    <!-- Main Navigation Menu -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-dashboard me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="" class="nav-link text-white">
                <i class="fa fa-list me-2"></i>
                Categories
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}" class="nav-link text-white">
                <i class="fa fa-box me-2"></i>
                Products
            </a>
        </li>
        <li>
            <a href="" class="nav-link text-white">
                <i class="fa fa-shopping-cart me-2"></i>
                Orders
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}" class="nav-link text-white">
                <i class="fa fa-users me-2"></i>
                Users
            </a>
        </li>
    </ul>

    <!-- User Profile & Logout Section -->
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.auth()->user()->fullname }}" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ auth()->user()->fullname }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="GET">
                    @csrf
                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>
</div>
