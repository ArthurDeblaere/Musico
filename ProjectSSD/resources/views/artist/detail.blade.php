@extends('layouts.master')

@section('content')


    <!-- about_area  -->
    <div class="about_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-md-6" style="width: 100%">
                    <div class="about_thumb">
                        <img class="img-fluid" src="{{asset($artist->profilepic)}}" alt="">
                    </div>
                </div>
                <div class="col-xl-7 col-md-6">
                    <div class="about_info">
                        <h3>{{$artist->firstname}} {{$artist->lastname}}</h3>
                        <p>{{file_get_contents($artistDescription)}}</p>
                        <div class="signature">
                            <img src="{{$signature}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--================Band Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0" style="width: 100%; flex: 0 0 100%; max-width: 100%">
                    <div class="blog_left_sidebar">
                        @foreach($bands as $band)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{asset($band->profilepic)}}" alt="">
                                <h3 class="blog_item_date">{{$band->genre}}</h3>
                                <!--
                                <a href="#" class="blog_item_date">
                                    <h3>{{$band->genre}}</h3>
                                    <p>Jan</p>
                                </a>
                                -->
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{url('/bands/' . $band->id)}}">
                                    <h2>{{$band->name}}</h2>
                                </a>
                                <p>{{file_get_contents('storage/access/descriptions/bands/' . strtolower($band->name) . '.txt')}}</p>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Bands Area =================-->

    @if(sizeof($images)>0)
    <!-- imagegallery-->
    <div class="gallery_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12" style="width: 100%">
                    <div class="section_title text-center mb-65">
                        <h3>Image Galleries</h3>
                    </div>
                </div>
            </div>
            <div class="row grid">
                @foreach($images as $image)
                <div class="col-xl-5 col-lg-5 grid-item cat1 col-md-5">
                    <div class="single-gallery mb-30">
                        <div class="portfolio-img">
                            <img src="{{asset($image)}}" alt="">
                        </div>
                        <div class="gallery_hover">
                            <a  class="popup-image"  href="{{asset($image)}}" class="hover_inner">
                                <i class="ti-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--/ imagegallery -->
    @endif
@endsection()
