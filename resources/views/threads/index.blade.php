@extends ('layouts.app')
@section ('content')

 @if (!Empty($threads) && !is_null($threads)&& ($threads->count()>0))
      <div class="container">
      <div class="row ">
        @if (! Empty($trending)&& !is_null($trending)&& ($trending->count()>0))
           <div class="col-md-8 col-sm-6 my-0">
                @include ('layouts.errors')
                @include ('threads._list')
                {{ $threads->links()}}

            </div>
          @else
          <div class="col-md-8 offset-md-2 col-sm-6 my-0">
               @include ('layouts.errors')
               @include ('threads._list')
               {{ $threads->links()}}
           </div>
          @endif

          <!-- ranking bar -->
   @if (! Empty($trending)&& !is_null($trending)&& ($trending->count()>0))
        <div class="col-md-4 col-sm-6 my-0">
            <div class="panel panel-default">
              <div class="panel-heading">
                  Most Visited Threads
              </div>

              <div class="panel-body">
                <ul class="list-group">
                  @foreach($trending as $thread)
                    @if (! ( Empty($thread)|| (is_null($thread)) ))
                    <li class="list-group-item">
                      <a href="{{ url($thread->path()) }}">
                        {{ $thread->title }}
                      </a>
                    </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif

    </div>
  </div>

  @else
    <p>{{ __('home.norecords') }}</p>
  @endif

@endsection
