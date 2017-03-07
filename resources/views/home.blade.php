@extends('layouts.app')

@section('title') 
  Prack Project
@stop

@section('site-name')
  Prack it
@stop

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">  
      <div class="row">
        
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">Post updates  
              @if(Session::has('post-flash'))
                <span> {{ Session::get('post-flash') }} </span>
              @endif

              @if(count($errors))
                <div>
                  <h4>You have some errors trying to upload.</h4>
                  @foreach($errors->all() as $new_error)
                    <li class="alert-danger list-group-item"> {{ $new_error }} </li>
                  @endforeach
                </div>
              @endif
            </div>
            
            <div class="panel-body">
              <form class="form" action="/createposts" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                  <label>Write a post</label>
                  <textarea cols="20" rows="2" name="new_post" placeholder="write a simple post" class="form-control" required="">{{old('new_post')}}</textarea>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                      <input type="file" name="image" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary">Post</button>
                </div>
              </form>
            </div>  
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">latest post updates  
              <div class="panel-body">
                <h5>All images uploads ({{$images->count()}})</h5> 
                  @foreach($images as $image)
                    @if(!empty($image->image_name))
                      <img src="images/post_images/{{ $image->image_name }}" width="50" height="50">
                    @endif
                  @endforeach
                  <hr>

                  <h5>Images by <b>{{ Auth::user()->name}}</b></h5>
                  @foreach ($posts as $post)
                    @if($post->user_id == Auth::user()->id)
                      @if(!empty($post->post_image))
                        <img src="images/post_images/{{ $post->post_image }}" width="50" height="50">
                      @endif
                    @endif
                  @endforeach
                  <p>total post updates ({{ $posts->count() }})</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">
              <div class="panel-heading">Latest updates</div>
              <div class="panel-body">
                @foreach ($posts as $post)

                  @if(!empty($post->post_image))
                    <img class="img-rounded" src="images/post_images/{{ $post->post_image }}" width="100" height="100">
                    <br />
                  @endif

                  <span class="small">by {{ $post->user_id }}</span>
                  <p>{{ $post->post_content }}</p>
                  <hr>
                  <br />                          
                @endforeach
              </div>
          </div>
        </div>

        <div class="col-md-4">
          <h4>All users</h4>
          <ul class="list-group">
            @foreach ($users as $user)
              <li class="list-group-item">{{ $user->name}}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
