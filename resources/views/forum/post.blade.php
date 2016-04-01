


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">{{ $post->title }}</h3>
                </div>
                <div class="panel-body">
                  {{ $post->description }}
                </div>
              </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/post') }}/{{ $post->id }}">
                        {!! csrf_field() !!}
                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                        <textarea class="form-control" name="comment">{{ old('comment') }}</textarea>

                                        @if ($errors->has('comment'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                                </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i>Post
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
     @if ($post->comments->count())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h4>Comments</h4>
            @foreach($post->comments as $comment)
                <blockquote>
                <p>{{ $comment->comment }}</p>
                <footer><strong>{{ $comment->user->username }}</strong> {{ $comment->created_at->diffForHumans() }}</footer>
              </blockquote>
            @endforeach
        </div>
    </div>
   @endif
</div>
@endsection