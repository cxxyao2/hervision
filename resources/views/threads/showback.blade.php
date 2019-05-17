@extends ('layouts.app')

@section ('content')

@if(Auth()->check())
<thread-view :thread="{{  $thread }}"   inline-template>
  <div class="container" >
  <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="panel panel-default">
              <div class="panel-body  p-1 ">
                <table  style="width: 100%;cellpadding:1px; cellspacing:1px;  " >
                    <tbody>
                      <tr>
                        <td style="align:center;">
                          <img src="{{ $thread->creator->avatar()}}" class="avatar1 my-1"
                          alt="{{ $thread->creator->name }}" >
                        </td>
                        <td style="align:center;">
                          {{ $thread->creator->name }}
                        </td>
                      </tr>
                      <tr>
                        <td>{{ $thread->creator->personal_profile }}</td>
                      </tr>
                      <tr >
                        <td style="align:center;">
                          <following-button :active="{{  json_encode(Auth::user()->isFollowed($thread->creator->id)) }}"
                               :followed="{{ $thread->creator->id }}" >
                          <following-button>
                        </td>
                        <td  style="align:center;">
                          <button class="btn btn-default"  onclick="moveHidden('textMessageDiv')">
                          <span class='glyphicon glyphicon-envelope'>私信</span></button>
                        </td>
                      </tr>
                    </tbody>
                   </table>

                  <hr>
                  <div id="textMessageDiv" class="panel-body mt-2 hidden" >
                      <form method="post" id="myform">
                        {{ csrf_field()}}
                        <input type="hidden"  name="followedId" value='{{ $thread->creator->id }}' />
                        <input type="text" class="form-control" id="textContent"
                         name="textContent" placeholder="请输入私信内容：" required>
                           <div class="row mt-3">
                            <div class="col">
                              <button class="btn btn-primary " onclick="submitMyform('/profiles/textMessage');" >发送</button>
                            </div>
                            <div class="col">
                              <button  class="btn btn-default" onclick="addHidden('textMessageDiv');" >取消</button>
                           </div>
                        </div>
                      </form>

                  </div>



                  <div class="panel-body my-2 mx-0">
                    This thread was pulished by  {{ $thread->created_at->diffForHumans() }}
                    by <a href="#">{{ $thread->creator->name }}</a>, and currently
                     has <span v-text="repliesCount"></span> {{ str_plural('comment',$thread->replies_count) }}
                 </div>

                <p>
                    <subscribe-button :active="{{  json_encode($thread->isSubscribedTo) }}" ><subscribe-button>

                </p>
            </div>
          </div>
        </div>

        <div class="col-md-8 " v-cloak>
          @php
          {{ $showFlag = (auth()->user()->id == $thread->user_id )? '1':'0';}}
          @endphp

            @include('threads._question')
            <hr>
            <replies :data="{{ json_encode($thread->replies)  }}"
              :locked="{{ json_encode($thread->can_comment) }}"
              @added = "repliesCount++"
              @removed="repliesCount--">
            </replies>


            @if ($thread->can_comment == 1)
            <p>帖子已锁-无法加入新评论 </p>
            @endif


        </div>

      </div>
  </div>

</thread-view>
@else
  <p class="text-center">please<a href="{{ route('login') }}">登录</a>
@endif


@endsection
