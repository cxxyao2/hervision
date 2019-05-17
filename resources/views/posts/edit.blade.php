@extends ('layouts.app')

@section ('content')

<div class="container">
  <div class="row">
      <div class="col-sm-8 blog-main">


            <form method="POST" action="{{route('posts.update', $post)}}">
              {{ csrf_field() }}
               @method('patch')
              <div class ="form-group">
                <textarea name="postbody" palceholder="input a new post." class="form-control" >
                  {{ $post->postbody }}
                </textarea>
              </div>

              <div class ="form-group">
                <button type="submit" class="btn btn-primary">提交</button>

              </div>

              @include ('layouts.errors')
            </form>





      </div>
      </div>

</div>

@endsection
