@extends ('layouts.app')

@section ('content')

<div class="container">

  <div class="row">
      <div class="col-sm-8 blog-main">
        <h1> {{ $post->id }}  正文内容如下: &nbsp;  </h1>
        {{ $post->postbody }}

        @if (count($post->tagjs))
          <ul>
            @foreach ($post->tagjs as $tag)
              <li><a href="/posts/tagjs/{{ $tag->name }}">{{ $tag->name }}</a></li>
            @endforeach
          </ul>
        @endif



      </div>
      </div>

</div>

@endsection
