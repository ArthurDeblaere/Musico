@extends('layouts.master')

@section('content')
    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                <div class="row">
                    <form method="post"
                          @if($artist)
                          action="{{url('/artists/' .$artist->id . '/edit')}}"
                          @else
                          action="{{url('/artist/add')}}"
                          @endif
                          style="width: 100%" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8 col-md-8" style="width: 60%">
                            <h3 class="mb-30">@if($artist)Edit artist page ({{$artist->firstname}} {{$artist->lastname}})@else Add artist page @endif</h3>
                            <div class="mt-10">
                                <input type="text" name="firstname" placeholder="@if($artist){{$artist->firstname}}@else Artist Firstname @endif"
                                       onfocus="this.placeholder = @if($artist){{$artist->firstname}}@else 'Artist Firstname' @endif"
                                       onblur="this.placeholder = @if($artist){{$artist->firstname}}@else 'Artist Firstname' @endif" required
                                       class="single-input" @if($artist)value="{{$artist->firstname}} @endif">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="lastname" placeholder="@if($artist){{$artist->lastname}}@else Artist Lastname @endif"
                                       onfocus="this.placeholder = @if($artist){{$artist->lastname}}@else 'Artist Lastname' @endif"
                                       onblur="this.placeholder = @if($artist){{$artist->lastname}}@else 'Artist Lastname' @endif" required
                                       class="single-input" @if($artist)value="{{$artist->lastname}}@endif">
                            </div>
                            <div class="mt-10">
                                <input type="number" name="age" placeholder="@if($artist){{$artist->age}}@else Artist Age @endif"
                                       onfocus="this.placeholder = @if($artist){{$artist->age}}@else '0' @endif"
                                       onblur="this.placeholder =@if($artist){{$artist->age}}@else '0' @endif "
                                       min="1" max="120" required
                                       class="single-input" @if($artist)value="{{$artist->age}}@else '0' @endif">
                            </div>
                            <!--
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                                <input type="text" hidden name="password" placeholder="Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Password'" required class="single-input">
                            </div>
                            -->
                            <div class="mt-10">
                                    <textarea name="description" class="single-textarea" placeholder="@if($artist){{file_get_contents('storage/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname).'.txt')}}@else Description @endif"
                                              onfocus="this.placeholder = @if($artist){{file_get_contents('storage/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname).'.txt')}}@else 'Description'@endif"
                                              onblur="this.placeholder = @if($artist){{file_get_contents('storage/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname).'.txt')}}@else 'Description'@endif"
                                              required>@if($artist){{file_get_contents('storage/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname).'.txt')}}@endif</textarea>
                            </div>
                            <div class="mt-10">
                                <label for="uploadfile">Artist profile picture</label>
                                <input type="file" name="artist_pic" id="uploadfile">
                            </div>
                            <div class="mt-10">
                                <label for="uploadbackground">Artist background picture</label>
                                <input type="file" name="artist_background" id="uploadbackground">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 mt-sm-30" style="width: 40%; max-width: 100%">
                            <div class="single-element-widget" style="overflow-y:scroll; overflow-x: hidden; width: 100%;height: 400px">
                                <h3 class="mb-30">BAND(S)</h3>
                                @foreach($bands as $band)
                                    <div class="switch-wrap d-flex justify-content-between">
                                        <p>{{$band->name}}</p>
                                        <div class="primary-checkbox" style="margin-right: 20px">
                                            <input name="band_checkboxes[]" type="checkbox" id="{{$band->name}}-checkbox"
                                                   value="{{$band->id}}" @if($artist)@if($artist->checkbands($band)) checked @endif @endif>
                                            <label for="{{$band->name}}-checkbox"></label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button style="margin: 30px" class="genric-btn primary" type="submit">SAVE PAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
