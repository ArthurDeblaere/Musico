@extends('layouts.master')

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list" style="width: 100%; max-width: 100%; flex: 0 0 100%">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{asset($album->cover)}}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{$album->name}} by <a href="/bands/{{$album->band->id}}"><h2>{{$album->band->name}}</h2></a>
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li>{{$album->genre}}</li>
                                <li>{{$album->year}}</li>
                            </ul>
                            <p class="excert">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                                should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                                fraction of the camp price. However, who has the willpower
                            </p>
                            <p>{{file_get_contents($albumDescription)}}</p>
                            <div class="quote-wrapper">
                                <div class="quotes">
                                    MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                                    should have to spend money on boot camp when you can get the MCSE study materials yourself at
                                    a fraction of the camp price. However, who has the willpower to actually sit through a
                                    self-imposed MCSE training.
                                </div>
                            </div>
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                                should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                                fraction of the camp price. However, who has the willpower
                            </p>
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                                should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                                fraction of the camp price. However, who has the willpower to actually sit through a
                                self-imposed MCSE training. who has the willpower to actually
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
@endsection
