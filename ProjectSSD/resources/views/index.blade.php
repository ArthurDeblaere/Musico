@extends('layouts.master')
@section('content')

    <!--================Albums Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($albums as $album)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{asset($album->cover)}}" alt="">
                                    <h3 class="blog_item_date">{{$album->genre}}</h3>
                                <!--
                                <a href="#" class="blog_item_date">
                                    <h3>{{$album->genre}}</h3>
                                    <p>Jan</p>
                                </a>
                                -->
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{url('/albums/' . $album->id)}}">
                                        <h2>{{$album->name}} by</h2>
                                    </a>
                                    <a class="d-inline-block" href="{{url('/bands/' . $album->band->id)}}">
                                        <h2>{{$album->band->name}}</h2>
                                    </a>
                                    <p>{{file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')}}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Artists</h4>
                            <ul class="list cat-list">
                                @foreach($artists as $artist)
                                <li>
                                    <a href="{{url('/artists/' . $artist->id)}}" class="d-flex">
                                        <p>{{$artist->firstname}} {{$artist->lastname}}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Bands</h4>
                            <ul class="list cat-list">
                                @foreach($bands as $band)
                                    <li>
                                        <a href="{{url('/bands/' . $band->id)}}" class="d-flex">
                                            <p>{{$band->name}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Albums Area =================-->
@endsection
