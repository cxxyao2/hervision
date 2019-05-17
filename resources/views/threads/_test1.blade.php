@if (!Empty($threads) && !is_null($threads)&& ($threads->count()>0))
<div class="card  my-1">
            @foreach ($threads as $thread)
              <div class="card-header">
                <div class="row">
                  <span class="flex ml-2"> <a href=" {{ $thread->path()  }}" >
                    @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                      <strong>
                        {{ $thread->title }}
                      </strong>
                    @else
                      {{ $thread->title }}
                    @endif
                  </a>
                </span>
                <span class="mr-2">作者：{{ $thread->creator->name }}</span>
              </div>
          </div>

                <div class="d-flex flex-wrap bd-highlight">
                  <div class="p-3 flex-grow-1 bd-highlight"><span>{{$thread->created_at->diffForHumans()}}</span></div>
                  <div class="p-2 bd-highlight"><span class='glyphicon glyphicon-eye-open'> {{$thread->visits }}</span></div>
                  <div class="p-2 bd-highlight"><span class='glyphicon glyphicon-comment'> {{ $thread->replies_count }}</span></div>
                  @if ($thread->subscriptions)
                    <div class="p-2 bd-highlight"><span class='glyphicon glyphicon-comment'>{{ $thread->subscriptions->count() }}</span></div>
                  @endif
               </div>


            <div class="card-body border-top" >
                 <html-display data="{{ $thread->foreword }}" ></html-display>
            </div>
            @endforeach
      </div>



  @else
    <p>没有符合条件的记录</p>
  @endif
