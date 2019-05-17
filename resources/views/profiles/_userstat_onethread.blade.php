<thread-view :thread="{{  $thread }}"   inline-template>
        <div class="col-md-8 col-sm-6 " v-cloak>
          @php
          {{ $showFlag = (Auth()->check() && (auth()->user()->id == $thread->user_id ))? '1':'0';}}
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
                <span class="text-center"><a href="{{ route('login') }}">{{ __('userstat.loginfirst') }}</a></span>
              @endif

              @if ( Auth()->check() &&(auth()->user()->islocked()))
                  <p>{{ __('userstat.accountlocked') }}</p>
              @endif

            @if ($thread->can_comment == 1 || $thread->locked == 1)
            <p>{{ __('userstat.commentlocked') }}</p>
            @endif
        </div>


</thread-view>
