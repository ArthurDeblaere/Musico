@extends('layouts.master')

@section('content')
    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                <div class="row">
                    <form method="post"
                          @if($band)
                          action="{{url('/bands/' .$band->id . '/edit')}}"
                          @else
                          action="{{url('/band/add')}}"
                          @endif
                          style="width: 100%" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8 col-md-8" style="width: 60%">
                            <h3 class="mb-30">@if($band)Edit band page ({{$band->name}})@else Add band page @endif</h3>
                            <div class="mt-10">
                                <input type="text" name="name" placeholder="@if($band){{$band->name}}@else Band Name @endif"
                                       onfocus="this.placeholder = @if($band){{$band->name}}@else''@endif"
                                       onblur="this.placeholder = @if($band){{$band->name}}@else'Band Name'@endif" required
                                       class="single-input" @if($band)value="{{$band->name}}@endif">
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-music" aria-hidden="true"></i></div>
                                <input type="text" name="genre" placeholder="@if($band){{$band->genre}}@else Genre @endif"
                                       onfocus="this.placeholder = @if($band){{$band->genre}}@else''@endif"
                                       onblur="this.placeholder = @if($band){{$band->genre}}@else'Genre'@endif"
                                       required class="single-input" @if($band)value="{{$band->genre}}@endif">
                            </div>
                            <!--
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                                <input type="text" hidden name="password" placeholder="Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Password'" required class="single-input">
                            </div>
                            -->
                            <div class="mt-10">
                                    <textarea name="description" class="single-textarea"
                                              placeholder="@if($band){{file_get_contents('storage/access/descriptions/bands/' . strtolower($band->name) . '.txt')}}@else Description @endif"
                                              onfocus="this.placeholder = @if($band){{file_get_contents('storage/access/descriptions/bands/' . strtolower($band->name) . '.txt')}}@else 'Description'@endif"
                                              onblur="this.placeholder = @if($band){{file_get_contents('storage/access/descriptions/bands/' . strtolower($band->name) . '.txt')}}@else 'Description'@endif"
                                              required>@if($band){{file_get_contents('storage/access/descriptions/bands/' . strtolower($band->name) . '.txt')}}@endif</textarea>
                            </div>
                            <div class="mt-10">
                                <label for="uploadfile">Band profile picture</label>
                                <input type="file" name="band_pic" id="uploadfile">
                            </div>
                            <div class="mt-10">
                                <label for="uploadbackground">Band background picture</label>
                                <input type="file" name="band_background" id="uploadbackground">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 mt-sm-30" style="width: 40%; max-width: 100%">
                            <div class="single-element-widget" style="overflow-y:scroll; overflow-x: hidden; width: 100%;height: 400px">
                                <h3 class="mb-30">ARTIST(S)</h3>
                                @foreach($artists as $artist)
                                    <div class="switch-wrap d-flex justify-content-between">
                                        <p>{{$artist->firstname}} {{$artist->lastname}}</p>
                                        <div class="primary-checkbox" style="margin-right: 20px">
                                            <input name="artist_checkboxes[]" type="checkbox" id="{{$artist->firstname}}{{$artist->lastname}}-checkbox"
                                                   value="{{$artist->id}}" @if($band)@if($band->checkartists($artist)) checked @endif @endif>
                                            <label for="{{$artist->firstname}}{{$artist->lastname}}-checkbox"></label>
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
