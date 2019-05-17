@extends ('layouts.app')

@section ('content')

@if(auth()->check())

    <div class="container" >
      <div class="row">
        <!-- notification type -->
        <div class="col-md-4 col-sm-6">
          <div class="list-group" v-cloak>
            @forelse ($notifyTypes as $k1=>$v1)
            <a href="#{{$k1}}" class="list-group-item list-group-item-action">{{ $k1 }}<span class="badge">{{ $notifications[$k1]->count() }}</span></a>
                @empty
                <p>{{ __('notify1.settype') }}</p>
            @endforelse
          </div>

        </div>



        <div class="col-md-8 col-sm-6 " v-cloak>
          <div class="container">
              <form method="post" id="myform" >
                {{ csrf_field()}}
                @method('delete')
            @forelse ($notifyTypes as $k1=>$v1)
              <div class="panel panel-default" id="{{ $k1 }}">
                  <div class="panel-heading">
                      <h5 class="panel-title">{{ $k1}}</h5>
                  </div>

                    <ul class="list-group">
                      @forelse($notifications[$k1] as $notification)

                      <?php
                        $newUrl = '/profiles/' .auth()->user()->name .'/notifications/'.$notification->id;
                      ?>
                      <li class="list-group-item">
                         <a href="{{ $notification->data['link'] }}"  >
                            {{ $notification->data['message']  }}
                         </a>
                          <button id="btn1" class="btn btn-outline-primary"
                            onclick="submitMyform('{{$newUrl}}')">
                            <span class='glyphicon glyphicon-edit'>{{ __('notify1.read') }}</span></button>
                          </button>
                      </li>
                      @empty
                        <p>{{ __('notify1.nounread') }} {{ $k1 }}</p>
                      @endforelse

                    </ul>

              </div>
          @empty
                 <p>{{ __('notify1.settype') }}</p>
          @endforelse

        </form>
    </div>
  </div>

  @else
    <p class="text-center">please<a href="{{ route('login') }}">{{ __('notify1.login') }}</a>
  @endif

  @endsection
