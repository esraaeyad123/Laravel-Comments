
@extends('layouts.app')



@section('content')


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/rr.css') }}">

    <head>
        <title>image Gallery</title>

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
                        <p class="opacity-low">
                            <a  href="{{ route('image.edit', [$post->id]) }}">Edit</a>
                        <form action="{{ route('image.destroy', [$post->id]) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                        </form>

                        </p>

                    </div>
                </div>

            </div>
        @endforeach




    </div>



@endsection



