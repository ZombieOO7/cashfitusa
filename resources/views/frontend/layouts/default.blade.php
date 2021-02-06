<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | {{config('app.name')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrfToken" id="csrfToken" content="{{ csrf_token() }}">
    @component('frontend.includes.headerInc')
    @endcomponent
</head>

<body>
    <!-- header-start -->
    @component('frontend.includes.header')
    @endcomponent

    @yield('content')
    <!-- header-end -->
    <!-- footer start -->
    @component('frontend.includes.footer')
    @endcomponent
    <!--/ footer end  -->
</body>
@component('frontend.includes.footerInc')
@endcomponent
</html>