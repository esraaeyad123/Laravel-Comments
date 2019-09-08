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
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif


    <div class="container mt-5">
        <form action="{{ url('image') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputImage">Image:</label>
                <input type="file" name="profile_image" id="exampleInputImage" class="image" required>
                <input type="hidden" name="x1" value="" />
                <input type="hidden" name="y1" value="" />
                <input type="hidden" name="w" value="" />
                <input type="hidden" name="h" value="" />
            </div>
            <div class="form-group">

            <textarea class="textarea" id="description" name="description" placeholder="description "  cols="30"rows="8"></textarea>
        </div>


                {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
        <div class="row mt-5">
            <p><img id="previewimage" style="display:none;"/></p>
            @if(session('path'))
                <img src="{{ session('path') }}" />
            @endif
        </div>
        </form></div>
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
