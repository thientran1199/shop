<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title','Master Page')</title>
    <link href="{{ url ('home/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url ('home/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ url ('home/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ url ('home/css/price-range.css')}}" rel="stylesheet">
    <link href="{{ url ('home/css/animate.css')}}" rel="stylesheet">
    <link href="{{ url ('home/css/main.css')}}" rel="stylesheet">
    <link href="{{ url ('home/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ url ('home/js/html5shiv.js')}}"></script>
    <script src="{{ url ('home/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ url ('easyzoom/css/easyzoom.css')}}" />
    <link rel="stylesheet" href="{{ url ('style.css') }}" />
</head><!--/head-->

<body>
@include('frontEnd.layouts.header')
@section('slider')
    @include('frontEnd.layouts.slider')
@show
@yield('content')
@include('frontEnd.layouts.footer')
<script src="{{ url ('home/js/jquery.js')}}"></script>
<script src="{{ url ('home/js/bootstrap.min.js')}}"></script>
<script src="{{ url ('home/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{ url ('home/js/price-range.js')}}"></script>
<script src="{{ url ('home/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{ url ('home/js/main.js')}}"></script>
<script src="{{ url ('easyzoom/dist/easyzoom.js')}}"></script>
<script>
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);

        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });
</script>
</body>
</html>
