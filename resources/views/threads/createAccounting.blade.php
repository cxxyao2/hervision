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
      <form method="POST" action="/threads/createFinance">
          {{ csrf_field()}}
          <div class="form-group">
            @foreach ($channels as $channel)

             @if ( $channel->id == '3')
               <div class="form-check form-check-inline ">
                 <input class="form-check-input" id="channel_id1" name="channel_id"  type="radio"
                   value="{{ $channel->id }}" checked>
                 <label class="form-check-label ml-4" for="channel_id1">
                    {{ $channel->slug }}
                 </label>
               </div>

             @else
               <div class="form-check form-check-inline ">
                 <input class="form-check-input" id="{{ 'channel_id'.$channel->id }}" name="channel_id"  type="radio"
                   value="{{ $channel->id }}" onclick=" window.location.href='/threads/create'; ">
                 <label class="form-check-label ml-4" for="{{ 'channel_id'.$channel->id }}">
                     <a href="/threads/create">{{ $channel->slug }}</a>
                 </label>
               </div>
             @endif
           @endforeach
            </div>

       <!-- 列出全部可选的收入或者项目-->
       <div id="channel3" >
         <div class="form-group border">
             <label for ="accounting_day">  {{ __('threadcreate.date') }}</label>
             <input class="btn mx-2 my-0 p-0 financeAreaItem" type="date" value="{{ $currentDay }}" min="2018-01-01"  max="2038-12-31" id="accounting_day" name="accounting_day" required/>
         </div>
          <div class="form-group border">
             <input   type="radio" name="inout_flag" id="out1" value="1" onclick="myHideAndShow('finance','out_div')"
                aria-label="Radio button for following text input"   checked required>  {{ __('threadcreate.expenditure') }}
             <input   type="radio" name="inout_flag" id="in1" value="0"
              {{ old('inout_flag') == '0' ? 'checked' : '' }} onclick="myHideAndShow('finance','in_div')">{{ __('threadcreate.revenue') }}
         </div>

        <div class="form-group my-2 panel finance  border  out_div" >
           @forelse ($outCatagories as $outCatagory)
            <input  type="radio" name="inout_catagory" value="{{ $outCatagory->catagory_code }}"
            required>{{ $outCatagory->catagory_name }}
           @empty
            <p>{{ __('threadcreate.noexpenditems') }}</p>
           @endforelse
        </div>

        <div class="form-group my-2 finance hidden border  in_div" >
           @forelse ($inCatagories as $inCatagory)
               <input  type="radio" name="inout_catagory"
                 value="{{ $inCatagory->catagory_code }}"  >{{ $inCatagory->catagory_name }}
           @empty
                <p>{{ __('threadcreate.norevenue') }}</p>
           @endforelse
         </div>

         <div class="form-group">
           <label>{{ __('threadcreate.amount') }} </label>
           <input class="form-control " name="inout_amount" id="inout_amount"
              value ="{{ old('inout_amount') }}"
           placeholder="please input number" onkeyup="value=value.replace(/[^\d]/g,'')"  >
         </div>

         <div class="form-group">
           <label>{{ __('threadcreate.comments') }}</label>
           <input class="form-control " name="item_details" id="item_details" placeholder="20字以内简短备注"
              value ="{{ old('item_details') }}"
             />
         </div>


       </div>


       <!--可见性-->
       <div class="form-group border border-light rounded advanced ">

           @foreach ($visibelArray as $key=>$value)
             <div class="form-check form-check-inline ">
                 @if (!empty(old('visible_level')) && strlen(old('visible_level')) > 0)
                  <input class="form-check-input" type="radio" name="visible_level" id="{{ 'visibie'.$key }}" value="{{ $key }}"
                  {{ old('visible_level') == $key? 'checked' : '' }}  required />
                  @else
                  <input class="form-check-input" type="radio" name="visible_level" id="{{ 'visibie'.$key }}" value="{{ $key }}"
                  {{  $key == '1'? 'checked' : '' }}  required />
                  @endif


               <label class="form-check-label" for= "{{ 'visibie'.$key }}" >{{$value}}</label>
             </div>
           @endforeach
       </div>

       <!--可评论-->
      <div class="form-group border border-light advanced rounded ">
       @foreach ($commentArray as $key=>$value)
         <div class="form-check form-check-inline ">

           @if (!empty(old('can_comment')) && !is_null(old('can_comment')))
              <input class="form-check-input" type="radio" name="can_comment" id="{{ 'canComment'.$key }}" value="{{ $key }}"
              {{ old('can_comment') ===  $key? 'checked' : '' }}  required />
            @else
              <input class="form-check-input" type="radio" name="can_comment" id="{{ 'canComment'.$key }}" value="{{ $key }}"
              {{ $key == '1'? 'checked' : '' }}  required />
            @endif

           <label class="form-check-label" for= "{{ 'canComment'.$key }}" >{{$value}}</label>
         </div>
       @endforeach
      </div>


       <div class="form-group row border-1 ">
          <div class="col-2">
            <button class="btn btn-primary" type="submit">{{ __('threadcreate.submit') }}</button>
          </div>
      </div>


      @else
          <div class="alert alert-danger" role="alert">
            {{ __('threadcreate.accountlocked') }}
          </div>
      @endif

      <!--show error-->
      @include ('layouts.errors')

     </form>

     </div>

     </div>
     </div>
   </div>


@endsection
