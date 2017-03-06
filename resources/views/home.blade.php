@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Latest updates</div>

                <div class="panel-body">
                    @foreach ($posts as $post)
                      @if($post->post_by == Auth::user()->id)
                        <h4 class="">{{ Auth::user()->name }}</h4>
                        <p>{{ $post->post_content }}</p>
                        <hr>
                      @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Post updates  
                  @if(Session::has('post-flash'))
                    <span> {{ Session::get('post-flash') }} </span>
                  @endif
                </div>
                
                <div class="panel-body">
                  <form class="form" action="/createposts" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                      <label>Write a post</label>
                      <textarea cols="20" rows="2" name="new_post" placeholder="write a simple post" class="form-control" required="">{{old('new_post')}}</textarea>
                    </div>

                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary">Post</button>
                    </div>
                  </form>

                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
