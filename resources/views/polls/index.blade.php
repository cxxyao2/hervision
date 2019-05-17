@extends ('layouts.app')
@section ('content')



  <div class="container">
      <div class="col-md-8 offset-md-2 col-sm-6">
      @if (!Empty($polljs) && !is_null($polljs) && ($polljs->count()>0))
        <div class=" border mt-0 text-center"><h4>{{ __('pollindex.polllist') }}</h4></div>
        @foreach ($polljs as $pollj)

          <div class="card mt-1">
            <div class="card-header">
              {{ __('pollindex.title') }} <a href="/polls/{{ $pollj->id }} "> {{ $pollj->title }} {{ __('pollindex.pollresult') }}</a>
            </div>
            <div class="card-body border-top" >
                  <div> {{ __('pollindex.pollcontent') }} </div>
                 <html-display data="{{ $pollj->content  }}" ></html-display>
            </div>
        </div>
        @endforeach
        {{ $polljs->links() }}
      @else
        <p>{{ __('pollindex.norecords') }}</p>
      @endif
    </div>
    </div>


@endsection
