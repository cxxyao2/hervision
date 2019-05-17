@extends ('layouts.app')

@section ('content')

@if(auth()->check())

    <div class="container" >
      <div class="row">
        <!-- notification type -->

          <div class="container">

              <div class="panel panel-default" id="{{ $notifyType->key }}">
                <div class="panel-heading">
                      <h5 class="panel-title">{{ $v}}</h5>
                  </div>
                  <div class="panel-body">
                    <ul class="list-group">
                    @forelse ($notifications as $notification)
                      <li class="list-group-item">  <a href="{{ $notification->link }} ">{{ $notification->message }}</a></li>
                    @empty
                     <p>{{ __('notifyType.nounreads') }} {{$v }} </p>
                    @endforelse
                  </ul>
                  {{ $notifications->links() }}
                 </div>
                </div>
              </div>
          </div>
        </div>

  @else
    <p class="text-center">please<a href="{{ route('login') }}">{{ __('notifyType.login') }}</a>
  @endif

  @endsection
