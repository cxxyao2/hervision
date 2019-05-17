@extends ('layouts.app')
@section ('content')
<div class="container">
  <div class="row ">
    <div class="col-md-8 offset-md-2 col-sm-6 ">
      <div class="panel panel-info my-2">
        <div class="panel-heading">
            <h3 class="panel-title">
              <p> {{ __('pollcreate.newvote') }}</p>
           </h3>
        </div>


    <form method="POST" action="/polls">
      {{ csrf_field() }}
      <div class="panel-body">
        <label> {{ __('pollcreate.chanel') }}</label>
          <div class="form-group">
               @foreach ($channels as $channel)
                  <div class="form-check form-check-inline">                      @if ( $channel->id == '1')
                    <input class="form-check-input" id="channel_id1" name="channel_id"  type="radio"
                      value="{{ $channel->id }}" checked>
                      @else
                      <input class="form-check-input" id="channel_id1" name="channel_id"  type="radio"
                        value="{{ $channel->id }}" >
                       @endif
                    <label class="form-check-label ml-4" for="channel_id1">
                        {{ $channel->slug }}
                    </label>
                  </div>
              @endforeach
        </div>

        <div class="form-group">
          <label> {{ __('pollcreate.title') }}</label>
          <input type="text"  class="form-control" id="polltitle" name="polltitle" placeholder="title" required />
        </div>


        <?php
        $month = date('m');
        $day = date('d');
        $year = date('Y');
        $today = $year . '-' . $month . '-' . $day;
        ?>

        <div class="form-group">
          <lable>    {{ __('pollcreate.content') }}</lable>
          <input type="text" class="form-control"  id="pollcontent" name="pollcontent" placeholder="vote for what"  required />
          <label>    {{ __('pollcreate.deadline') }}</label>
          <input class="form-control "  value="<?php echo $today; ?>" type="date"   min="2018-01-01"  max="2038-12-31" id="polldate" name="polldate" required />
        </div >


          <div class="form-group ">
            <div class="form-check form-check-inline ">
              <input class="form-check-input" id="single_mul0" name="single_mul"  type="radio"
                value="0" onclick="$('#mul_maxnum').val(0);addHidden('mul_maxnum');" checked>
              <label class="form-check-label ml-1" for="single_mul0">
                {{ __('pollcreate.only') }}
              </label>

              <input class="form-check-input  ml-4"  id="single_mul1" name="single_mul"  type="radio"
                value="1" onclick="moveHidden('mul_maxnum');">
              <label class="form-check-label ml-1" for="single_mul1">
                {{ __('pollcreate.mulmax') }}
              </label>
              <input class="form-check-input  ml-3 hidden"  id="mul_maxnum" name="mul_maxnum"   onkeyup="value=value.replace(/[^\d]/g,'')" />

            </div>
        </div>

          <div id="divOption">

            <div class="form-group show" id="divOption10">
             <label for="polli10" >{{ __('pollcreate.option0') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli0counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
             <input type="text" class="form-control" id="polli0" name="pollid[]" placeholder="{{ __('pollcreate.option0') }}"  maxlength="50" onkeyup="input_words('polli0')" required/>
            </div>


             <div class="form-group show" id="divOption1">
               <label for="polli1" >{{ __('pollcreate.option1') }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable id="polli1counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
               <input type="text" class="form-control" id="polli1" name="pollid[]" placeholder="{{ __('pollcreate.option1') }}"  maxlength="50" onkeyup="input_words('polli1')" required/>
             </div>

             <div class="form-group hidden" id="divOption2">
             <label for="polli2" >{{ __('pollcreate.option2') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli2counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
             <input type="text" class="form-control" id="polli2" name="pollid[]" placeholder="{{ __('pollcreate.option2') }}"  maxlength="50" onkeyup="input_words('polli2')" />
             </div>

             <div class="form-group hidden " id="divOption3">
              <label for="polli3" >{{ __('pollcreate.option3') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli3counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
              <input type="text" class="form-control" id="polli3" name="pollid[]" placeholder="{{ __('pollcreate.option3') }}"  maxlength="50" onkeyup="input_words('polli3')"/>
            </div>

            <div class="form-group hidden" id="divOption4">
             <label for="polli4" >{{ __('pollcreate.option4') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli4counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
             <input type="text" class="form-control" id="polli4" name="pollid[]" placeholder="{{ __('pollcreate.option4') }}"  maxlength="50" onkeyup="input_words('polli4')"/>
           </div>


           <div class="form-group hidden" id="divOption5">
            <label for="polli5" >{{ __('pollcreate.option5') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli5counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
            <input type="text" class="form-control" id="polli5" name="pollid[]" placeholder="{{ __('pollcreate.option5') }}"  maxlength="50" onkeyup="input_words('polli5')"/>
          </div>


          <div class="form-group hidden" id="divOption6">
           <label for="polli6" >{{ __('pollcreate.option6') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli6counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
           <input type="text" class="form-control" id="polli6" name="pollid[]" placeholder="{{ __('pollcreate.option6') }}"  maxlength="50" onkeyup="input_words('polli6')"/>
         </div>


         <div class="form-group hidden" id="divOption7">
          <label for="polli7" >{{ __('pollcreate.option7') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli7counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
          <input type="text" class="form-control" id="polli7" name="pollid[]" placeholder="{{ __('pollcreate.option7') }}"  maxlength="50" onkeyup="input_words('polli7')"/>
        </div>


        <div class="form-group hidden" id="divOption8">
         <label for="polli8" >{{ __('pollcreate.option8') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli8counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
         <input type="text" class="form-control" id="polli8" name="pollid[]" placeholder="{{ __('pollcreate.option8') }}"  maxlength="50" onkeyup="input_words('polli8')"/>
       </div>


       <div class="form-group hidden" id="divOption9">
        <label for="polli9" >{{ __('pollcreate.option9') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>  <lable id="polli9counter">0</lable><lable>{{ __('pollcreate.maxwords') }}</lable>
        <input type="text" class="form-control" id="polli9" name="pollid[]" placeholder="{{ __('pollcreate.option9') }}"  maxlength="50" onkeyup="input_words('polli9')"/>
      </div>


  </div>



     <div class="level my-1 ">
        <span class="flex">
            <button class="btn btn-primary" type="submit">{{ __('pollcreate.submit') }}</button>
        </span>
        <a  class="btn btn-default" onclick="var len=$('.show').length ;if(len>=10){alert('max 10 options');}$('#divOption'+len).addClass('show');$('#divOption'+len).removeClass('hidden') ;">{{ __('pollcreate.add') }}</a>

    </div>

  </div>
    @include ('layouts.errors')
</form>

</div>
</div>
</div>
</div>

@endsection
