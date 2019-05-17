<div class="container" >
  <div class="row ">
      <div class="col-md-8 offset-md-2 col-md-6">
        <div class="panel panel-default " >

          <div class="panel-heading">
          @if ( ! $notExpired )
             <h3 class="panel-title">
             {{ __('pollshow.expired') }}
             </h3>
           @elseif(!$isNotVoted)
             <h3 class="panel-title">
                  {{ __('pollshow.voted') }}
             </h3>
           @endif
         </div>

      <div class="panel-body">

       <div class="form-group row">
           <label class="col-sm-2 col-form-label">  {{ __('pollshow.title') }}</label>
           <div class="col-sm-10">
                 <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $pollj->title }} ">
           </div>
       </div>

       <div class="form-group">
        <label for="exampleFormControlTextarea1">{{ __('pollshow.content') }}</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $pollj->content }}</textarea>
     </div>

     <div class="form-group row">
         <label class="col-sm-2 col-form-label">{{ __('pollshow.deadline') }}</label>
         <div class="col-sm-10">
               <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ \Carbon\Carbon::parse($pollj->end_time)->format('Y/m/d') }} ">
         </div>
     </div>


     <?php
     $votesum=0;
     for ($i = 1; $i <= 10; $i++)
     {
       if ($pollj["option".$i]){
          $votesum= $votesum + $pollj["option_votes".$i];
       }
     }
     ?>

        @for ($i = 1; $i <= 10; $i++)
          @if ($pollj["option".$i])
            <div class="form-group row">
             <label class="col-sm-2  col-form-label">{{ $pollj["option".$i]}} : <em>{{ $pollj["option_votes".$i] }}票</em></label>
             <div class="col-sm-10  ">
                <div class="progress">
                  @if ($votesum > 0)
                    <div class="progress-bar " role="progressbar" style="{{'width: '.($pollj['option_votes'.$i]*100/$votesum).'%;'}}" aria-valuenow="{{ $pollj['option_votes'.$i] }}" aria-valuemin="0" aria-valuemax="100">
                  @else
                   <div class="progress-bar " role="progressbar" style="width: 0%;"  aria-valuenow="{{ $pollj['option_votes'.$i] }}" aria-valuemin="0" aria-valuemax="100">

                  @endif
                  </div>
                </div>
             </div>
            </div>
          @endif
      @endfor
          <a class="btn btn-primary" href="/threads">{{ __('pollshow.close') }}</a>
    </div>

</div>


   </div>
  </div>
</div>
</div>
