@extends('layouts.master')

@section('content')
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="row">
                <form method="post"
                      @if($album)
                      action="{{url('/albums/' .$album->id . '/edit')}}"
                      @else
                      action="{{url('/album/add')}}"
                      @endif
                      style="width: 100%" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">@if($album)Edit album page ({{$album->name}})@else Add album page @endif</h3>
                            <div class="mt-10">
                                <input type="text" name="name" placeholder="@if($album){{$album->name}}@else Album Name @endif"
                                       onfocus="this.placeholder = @if($album){{$album->name}}@else 'Album Name'@endif"
                                       onblur="this.placeholder =  @if($album){{$album->name}}@else 'Album Name'@endif" required
                                       class="single-input" @if($album)value="{{$album->name}}@endif">
                            </div>
                            <div class="mt-10">
                                <input type="number" name="year" placeholder="@if($album){{$album->year}}@else{{now()->year}}@endif"
                                       onfocus="this.placeholder = @if($album){{$album->year}}@else '{{now()->year}}'@endif" onblur="this.placeholder =@if($album){{$album->year}}@else '{{now()->year}}'@endif"
                                       min="1" max="{{ now()->year }}" required
                                       class="single-input" value="@if($album){{$album->year}}@else '{{now()->year}}'@endif">
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-music" aria-hidden="true"></i></div>
                                <input type="text" name="genre" placeholder="@if($album){{$album->genre}}@else Genre @endif" onfocus="this.placeholder = @if($album){{$album->genre}}@else'Genre'@endif"
                                       onblur="this.placeholder = @if($album){{$album->genre}}@else 'Genre' @endif" required
                                       class="single-input" @if($album)value="{{$album->genre}}@endif">
                            </div>

                            <div class="mt-10">
                                    <textarea name="description" class="single-textarea" placeholder="@if($album){{file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')}}@else Description @endif"
                                              onfocus="this.placeholder = @if($album){{file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')}}@else 'Description'@endif"
                                              onblur="this.placeholder = @if($album){{file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')}}@else 'Description'@endif"
                                              value="@if($album){{file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')}}@else Description @endif"
                                              required>@if($album){{file_get_contents('storage/access/descriptions/albums/' . strtolower($album->name) . '.txt')}}@endif</textarea>
                            </div>
                            <div class="mt-10">
                                <label for="uploadfile">Album cover</label>
                                <input type="file" name="album_cover" id="uploadfile">
                            </div>

                    </div>
                    <div class="col-lg-3 col-md-4 mt-sm-30">
                        <div class="single-element-widget">
                            <h3 class="mb-30">BAND</h3>
                            <div class="input-group-icon mt-10">
                                <input @if($album)value="{{$album->band->name}}@endif" name="band_name" class="typeahead form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <button style="margin: 30px" class="genric-btn primary" type="submit">SAVE PAGE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
