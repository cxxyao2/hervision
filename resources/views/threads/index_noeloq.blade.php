@extends ('layouts.app')
@section ('content')

 @if (!Empty($threads) && !is_null($threads) && ($threads->count()>0))
      <div class="container">
      <div class="row ">
          <div class="col-md-8  offset-md-2 my-0 col-sm-6">

            @include ('threads._list_noeloq')
              {{ $threads->links() }}

            @include ('layouts.errors')

        </div>
    </div>
  </div>

  @else
    <p>{{ __('home.norecords') }}</p>
  @endif

@endsection
