@extends('layouts.app')

@section('content')

@if ((Auth::check()) && (( Auth::user()->id == $profileuser->id )|| Auth::user()->isAdmin()))

  <div class="container">
    <div class="row ">
      <div class="col-md-4 col-sm-6 " cloak>
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

        <div class="col-md-8 col-sm-6 " v-cloak>
        	@include ('threads._list',['threads' => $threads])
            {{$threads->links()}}
       </div>
      </div>
    </div>
    @else
      <p>{{ __('profile.noRights') }}</p>
      <a href="{{ url('/') }}">{{ __('profile.backtop') }}</a>
    @endif

@endsection
