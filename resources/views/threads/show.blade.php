@extends ('layouts.app')

@section ('content')

@if ( !empty($thread) && (auth()->check()) )
<thread-view :thread="{{  $thread }}"   inline-template>
  <div class="container mt-1" >
    <div class="row ">
      <div class="col-md-4 col-sm-6 ">
        <div class="panel panel-default">
            <div class="panel-body  p-1 ">
              <table  style="width: 100%;cellpadding:0px; cellspacing:0px;  " >
                  <tbody>
                    <tr>
                      <td style="align:center;"  rowspan="2">
                        <img src="{{ $thread->creator->avatar()}}" class="avatar1 my-1"
                        alt="{{ $thread->creator->name }}" >
                      </td>
                      <td style="align:center;">
                        <strong>{{ $thread->creator->name }}</strong>
                      </td>
                    </tr>
                  </tr>
                      <td>{{ $thread->creator->personal_profile }}</td>
                    </tr>

                    @if(Auth()->check() && !auth()->user()->islocked())
                    <tr >
                      <td style="width:50%;">
                        <following-button :active="{{  json_encode(Auth::user()->isFollowed($thread->creator->id)) }}"
                             :followed="{{ $thread->creator->id }}" >
                        <following-button>
                      </td>
                      <td style="width:50%;">
                        <button class="btn btn-default" style="width:90%;align:center; " onclick="moveHidden('textMessageDiv')">
                        <span class='glyphicon glyphicon-envelope'>{{ __('threadshow.textmessage') }}</span></button>
                      </td>
                    </tr>
                    @endif
                  </tbody>
                 </table>

                <div id="textMessageDiv" class=" mt-2 hidden" >
                    <form method="post" id="myform">
                      {{ csrf_field()}}
                      <input type="hidden"  name="followedId" value='{{ $thread->creator->id }}' />
                      <input type="text" class="form-control" id="textContent"
                       name="textContent" placeholder="enter a message:" required>
                         <div class="row mt-3">
                          <div class="col">
                            <button class="btn btn-primary " onclick="submitMyform('/profiles/textMessage');" >{{ __('threadshow.send') }}</button>
                          </div>
                          <div class="col">
                            <button  class="btn btn-default" onclick="addHidden('textMessageDiv');" >{{ __('threadshow.cancel') }}</button>
                         </div>
                      </div>
                    </form>
                </div>
                <hr>
                <div class="d-flex align-items-center">
                  <div class="p-2 flex-fill ">{{ __('threadshow.publisheddate') }}{{ $thread->created_at->diffForHumans() }}</div>
                  <div class="p-2 flex-fill ">{{ __('threadshow.reply') }}<html-display :data="repliesCount"></html-display></div>
                  <div class="p-2 flex-fill ">{{ __('threadshow.click') }}{{ $thread->visits }}</div>
                  <div class="p-2 flex-fill " v-cloak>  @if(auth()->check() && !auth()->user()->islocked())
                     <p>
                         <subscribe-button :active="{{  json_encode($thread->isSubscribedTo) }}" ><subscribe-button>
                     </p>
                    @endif
                  </div>
                </div>

                  @if ((!empty($previousThread)) && !(is_null($previousThread)))
                  <div class="d-flex align-items-left">
                    <div class="p-2 flex-fill "><span class="glyphicon glyphicon-backward"></span><a href="{{ $previousThread->path() }}" >
                      {{ __('threadshow.previous') }} {{$previousThread->title}}</a></div>
                  </div>
                  @endif

                  @if ((!empty($nextThread)) && !(is_null($nextThread)))
                    <div class="d-flex align-items-left">
                      <div class="p-2 flex-fill ">  <a href="{{ $nextThread->path() }}" >
                     {{ __('threadshow.next') }} {{$nextThread->title}}</a><span class="glyphicon glyphicon-forward"></span></div>
                    </div>
                  @endif
          </div>

        </div>
      </div>

        <div class="col-md-8 col-sm-6 ">
          @php
          {{ $showFlag = (Auth()->check()&&(auth()->user()->id == $thread->user_id ))? '1':'0';}}
          @endphp

          @include('threads._question')

            @if(Auth()->check() && !auth()->user()->islocked() && (!($thread->can_comment == 1)) && ( !($thread->locked == 1)))
              <replies
                :locked="{{ json_encode($thread->can_comment) }}"
                @added = "repliesCount++"
                @removed="repliesCount--">
              </replies>
             @else
               <replies
                 :locked="1"
                 @added = "repliesCount++"
                 @removed="repliesCount--">
               </replies>
             @endif

              @if (!Auth()->check())
                <span class="text-center"><a href="{{ route('login') }}">{{ __('threadshow.loginfirst') }}</a></span>
              @endif

              @if ( Auth()->check() &&(auth()->user()->islocked()))
                  <p>{{ __('threadshow.uselocked') }}</p>
              @endif

            @if ($thread->can_comment == 1 || $thread->locked == 1)
            <p>{{ __('threadshow.nocomment') }} </p>
            @endif
        </div>



      </div>
  </div>

</thread-view>


@else
  <div class="col-md-8 offset-md-2 col-sm-6 text-center"> <a href="/login"> {{ __('threadshow.loginfirst') }}</a> </div>
@endif




@endsection
