@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row ">
    <div class="col-md-8 col-md-offset-2 col-md-6">
    <div class="panel panel-info">

      @if ((Auth::check()) && (( Auth::user()->id == $profileUser->id )|| Auth::user()->isAdmin()))

        <div class="panel-heading">
            <h3 class="panel-title">
                {{ __('profile.basic') }} {{  Auth::user()->islocked()? "__('profile.lock') " :'' }}
            </h3>
        </div>

        <div class="panel-body">
            <form  class="form-horizontal" method="POST" action="{{ route('profiles.update', $profileUser) }}">
              {{ csrf_field() }}
              @method('PATCH')
              <input type="hidden" id="loginUserId" name="loginUserId" value="{{ $profileUser->id }}">

              <div class="form-group ">
                  <label for="name" class="col-sm-2 control-label ">{{ __('profile.name') }} </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('profile.name') }} "
                      value="{{ $profileUser->name}}" />
                   </div>
              </div>

              <div class="form-group ">
                  <label for="i3" class="col-sm-2 control-label ">{{ __('profile.email') }} </label>
                  <div class="col-sm-10 mt-2">
                      <input type="text" class="form-control" id="i3" placeholder="{{ __('profile.email') }} " disabled
                      value="{{ $profileUser->email}}"/>
                  </div>
              </div>

              <div class="form-group">
                  <label for="password" class="col-sm-2 control-label ">{{ __('profile.password') }} </label>
                  <div class="col-sm-10">
                      <input type="password" value="{{ $profileUser->password}}" class="form-control my-2 " id="password"
                      name="password" placeholder="{{ __('profile.password') }} "/>
                  </div>
              </div>

              <div class="form-group">
                  <label for="password-confirm" class="col-sm-2 control-label">{{ __('profile.password_confirmation') }} </label>
                  <div class="col-sm-10">
                      <input type="password" class="form-control" id="password-confirm"
                      name="password_confirmation"  value="{{ $profileUser->password}}" placeholder="{{ __('profile.password_confirmation') }}" required/>
                  </div>
              </div>


                <div class="form-group ">
                    <label for="personal_profile" class="col-sm-2 control-label ">{{ __('profile.profile') }}</label>
                    <div class="col-sm-10">
                      <input name="personal_profile" id="personal_profile"
                      class="form-control "
                      value="{{ $profileUser->personal_profile }}"
                      placeholder="{{ __('profile.profilelimit')}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-2 control-label">{{ __('profile.favoritelang') }} </label>
                    <div class="col-sm-10">
                        <label class="radio-inline mx-4"><input name="locale" type="radio"
                        value="en"  {{($profileUser->locale=="en")? "checked" : "" }} /> {{ __('profile.english') }}</label>
                        <label class="radio-inline mx-4"><input name="locale" type="radio"
                        value="zh" {{ ($profileUser->locale=="zh")? "checked" : "" }} /> {{ __('profile.chinese') }}</label>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">{{ __('profile.save') }}</button>
                  </div>
                </div>

            </form>

            <form class="form-horizontal" method="POST" action="{{ route('profiles.download', $profileUser) }}">
              {{ csrf_field() }}
              <div class="form-group ">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">{{ __('profile.download') }}</button>
                </div>
              </div>
            </form>
    </div>
<hr>

            <div class="panel-body">
                <form  class="form-horizontal" id="myform" method="POST"  action="{{ route('avatar', $profileUser) }}"
                    enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputFile" class="col-sm-2 control-label">{{ __('profile.avatar') }}</label>
                        <div class="col-sm-10">
                            <img src="{{ $profileUser->avatar() }}"  class="imgNew rounded"
                            style="width:30px; height:30px">
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label">{{ __('profile.newavatar') }} </label>
                        <div class="col-sm-10">
                            <label class="control-inline border mx-2 p-2"><input id="avatar" name="avatar"  type="file" required></label>
                            <label class="control-inline"><button class="btn btn-primary" type="submit" >{{ __('profile.updateAva') }}</button></label>
                        </div>
                    </div>

                    <div class="form-group ">
                      <div class="col-sm-offset-2 col-sm-10">
                        <span>{{ __('profile.supportFile') }}</span>
                      </div>
                    </div>

                </form>

                @if ($flash = session('message'))
                    <div class="alert alert-success" role="alert">
                    {{ $flash}}
                    </div>
                @endif
                @include ('layouts.errors')
            </div>

        </div>
        @else
          <p>{{ __('profile.noRights') }}</p>
          <a href="{{ url('/') }}">{{ __('profile.backtop') }}</a>
        @endif

      </div>
    </div>
  </div>
</div>

@endsection
