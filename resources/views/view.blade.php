
@extends('layouts.app')

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

    @foreach($post as $post)

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">your Post</div>

                    <div class="card-body">
















                        @foreach($posts as $post)

                            <h3>{{$post->description}}</h3>

                            <a href="/posts/{{$post->id}}/edit">Edith</a>

                        @endforeach








                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


@endsection


@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

@endsection


@section('scripts')

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js" defer></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>

@endsection







@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

@endsection


@section('scripts')

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js" defer></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>

@endsection
