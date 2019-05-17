@extends ('layouts.app')

@section ('content')

<div class="container">
  <div class="row">
    <div class="col-md-10  col-md-offset-1 col-sm-6">
        <div class="panel panel-default">
            <div class="panel panel-heading my-0">
                <h3 class="panel-title">
                {{ __('threadcreate.newpost') }}
                </h3>
            </div>

        <div class="card-body border-top" >
            @if (!auth()->user()->islocked())
                <form  id="myform" method="POST"  action="/threads">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label class="form-control-label">{{ __('threadcreate.chanel') }}</label>
                        <br/>
                         @foreach ($channels as $channel)
                          @if ( $channel->id != '3')
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="{{'channel_id'.$channel->id}}" name="channel_id"
                                value="{{ $channel->id }}"   {{ old('channel_id') == $channel->id ? 'checked' : '' }}     >
                              <label class="form-check-label ml-4" for="{{'channel_id'.$channel->id}}">
                                  {{ $channel->slug }}
                              </label>
                            </div>
                          @endif
                        @endforeach
                    </div>




                    <div class="form-group">
                        @php
                        $titlelen = config('constants.thread_titlelen');
                        @endphp
                        <label for="title">{{ __('threadcreate.title') }}&#58; &#40; &lt;{{ $titlelen }}{{ __('threadcreate.words') }} &#41;</label>
                        <textarea name="title" id="title" class="form-control  textAreaItem" placeholder="please enter a title" rows="1" >{{ old('title') }}</textarea>
                    </div>

                    <div class="form-group my-0">
                        @php
                        $contentlen = config('constants.thread_bodylen');
                        @endphp
                        <label>{{ __('threadcreate.content') }}&#58; &#40; &lt;{{ $contentlen }}{{ __('threadcreate.words') }}&#41;</label>
                        <div class="form-group mt-0 mb-1 " id="wysiwygBody"  >
                            <wysiwyg name="body"  id="body"  value="{{ old('body') }}"></wysiwyg>
                        </div>
                    </div>

                    <div class="form-group my-0">
                        <label class="btn btn-default " onclick="cal_words('trix');">{{ __('threadcreate.countwords') }}</label>
                    </div>

                    <!--标签-->
                    <div class="form-group border  mt-2 " id="divtag">
                      <label>{{ __('threadcreate.tags') }}</label>
                        @foreach ($tags as $tag)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="tags[]" id="{{ 'tag'.$tag->id}}" value="{{ $tag->id }}"
                             >
                            <label class="form-check-label" for="{{ 'tag'.$tag->id}}">{{$tag->name}}</label>
                        </div>
                       @endforeach
                    </div>

                    <!--可见性-->
                    <div class="form-group border border-light rounded  advanced  " id="vis1">
                        @foreach ($visibelArray as $key=>$value)
                            <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="visible_level" id="{{ 'visibie'.$key }}" value="{{ $key }}"
                             {{ old('visible_level') == $key ? 'checked' : '' }}  required >
                            <label class="form-check-label" for= "{{ 'visibie'.$key }}" >{{$value}}</label>
                            </div>
                        @endforeach
                    </div>

                   <!--可评论-->
                   <div class="form-group border border-light rounded  advanced " id="com1">
                       @foreach ($commentArray as $key=>$value)
                           <div class="form-check form-check-inline ">
                           <input class="form-check-input" type="radio" name="can_comment" id="{{ 'canComment'.$key }}" value="{{ $key }}"
                           {{ old('can_comment') == $key ? 'checked' : '' }}   required >
                           <label class="form-check-label" for= "{{ 'canComment'.$key }}" >{{$value}}</label>
                           </div>
                       @endforeach
                   </div>

                   <div class="level my-1 ">
                       <div class="flex">
                       <button class="btn btn-primary" type="submit" >save</button>
                       </div>
                   </div>

                    <!--show error-->
                    @include('layouts.errors')
                </form>
            @else
                <div class="alert alert-danger" role="alert">
                {{ __('threadcreate.accountlocked') }}
                </div>
            @endif

        </div>
     </div>
  </div>
  </div>
</div>

@endsection
