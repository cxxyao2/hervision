@extends ('layouts.app')
@section ('content')

      <div class="container">
           <div class="col-md-8 col-sm-6 my-0">
           @if (session('flash'))
                <div class="alert alert-success">
                {{ session('flash')}}
                </div>
            @endif
           
        
          <div class="col-md-8 offset-md-2 col-sm-6 my-0">
               @include ('layouts.errors')
           </div>

           <form class="form" role="form" method="post" action="/posts">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" name="body" class="form-control" placeholder="Content"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Submit Post</button>
                </div>
            </form>
            </div>
  </div>


@endsection
