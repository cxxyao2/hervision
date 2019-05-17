@extends('layouts.app')
@section('content')

@if ((Auth::check()) && (( Auth::user()->id == $profileuser->id )|| Auth::user()->isAdmin()))
  <div class="container">
    <div class="row ">
      <div class="col-md-4 col-sm-6 " >
                  @include('profiles._userstat_sidebar', [
                  'profileuser' => $profileuser,
                  'indicators' => $indicators,
                   'favoritecnt' => $favoritecnt,
                   'subs' => $subs,
                   'besubs'=> $besubs,
                   'finances' => $finances,
                   'followings' => $followings,
                   'fans' => $fans,
                   'mytags' => $mytags,
                   'factors'=>$factors
                  ])
      </div>


      <div class="col-md-8 col-sm-6 ">
        <div class="panel panel-default" >
          @php
          {{  $finalsum = 0;    }}
          @endphp
        <div class="panel-heading">{{__('statfinance.accounting')}}</div>
        <div class="panel-body">
            @if (!empty($finances))
                <table class="table table-hover table-responsive">
                  <thead>
                  <tr>
                      <th>{{__('statfinance.ym')}}</th>
                      <th>{{__('statfinance.income')}}</th>
                      <th>{{__('statfinance.expenditure')}}</th>
                      <th>{{__('statfinance.balance')}}</th>
                  </tr>
                  </thead>

                  <tbody>
                     @foreach ($finances as  $finance)
                    <tr>
                        @if(config('database.default') == 'mysql')
                            <td>{{ $finance->year.' . '.$finance->month }}</td>
                            <td class="plus">{{ $finance->insum }}</td>
                            <td class="plus">{{ $finance->outsum }}</td>
                            <td  class="{{ $finance->outsum > $finance->insum ? 'minus' : 'plus' }}">{{ round($finance->insum - $finance->outsum,2) }}</td>
                            <?php  $finalsum = $finalsum + $finance->insum - $finance->outsum ; ?>

                        @else
                            <td>{{ $finance['year'].' . '.$finance['month'] }}</td>
                            <td class="plus">{{ $finance['insum'] }}</td>
                            <td class="plus">{{ $finance['outsum'] }}</td>
                            <td  class="{{ $finance['outsum'] > $finance['insum'] ? 'minus' : 'plus' }}">{{ round($finance['insum'] - $finance['outsum'],2) }}</td>
                            <?php  $finalsum = $finalsum + $finance['insum'] - $finance['outsum'] ; ?>

                        @endif
                     </tr>
                    @endforeach
                    <tr>
                      <td>{{__('statfinance.total')}}</td>
                      <td></td>
                      <td></td>
                      <td>{{ $finalsum }}</td>
                    </tr>
                  </tbody>
                </table>


                @if(config('database.default') == 'mysql')
                    <td>{{ $finance->year.' . '.$finance->month }}</td>
                @else
                      <td>{{ $finance['year'].' . '.$finance['month'] }}</td>
                @endif

                <table class="table table-hover table-responsive">
                  <thead>
                  <tr>
                      <th>{{__('statfinance.catagory')}}</th>
                      <th>{{__('statfinance.subtotal')}}</th>
                  </tr>
                  </thead>
                    <tbody>
                      @foreach ($catagorysum as  $cata)
                     <tr>
                       <td>{{ $cata->category }}
                            @if (substr($cata->acccode,0,2) == '00')
                              <em>+</em>
                            @else
                             <em>-</em>
                            @endif
                       <td>{{ $cata->number }}</td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
            @endif
    </div>

         <!-- end of  sum -->

         <div class="panel-heading">{{__('statfinance.accountingdetails')}}</div>
         <div class="panel-body">
           <div class="form-row">
             @foreach( $threads as $thread)
             <table class="table table-hover table-responsive">
               <tbody>
                  <tr>{{ $thread->title}} &nbsp;&nbsp;&nbsp; {{ $thread->body}}</tr>
                </tbody>
            </table>
             @endforeach
           </div>
          </div>
          </div>
        </div>
    </div>
  </div>
  @else
    <p>{{ __('profile.noRights') }}</p>
    <a href="{{ url('/') }}">{{ __('profile.backtop') }}</a>
  @endif


  @endsection
