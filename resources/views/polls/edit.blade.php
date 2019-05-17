@extends ('layouts.app')
@section ('content')

@if ($notExpired && $isNotVoted)
<div class="container">
  <div class="row ">
    <div class="col-md-8">
       <div class="panel panel-info ">
        <div class="panel-heading">
            <h3 class="panel-title">
              <p>{{ __('polledit.vote') }}</p>
           </h3>
        </div>
          <form id="myform" method="POST" action=" {{ route('polls.update', $pollj->id) }}">
            {{ csrf_field() }}
            @method('patch')
            <div class="panel-body">
              @if (!(empty($pollj)))
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ __('polledit.title') }}</label>
                    <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $pollj->content }} ">
                    </div>
                </div>

                <div class="form-group">
                 <label for="exampleFormControlTextarea1">{{ __('polledit.content') }}</label>
                 <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $pollj->content }}</textarea>
              </div>

              <div class="form-group row">

                  <label class="col-sm-2 col-form-label">{{ __('polledit.deadline') }}</label>
                  <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ \Carbon\Carbon::parse($pollj->end_time)->format('Y/m/d') }} ">
                  </div>
              </div>

              <div class="form-group">
                @if ($pollj->single_mul == 0)
                  @for ($i = 1; $i <=10; $i++)
                    @if ($pollj["option".$i] )
                      <div class="custom-control custom-radio">
                      <input type="radio" id="{{'customRadio'.$i }}"  value="{{ $i }}" name="optionid[]" class="custom-control-input" />
                      <label class="custom-control-label" for="{{'customRadio' .$i }}">{{ $pollj["option".$i] }}</label>
                    </div>
                    @endif
                  @endfor
                @endif



                @if ($pollj->single_mul == 1)
                  @for ($i = 1; $i <=10; $i++)
                    @if ($pollj["option".$i] )
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="{{'customCheck' . $i }}" name="optionid[]"  value="{{$i }}" class="custom-control-input" >
                        <label class="custom-control-label" for="{{'customCheck' . $i }}"> {{ $pollj["option".$i] }} </label>
                      </div>
                    @endif
                  @endfor
                  <div class="custom-control">
                      <label class="custom-control-label">{{ __('polledit.choosemax') }}{{$pollj->mul_maxnum}}{{ __('polledit.ignore') }}</label>
                  </div>
                @endif
              </div>

              <div class="form-group">
              <button type="submit" class="btn btn-primary" >{{ __('polledit.submit') }}</button>
              </div>

            @endif
          </div>
          @include ('layouts.errors')
        </form>
      </div>
    </div>
  </div>
</div>

@else

    @include('polls._showResult',['notExpired'=>$notExpired,
    'isNotVoted'=>$isNotVoted])
@endif


@endsection
