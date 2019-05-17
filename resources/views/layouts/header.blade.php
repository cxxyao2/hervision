<header>
 <div class="navbar navbar-expand bg-dark flex-column flex-md-row bd-navbar" style=" border-top: 3px  solid  rgb(240,148,2); box-shadow:0px 0px 3px 3px rgba(240,148,2,0.2)" >
<a class="navbar-brand mr-0 mr-md-2"  style="color: white; font-size: 120%;" href="/" aria-label="Her vision">{{ __('header.navigate') }}</a>

<div class="navbar-nav-scroll">
 <ul class="navbar-nav bd-navbar-nav flex-row">
   <li class="nav-item">
     <a class="nav-link header "  style="color: white;" href="{{ route('threads.index',$channels[0]->slug)}}" >{{ __('header.books') }}</a>
   </li>
   <li class="nav-item">
     <a class="nav-link  header" style="color: white;" href="{{ route('threads.index',$channels[1]->slug)}}" >{{ __('header.techs') }}</a>
   </li>
   <li class="nav-item">
     <a class="nav-link  header btn btn-warning"  style="color: white;"href="{{ route('threads.create') }}" >{{ __('header.say') }}</a>
   </li>
   <li class="nav-item">
     <a class="nav-link header "  style="color: white;" href="{{ route('threads.index',$channels[2]->slug)}}" >{{ __('header.ledger') }}</a>
   </li>
   <li class="nav-item">
     <a class="nav-link  header"  style="color: white;" href="{{ route('threads.index',$channels[3]->slug)}}" >{{ __('header.society') }}</a>
   </li>

 </ul>
</div>

<ul class="navbar-nav flex-row ml-md-auto ">

  <li class="nav-item">
    <form class="form-inline bg-white" method="get"  action="/threads/search" >
      {{  Form::hidden('url',URL::previous())  }}
      <input class="form-control" style="background:url('/images/search1.png')  no-repeat right top ; background-size: 20px 20px;
       padding-left:5px; width:200px"  type="search" placeholder="{{ __('header.search') }}"
       id="searchCriteria" name="searchCriteria" required>
    </form>
  </li>

  @if (Auth::check())

    <li class="nav-item dropdown">
       <a id="navbarDropdown" class="nav-link dropdown-toggle header" style="color: white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
           {{ Auth::user()->name }}
           @if (auth()->user()->islocked())
            <span class='glyphicon glyphicon-lock'></span>
            @endif

            @if (!empty(auth()->user()->unreadNotifications()) && (auth()->user()->unreadNotifications()->count()>0))
             <span class='glyphicon glyphicon-bell'></span>
             @endif
       </a>
       <div class="dropdown-menu bg-white dropdown-menu-right" aria-labelledby="navbarDropdown">
           <a class="dropdown-item"   href="{{ route('profile',Auth::user() )}}">{{ __('header.profile') }}</a>
           <a class="dropdown-item"  href="{{ route('profiles.userstat',Auth::user() )}}">{{ __('header.statistics') }}</a>
           <a class="dropdown-item"   href="{{ route('profile.mysubscrips',Auth::user()->id )}}">{{ __('header.subscribe') }}</a>
           <a class="dropdown-item"  href="{{ route('profiles.notifyAllTypes',Auth::user()->id) }}" >{{ __('header.notifications') }}
             <span class="badge"> {{  auth()->user()->unreadNotifications()->count() }}</span>
           </a>
           <a class="dropdown-item" href="{{ route('polls.index') }}">{{ __('header.polllist') }}</a>
        

           <div class="dropdown-divider"></div>
           @if(Auth::user()->isAdmin())
               <a class="dropdown-item" href="{{ route('admin.mainform') }}">{{ __('header.admin') }}</a>
               <a class="dropdown-item" href="{{ route('admin.onlinelist') }}">{{ __('header.onlinelist') }}</a>

           @endif
           <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
             {{ __('header.logout') }}
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
           </form>
       </div>
     </li>
  @else
    <li class="nav-item">
      <a class="nav-link headfooter"  style="color: white;"  href="{{ route('login') }}">{{ __('header.login') }}</a>
    </li>
     <li class="nav-item">
      <a class="nav-link headfooter"  style="color: white;"  href="{{ route('register') }}">{{ __('header.register') }}</a>
    </li>
  @endif




</ul>

</div>

</header>
