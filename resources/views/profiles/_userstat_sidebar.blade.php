<div class="panel panel-default mt-1 mb-0">
    <div class="level">
      <span class="flex">
        <h4>{{ $profileuser->name}}</h4>
        <h5>{{ __('statisside.profile') }}{{ $profileuser->personal_profile}}</h5>
      </span>
     <img src="{{ $profileuser->avatar() }}"  class="rounded-circle avatar1 "  />
    </div>

    <table class="cal">
      <tbody>
        <tr >
          <th>{{ __('statisside.posts') }}</th>
          <th>{{ __('statisside.visiteds') }}</th>
          <th>{{ __('statisside.comments') }}</th>
          <th>{{ __('statisside.approveds') }}</th>
        </tr>
        <tr>
          @if (!empty($indicators)&& !is_null($indicators) && ($indicators->count() > 0))
           @foreach ($indicators as $indicator)
            <td>{{$indicator->publishcnt }}</td>
            <td>{{$indicator->visitcnt }}</td>
            <td>{{$indicator->replycnt }}</td>
            <td>{{$favoritecnt }}</td>
           @endforeach
          @else
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
          @endif
        </tr>
        <tr>
          <td><strong>{{ __('statisside.fans') }}</strong></td>
          <td><strong>{{ __('statisside.followings') }}</strong></td>
          <td><strong>{{ __('statisside.favorites') }}</strong></td>
          <td><strong>{{ __('statisside.subscriptions') }}</strong></td>
        </tr>
        <tr>
          <td>{{$fans->count() }}</td>
          <td>{{$followings->count() }}</td>
          <td>{{$subs->count() }}</td>
          <td>{{$besubs->count() }}</td>
        </tr>
      </tbody>
    </table>
</div>
<br>

@foreach($channels as $channel)
  <div class="panel panel-default mb-1 ">
     <h5 >{{ $channel->name }}</h5>
     @php
     $threadStas = $factors->where('channel_id', $channel->id);
     $threadStas->all();
     @endphp
     @if (!empty($threadStas) && !is_null($threadStas)&& ($threadStas->count() > 0))
       @foreach ($threadStas as $thread)
         @if ( $channel->id !== 3 )
            <a href=" /profiles/userstat/{{$profileuser->name}}/{{$channel->slug}}/{{$thread->year1}}/{{ $thread->month1 }}/">
             <p>{{ $thread->year1 }}{{ __('statisside.year') }}{{ $thread->month1 }} {{ __('statisside.month') }} {{ $thread->published }}
                 {{ __('statisside.numbers') }} </p>
            </a>
         @else
         <a href=" /profiles/userstat/{{$profileuser->name}}/{{$channel->slug}}/{{$thread->year1}}/{{ $thread->month1 }}/financing">
           <p>{{ $thread->year1 }} {{ __('statisside.year') }}{{ $thread->month1 }} {{ __('statisside.month') }} {{ $thread->published }}{{ __('statisside.numbers') }}</p>
           </a>
         @endif
       @endforeach


      @else
       <p> {{ __('statisside.norecord') }}</p>
      @endif
   </div>
   @endforeach

<div class="panel panel-default my-1 ">
  <h5 >{{ __('statisside.followings') }}</h5>
  @if ( ! empty($followings) && !is_null($followings) && ($followings->count() > 0))
      @foreach ($followings as $following)

        <strong> {{ __('statisside.userid') }} {{  $following->id }} </strong>
        @if (!empty($following->myDetails))
            <strong> {{ __('statisside.username') }} {{  $following->myDetails->name }}</strong>
          <img src="{{ $following->myDetails->avatar() }}"  class="rounded-circle avatar1" style="width:30px; height:30px" />
        @endif
          <br>
     @endforeach
  @else
      <p>{{ __('statisside.nofollowing') }}</p>
  @endif
</div>



<div class="panel panel-default my-1 ">
  <h5 >{{ __('statisside.tags') }}</h5>
  @if (!empty($mytags) && !is_null($mytags))
  <ol class="list-unstyled">
    @foreach ($mytags as $tag)
      <li>
          <a href="/threads/tags/{{ $profileuser->id }}/{{ $tag->name }}">
            {{  $tag->name }}  <span class="badge badge-light">{{ $tag->articlecnt}}</span>
          </a>
      </li>
    @endforeach
  </ol>
  @else
    <p>{{ __('statisside.norecord') }}</p>
  @endif
</div>
