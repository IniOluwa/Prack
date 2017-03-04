@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in! <br>
                    <hr />
                        @foreach ($posts as $post)
                          <p>{{ $post->post_by }}</p>
                          <p>{{ $post->post_content }}</p>
                        @endforeach
                </div>

                <form class="form-horizontal panel-body" action="/createposts" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <legend>Post Form</legend>
                  <fieldset>
                    <div class="form-group">
                      <label for="NewPost" class="control-label">Post Something New</label>
                      <input type="text" class="col-sm-4 form-control" name="new_post" value="" placeholder="Your post goes here">
                    </div>
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary">Post!</button>
                    </div>
                  </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
