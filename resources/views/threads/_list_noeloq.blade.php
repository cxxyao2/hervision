@php
  $channel_arr=[];
  foreach($channels as $channel){
    $channel_arr[$channel->id] = $channel->slug;
  }
@endphp
@foreach ($threads as $thread)
        <div class="panel panel-default my-1">
          <div class=" panel-heading">
            <div class="level">
              <span class="flex">
                @php
                  $thread_path = "/threads/".$channel_arr[$thread->channel_id]."/".$thread->id;
                @endphp
                <a href=" {{ $thread_path  }}">
                  {{ $thread->title }}
              </a>

            </span>
                <strong> {{ $thread->visits }} vistis  </strong>
              <strong>{{ $thread->replies_count }} {{ str_plural('reply',$thread->replies_count)  }}</strong>

            </div>
          </div>

          <div class="panel-body">
            <html-display data="{{ $thread->foreword }}" ></html-display>
          </div>

          </div>



@endforeach
