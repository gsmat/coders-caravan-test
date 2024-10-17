<!DOCTYPE html>
<html lang="en">
@include('dashboard.partials.head')
<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        @if(auth()->check() && auth()->user()->role == 'admin') 
            @include('dashboard.partials.sidebar')
        @else
            @include('users.partials.sidebar')
        @endif
        
        @include('dashboard.partials.header')

        <div id="layoutSidenav_content">
            @yield('content')
        </div>

        @include('dashboard.partials.footer')
    </div>
</body>
</html>
