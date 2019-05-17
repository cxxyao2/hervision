@extends ('layouts.app')

@section ('content')

<div class="container">
  <div class="row">
            <div  class="col-sm-8 blog-main">
              @foreach ($posts as $post)
                @if ($post == null)
                  {{ dd($posts) }}
                @endif
                 <div class="blog-post">
                   <p class="blog-post-meta">
                     <a href="/posts/{{ $post->id }} "> {{ $post->id." ".$post->postbody }}</a>
                     <br>
                   </p>
                     创建时间: {{ $post->created_at }}
                 </div>
               @endforeach

              </div>

              @include ('layouts.sidebar')

            </div><!-- /.row -->
          </div><!-- /.container -->


@endsection
