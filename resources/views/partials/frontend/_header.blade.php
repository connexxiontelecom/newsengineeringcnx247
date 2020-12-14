
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ERP software of choice" />
    <meta name="keywords" content="Saas, ERP software, Saas application" />
    <meta name="author" content="Connexxion Group" />
    <meta name="email" content="info@cnx247.com" />
    <meta name="website" content="http://www.cnx247.com" />
    <meta name="Version" content="v2.5.1" />
    <link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/frontend/css/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('/frontend/css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/frontend/css/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/frontend/css/flexslider.css')}}" type="text/css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">

    <link href="{{asset('/frontend/css/style.css')}}" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{asset('/frontend/css/colors/default.css')}}" rel="stylesheet" id="color-opt">
    <link href="{{asset('/frontend/css/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/frontend/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />

    @yield('extra-styles')
    @livewireStyles
</head>
