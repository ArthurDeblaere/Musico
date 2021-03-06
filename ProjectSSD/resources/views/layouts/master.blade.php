<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Musico</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("img/favicon.png")}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/themify-icons.css")}}">
    <link rel="stylesheet" href="{{asset("css/nice-select.css")}}">
    <link rel="stylesheet" href="{{asset("css/audioplayer.css")}}">
    <link rel="stylesheet" href="{{asset("css/flaticon.css")}}">
    <link rel="stylesheet" href="{{asset("css/gijgo.css")}}">
    <link rel="stylesheet" href="{{asset("css/animate.css")}}">
    <link rel="stylesheet" href="{{asset("css/slick.css")}}">
    <link rel="stylesheet" href="{{asset("css/slicknav.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <!-- <link rel="stylesheet" href="{{asset("css/responsive.css")}}"> -->
    <!-- extra stylesheets -->
    <link rel="stylesheet" href="{{url("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css")}}">
</head>

<body>
<!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="{{url("https://browsehappy.com/")}}">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="/">
                                    <img src="{{asset("img/logo.png")}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="{{url('/')}}/">Home</a></li>
                                        <!--
                                        <li><a href="{{url('/artists')}}">Artists</a></li>
                                        <li><a href="{{url('/albums')}}">Albums</a></li>
                                        -->
                                        @auth()
                                        @if($user->role->type != 'guest')
                                        <li style="color: white; font-family: 'Josefin Sans'; font-size: 15px">Add page <i class="ti-angle-down"></i>
                                            <ul class="submenu">
                                                <li><a href="/album/add">Add album page</a></li>
                                                <li><a href="/artist/add">Add artist page</a></li>
                                                <li><a href="/band/add">Add band page</a></li>
                                            </ul>
                                        </li>
                                        @endif
                                        @endauth
                                        <li><a class="active" href="{{url('/search')}}/">Search</a></li>
                                        @auth()
                                            <li style="color: white; font-family: 'Josefin Sans'; font-size: 15px">User: {{$user->name}}</li>
                                            <li><a href="{{url('/logout')}}">Log out</a></li>
                                        @else
                                            <li><a href="{{url('/login')}}">Log in</a></li>
                                            <li><a href="{{url('/register')}}">Register</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="social_icon text-right">
                                <ul>
                                    <li><a href="/"> <i class="fa fa-facebook"></i> </a></li>
                                    <li><a href="/"> <i class="fa fa-twitter"></i> </a></li>
                                    <li><a href="/"> <i class="fa fa-instagram"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header-end -->

<!-- bradcam_area  -->
<div class="bradcam_area breadcam_bg_2" style="background-image:url('{{asset($backgroundimage)}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>{{$bradcamname}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->
@include('common.errors') {{-- visualizes the $errors array --}}

@yield('content')

@auth()
@if($editable && $user->role->type != 'guest')
    <a style="margin: 0px 20px 20px 500px;" href="{{Request::url() . '/edit'}}" class="genric-btn default"><h2>Edit this page</h2></a>
    @if($user->role->type == 'admin')
    <a style="margin: 0px 20px 20px 20px; color: red" href="{{Request::url() . '/delete'}}" onclick="return confirm('Are you sure?')" class="genric-btn default"><h2>Delete this page</h2></a>
    @endif
@endif
@endauth
<!-- footer start -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-5 offset-xl-1">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Contact Me
                        </h3>
                        <ul>
                            <li><a href="/">arthur.deblaere@student.odisee.be
                                </a></li>
                            <li><a href="/">+324 97 14 89 66
                                </a></li>
                            <li><a href="/">Gebroeders de Smetstraat 1, 9000 Gent</a></li>
                        </ul>
                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="/">
                                        <i class=" fa fa-facebook "></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="/">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="/">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="/">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="/">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-7 col-md-6">
                    <p class="copy_right">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="footer_links">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">about</a></li>
                            <li><a href="#">tracks</a></li>
                            <li><a href="#">blog</a></li>
                            <li><a href="#">contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/ footer end  -->

<!-- link that opens popup -->

<!-- JS here -->
<script src="{{url("https://code.jquery.com/jquery-3.3.1.slim.min.js")}}"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous">
</script>
<script src="{{asset("js/vendor/modernizr-3.5.0.min.js")}}"></script>
<script src="{{asset("js/vendor/jquery-1.12.4.min.js")}}"></script>
<script src="{{asset("js/popper.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script src="{{asset("js/isotope.pkgd.min.js")}}"></script>
<script src="{{asset("js/ajax-form.js")}}"></script>
<script src="{{asset("js/waypoints.min.js")}}"></script>
<script src="{{asset("js/jquery.counterup.min.js")}}"></script>
<script src="{{asset("js/imagesloaded.pkgd.min.js")}}"></script>
<script src="{{asset("js/audioplayer.js")}}"></script>
<script src="{{asset("js/scrollIt.js")}}"></script>
<script src="{{asset("js/jquery.scrollUp.min.js")}}"></script>
<script src="{{asset("js/wow.min.js")}}"></script>
<script src="{{asset("js/nice-select.min.js")}}"></script>
<script src="{{asset("js/jquery.slicknav.min.js")}}"></script>
<script src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("js/plugins.js")}}"></script>
<script src="{{asset("js/gijgo.min.js")}}"></script>
<script src="{{asset("js/slick.min.js")}}"></script>
<!--contact js-
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>
-->

<script src="{{asset("js/main.js")}}"></script>

<!--type ahead scripts-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script>
    $(function() {
        $('audio').audioPlayer({

        });
    });
</script>

<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
</body>

</html>
