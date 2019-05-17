@extends ('layouts.app')
@section ('content')

<div class="container my-1">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 col-sm-6">
      <div class="panel panel-default">
          <div class="panel panel-heading my-0">
              <h3 class="panel-title">
             {{ __('threadcreate.newpost') }}
              </h3>
          </div>


      @if (!auth()->user()->islocked())
      <form  id="myform" method="POST" action="/threads">
          {{ csrf_field()}}
            <input type="hidden" name="bodyField" id="bodyField" value="bodyt" />
            <input type="hidden" name="selectedTagArray" id="selectedTagArray" />


          <!-- 普通文本编辑区域-->
          <div  class="panel-body">
            <label>{{ __('threadcreate.chanel') }}</label>
              <div class="form-group">
                   @foreach ($channels as $channel)
                    @if ( $channel->id != '3')
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="{{'channel_id'.$channel->id}}" name="channel_id"
                          value="{{ $channel->id }}"    {{ old('channel_id') == $channel->id ? 'checked' : '' }}>
                        <label class="form-check-label ml-4" for="{{'channel_id'.$channel->id}}">
                            {{ $channel->slug }}
                        </label>
                      </div>
                    @elseif ( $channel->id == '3')
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" id="channel_id3" name="channel_id"
                          value="{{ $channel->id }}"  onclick=" window.location.href='/threads/createAccounting'; ">
                        <label class="form-check-label ml-4" for="channel_id3">
                            <a href="/threads/createAccounting">{{ $channel->slug }}</a>
                        </label>
                      </div>

                    @endif
                  @endforeach
            </div>



            <div class="form-group">
              @php
                $titlelen = config('constants.thread_titlelen');
              @endphp
                <label for ="title">{{ __('threadcreate.title') }}&#58; &#40; &lt;{{ $titlelen }}{{ __('threadcreate.words') }} &#41;</label>
                <textarea name="title" id="title" class="form-control  textAreaItem" placeholder="please input a title " rows="1" >{{ old('title') }}</textarea>
            </div>


            <div class="form-group mb-0">
              @php
                $contentlen = config('constants.thread_bodylen');
              @endphp
              <label for ="title">{{ __('threadcreate.content') }}&#58; &#40; &lt;{{ $contentlen }}{{ __('threadcreate.words') }}&#41;</label>
            </div>

            <div class="form-group comment" id="textBody" >
              <textarea name="body" id="body" class="form-control " placeholder="please input body" rows="10" >{{ old('body') }}</textarea>
           </div>


        <div class="level my-1 ">
           <div class="flex">
               <button class="btn btn-primary" type="submit" >{{ __('threadcreate.submit') }}</button>&nbsp;&nbsp;
               <a href="/threads/createplus">{{ __('threadcreate.advanced') }}</a>
           </div>

           <a  href="/polls/create" class="btn btn-warning" > {{ __('threadcreate.newvote') }}</a>
         </div>

      </div>

      <!--show error-->
      @include ('layouts.errors')

    </form>

    @else
        <div class="alert alert-danger" role="alert">
         {{ __('threadcreate.accountlocked') }}
        </div>
    @endif


  </div>
  </div>
</div>

@endsection
