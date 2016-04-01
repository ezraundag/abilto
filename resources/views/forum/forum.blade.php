


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/forum') }}">
                        {!! csrf_field() !!}
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Topic</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" value="{{ old('description') }}"></textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
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
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Topic</th>
                        <th class="text-center">Comments</th>
                        <th class="text-center">Posted by</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="text-center">{{ $post->created_at->diffForHumans() }}</td>
                        <td><a href="{{ url('/post') }}/{{ $post->id }}">{{ $post->title }}</a></td>
                        <th class="text-center">{{ $post->commentsCount() }}</th>
                        <th class="text-center">@if ($post->user_id) {{ $post->user->username }} @endif</th>
                    </tr>
                    
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection