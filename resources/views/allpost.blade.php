@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"

            integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"

            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/rr.css') }}">
    <link rel="stylesheet" href="{{ asset('js/lightbox.js') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
    <head>
        <title>image Gallery</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
    </head>
    <body>
    <p class="heading">image Gallery</p>

    <div class="gallery-image">
        @foreach($posts as $post)

            <div class="img-box">
                <img src="{{ asset('storage/cropped/'.$post->image) }}" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>{{$post->description}}</p>
                        <hr />
                        <h6>Add comment</h6>
                        <form method="post" action="{{ route('comment.add') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment_body" class="form-control" />
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Add Comment" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach




    </div>



@endsection
