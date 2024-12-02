<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sports &mdash;Shoppers</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    @include('client.layouts.partials.css')

</head>

<body>
    <div class="site-wrap">
        {{-- header --}}
        <header class="site-navbar" role="banner">
            
            @include('client.layouts.partials.header-top')\

            @include('client.layouts.partials.header-nav')
            
        </header>

        @yield('contents')
        
        {{-- footer --}}
        <footer class="site-footer border-top">

            @include('client.layouts.partials.footer')
            
        </footer>
    </div>

    @include('client.layouts.partials.js')

</body>

</html>
