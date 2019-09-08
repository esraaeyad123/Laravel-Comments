@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p> <img src="{{$post->image}}" alt="" /></p>
                        <p>
                            {{ $post->description }}
                        </p>
                        <hr />
                        <h4>Display Comments</h4>
                        @foreach($post->comments as $comment)
                            <hr />
                            <div class="display-comment">
                                <strong>{{ $comment->user->name }}</strong>
                                <p>{{ $comment->body }}</p>
                            </div>
                        @endforeach
                        <hr />
                        <h4>Add comment</h4>
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
        </div>
    </div>
@endsection
