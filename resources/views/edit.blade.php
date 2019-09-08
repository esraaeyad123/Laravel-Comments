@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="http://odyniec.net/projects/imgareaselect/css/imgareaselect-animated.css"/>
    <script src="http://odyniec.net/projects/imgareaselect/css/imgareaselect-animated.css"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src='http://odyniec.net/projects/imgareaselect/jquery.imgareaselect.pack.js'></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/imgareaselect.css') }}">
    <link rel="stylesheet" href="{{ asset('css/imgareaselect-animated.css') }}">
    <link rel="stylesheet" href="{{ asset('css/imgareaselect-deprecated.css') }}">
@endsection

@section('content')

    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
    <form method="post"  enctype="multipart/form-data" action="{{route("image.update",['id' => $Details->id]) }}"  >
@method('PATCH')
        @csrf
    <div class="container mt-5">


        <div class="form-group">
                <label for="exampleInputImage">Image:</label>
                <input type="file" name="profile_image" id="exampleInputImage" class="image" required>
                <input type="hidden" name="x1" value="" />
                <input type="hidden" name="y1" value="" />
                <input type="hidden" name="w" value="" />
                <input type="hidden" name="h" value="" />
            </div>
            <textarea class="textarea" id="description" name="description" rows="10">{{ $Details->description }}

            </textarea>


            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
        </form>
        <div class="row mt-5">
            <p><img id="previewimage" style="display:none;"/></p>
            @if(session('path'))
                <img src="{{ session('path') }}" />
            @endif
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.imgareaselect.min.js') }}"></script>
    <script>
        jQuery(function($) {

            var p = $("#previewimage");
            $("body").on("change", ".image", function(){

                var imageReader = new FileReader();
                imageReader.readAsDataURL(document.querySelector(".image").files[0]);

                imageReader.onload = function (oFREvent) {
                    p.attr('src', oFREvent.target.result).fadeIn();
                };
            });

            $('#previewimage').imgAreaSelect({
                onSelectEnd: function (img, selection) {
                    $('input[name="x1"]').val(selection.x1);
                    $('input[name="y1"]').val(selection.y1);
                    $('input[name="w"]').val(selection.width);
                    $('input[name="h"]').val(selection.height);
                }
            });
        });
    </script>
@endsection

@section('footer')

@endsection

