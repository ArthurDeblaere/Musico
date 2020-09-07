@extends('layouts.master')

@section('content')
<section class="blog_area section-padding" style="padding-top: 3%; padding-bottom: 3%">
    <div class="container" style="width: 90%; max-width: 100%">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0" style="width: 60%; flex: 0 0 60%; max-width: 60%">
                @if($albums && sizeof($albums)>0)
                    <div class="section_title text-center mb-65">
                        <h3>Albums</h3>
                    </div>
                    <div class="blog_left_sidebar">
                        @foreach($albums as $album)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{asset($album->cover)}}" alt="">
                                    <h3 class="blog_item_date">{{$album->genre}} - {{$album->year}}</h3>
                                <!--
                        <a href="#" class="blog_item_date">
                            <h3>{{$album->genre}}</h3>
                            <p>Jan</p>
                        </a>
                        -->
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{url('/albums/' . $album->id)}}">
                                        <h2>{{$album->name}}</h2>
                                    </a>
                                    <!--
                                    https://stackoverflow.com/questions/59641254/call-to-undefined-function-str-limit
                                    https://laracasts.com/discuss/channels/laravel/how-to-get-html-text-first-100-letters-without-affecting-the-other-display
                                    -->
                                    <p>{{\Illuminate\Support\Str::limit(strip_tags(file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')),100,'...')}}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p>No albums found!</p>
                @endif
                @if($artists && sizeof($artists)>0)
                    <div class="section_title text-center mb-65">
                        <h3>Artists</h3>
                    </div>
                    <div class="blog_left_sidebar">
                        @foreach($artists as $artist)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{asset($artist->profilepic)}}" alt="">
                                    <h3 class="blog_item_date">{{$artist->age}}</h3>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{url('/artists/' . $artist->id)}}">
                                        <h2>{{$artist->firstname}} {{$artist->lastname}}</h2>
                                    </a>
                                    <!--
                                    https://stackoverflow.com/questions/59641254/call-to-undefined-function-str-limit
                                    https://laracasts.com/discuss/channels/laravel/how-to-get-html-text-first-100-letters-without-affecting-the-other-display
                                    -->
                                    <p>{{\Illuminate\Support\Str::limit(strip_tags(file_get_contents('storage/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.txt')),100,'...')}}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p>No artists found!</p>
                @endif
                @if($bands && sizeof($bands)>0)
                    <div class="section_title text-center mb-65">
                        <h3>Bands</h3>
                    </div>
                    <div class="blog_left_sidebar">
                        @foreach($bands as $band)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{asset($band->profilepic)}}" alt="">
                                    <h3 class="blog_item_date">{{$band->genre}}</h3>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{url('/bands/' . $band->id)}}">
                                        <h2>{{$band->name}}</h2>
                                    </a>
                                    <!--
                                    https://stackoverflow.com/questions/59641254/call-to-undefined-function-str-limit
                                    https://laracasts.com/discuss/channels/laravel/how-to-get-html-text-first-100-letters-without-affecting-the-other-display
                                    -->
                                    <p>{{\Illuminate\Support\Str::limit(strip_tags(file_get_contents('storage/access/descriptions/bands/' . strtolower($band->name) . '.txt')),100,'...')}}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p>No bands found!</p>
                @endif
            </div>
            <form action="{{url('/search')}}" method="post" style="width: 35%; margin: 0 auto">
                @csrf
                <div class="col-lg-3 col-md-4 mt-sm-30" style="width: 100%; max-width: 100%; float: right">
                    <div class="single-element-widget" style="overflow-y: hidden; overflow-x: hidden; width: 100%;">
                        <h3 class="mb-30">Search</h3>
                            <input type="text" name="input" @if($input)value="{{$input}}"@else value="" @endif placeholder="Search term">
                    </div>
                    <div class="single-element-widget" style="overflow-y: hidden; overflow-x: hidden; width: 100%;">
                        <h3 class="mb-30">Choose category</h3>
                        <div class="switch-wrap d-flex justify-content-between" style="width: 40%">
                            <p>Album</p>
                            <div class="primary-checkbox" style="margin-right: 20px">
                                <input name="checkboxes[]" type="checkbox" id="album-checkbox"
                                       value="1" @if($checks && in_array('1', $checks)) checked @endif>
                                <label for="album-checkbox"></label>
                            </div>
                        </div>
                        <div class="switch-wrap d-flex justify-content-between" style="width: 40%">
                            <p>Artist</p>
                            <div class="primary-checkbox" style="margin-right: 20px">
                                <input name="checkboxes[]" type="checkbox" id="artist-checkbox"
                                       value="2" @if($checks && in_array('2', $checks)) checked @endif>
                                <label for="artist-checkbox"></label>
                            </div>
                        </div>
                        <div class="switch-wrap d-flex justify-content-between" style="width: 40%">
                            <p>Bands</p>
                            <div class="primary-checkbox" style="margin-right: 20px">
                                <input name="checkboxes[]" type="checkbox" id="band-checkbox"
                                       value="3" @if($checks && in_array('3', $checks)) checked @endif>
                                <label for="band-checkbox"></label>
                            </div>
                        </div>
                    </div>
                    <button style="margin: 30px" class="genric-btn primary" type="submit">SEARCH</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
