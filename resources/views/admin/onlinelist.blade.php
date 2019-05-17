@extends ('layouts.app')
@section ('content')
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-sm-6 my-2">

          <div class="panel panel-default" id="divUsers">

            <div class="panel-heading">{{ __('onlineuser.registerd') }}</div>
            <div class="panel-body">
              <div class="form-row">
                @if (!empty($onlineusers) )
                  <table class="table table-hover table-responsive">
                  <thead>
                  <tr>
                      <th>id</th>
                      <th>{{ __('onlineuser.name') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                     @foreach ($onlineusers as  $key => $value)
                    <tr>
                      <td>{{ $key }}</td>
                      <td>{{ $value }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @endif
              </div>
            </div>

            <div class="panel-heading">{{ __('onlineuser.unregisterd') }}</div>
            <div class="panel-body">
              <div class="form-row">
                @if (!empty($onguests) )
                  <table class="table table-hover table-responsive">
                  <thead>
                  <tr>
                      <th>ip</th>
                      <th>{{ __('onlineuser.expiration') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                     @foreach ($onguests as  $onguest)
                    <tr>
                      <td>{{ $onguest->key }}</td>
                      <td>{{ $onguest->expiration}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @endif
              </div>
            </div>


          </div>


          </div>
    </div>
  </div>
@endsection
