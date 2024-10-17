@auth
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Home
                </a>
                <div class="sb-sidenav-menu-heading">Shop</div>
                <a class="nav-link" href="{{route('user.products')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                </a>
                <a class="nav-link" href="{{ route('user.basket.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                    Cart
                </a>
                <a class="nav-link" href="{{ route('user.order.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                    My orders
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }} {{-- İstifadəçinin adını burada göstərin --}}
        </div>
    </nav>
</div>
@endauth
