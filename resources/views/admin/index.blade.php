@extends ('layouts.app')
@section ('content')
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-sm-6 my-2">

          <div class="panel panel-default" id="divUsers">
            <div class="panel-heading">{{ __('adminindex.usersadmin') }}</div>
            <div class="panel-body">

              <div class="form-row">
                  <div class="form-group col-md-4">
                    <select class="form-control" id="userSelect">
                      <option value="0" checked>id</option>
                      <option value="1">username</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                     <input class="form-control mr-sm-2" type="search" placeholder="Search"
                      aria-label="userSearch" id="userSearch" name="userSearch">
                  </div>
                  <div class="form-group col-md-4">
                     <button class="btn btn-warning my-2"
                     name="btnusers" id="btnusers">{{ __('adminindex.searchuser') }}</button>
                 </div>
                 </div>
                 @if (!empty($users))
                  @include ('admin._userlist',['users' => $users])
                 @endif
            </div>
          </div>


          <div class="panel panel-default" id="divThreads">
            <div class="panel-heading">{{ __('adminindex.threadsadmin') }}</div>
            <div class="panel-body">
              <div class="form-row">
                  <div class="form-group col-md-4">
                    <select class="form-control" id="threadSelect">
                      <option value="0">id</option>
                      <option value="1" checked>title</option>
                      <option value="2">body</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <input class="form-control mr-sm-2" type="search" placeholder="threadSearch"
                    aria-label="threadSearch"  id="threadSearch" name="threadSearch">
                  </div>
                  <div class="form-group col-md-4">
                      <button class="btn btn-warning my-2"
                      name="btnthreads" id="btnthreads">{{ __('adminindex.searchthreads') }}</button>
                 </div>
                </div>

                @if (!empty($threads))
                  @include ('admin._threadlist')
                @endif

            </div>
          </div>
          </div>
    </div>
  </div>
@endsection

@section ('js')

<script type="text/javascript" src="{{URL::asset('/js/admin_user_thread.js')}}"></script>

@endsection
