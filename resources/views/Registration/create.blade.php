@extends ('layouts.app')
@section ('content')
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-md-6 col-sm-8">
    <div class="panel panel-default" id="divUsers">
      <div class="panel-heading ">{{ __('register.title') }}</div>
      <div class="panel-body">
          <form method="POST" action="/register">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">{{ __('register.name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value= "{{ old('name') }}" required>
              </div>

              <div class="form-group">
                <label for="email">{{ __('register.email') }}</label>
                <input type="email" class="form-control" id="email" name="email"  value= "{{ old('email') }}" required>
              </div>

              <div class="form-group">
                <label for="password">{{ __('register.password') }}</label>
                <input type="password" class="form-control" id="password" name="password"  value="{{ old('password') }}" required>
              </div>

              <div class="form-group">
                <label for="password_confirmation">{{ __('register.passwordconfirm') }}</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                value="{{ old('password_confirmation') }}" required>
              </div>


              <section class="dec">
              		<h3 style="text-align: center;">{{ __('register.declaration') }}</h3>
              		<ol>
                    <li>{{ __('register.d1') }}</li>
                    <li>{{ __('register.d2') }}</li>
              		<li>{{ __('register.d3') }}</li>
              		</ol>
              	</section>

              <div class="form-group">
                <button type="submit" class="btn btn-primary" >{{ __('register.submit') }}</button>
              </div>

              <div class="form-group">
                @include ('layouts.errors')
              </div>

          </form>
        </div>
      </div>
      </div>
</div>
</div>



@endsection
