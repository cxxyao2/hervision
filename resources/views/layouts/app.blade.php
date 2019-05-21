<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- seo -->
    <meta name="keyword" content="science,education,culture">
    <meta name="description" content="a forum about interesting tech tips and books">
    <meta name="author" content="hervision 2019">


    <title>{{ config('app.name', 'HerVision') }}</title>
    <link rel="shortcut icon" href="/images/ponytail.ico" />

    <!-- Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
     <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css" >

    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140439383-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140439383-1');
</script>


      <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
      </script>

    <style>
      body{
        background-color: rgba(240,242,245,0.5);
      }
      .level { display: flex; align-items: center; }
      .level-item { margin-right: 1em;}
      .flex { flex: 1; }
      .mr-1 { margin-right: 1em; }
      [v-cloak] {display:none }
      .nodisplay {display:none}
      .showNow {display:block}
      .blue1 {
        color: rgb(99,156,249);
        font: italic bold;
      }

      /*fromat the table headings*/
        .cal td{
        	width:75px;
        	vertical-align: top;
        }

        .avatar1 {
          width: 60px;
          height: 60px;
          border-radius: 50%;
          border:1px solid ;
        }

        .imgNew {
          width: 20px;
          height: 20px;
          display: inline-block;
        }


        a.header:hover{
        	background-color: rgb(240,148,2);
          width: 100px;
          -webkit-border-radius:5px;
         color:white;
        }

        a.header:focus{
          background: 		rgb(240,148,2);
          width: 100px;
          -webkit-border-radius:5px;

        }

        a.myfooter:hover{
          background: 		rgb(240,148,2);
          width: 100px;
          -webkit-border-radius:5px;

        }

        a.myfooter:focus{
          background: 		rgb(240,148,2);
          width: 100px;
          -webkit-border-radius:5px;

        }



        .tagdefault {
            margin-left: 4px;
            background: 		rgb(63,69,79);
            color: #ffffff;

        }

        .tagselect {
            margin-left: 4px;
            background: 		rgb(240,148,2);
            color: #000000;

        }

        section.dec{
          width: 80%;
        	display: inline;
        	float: center;
        	margin-right: 2%;
          border:1px

        }

        div.smallheader{
          display: flex;
          flex:1;
          text-align:center;
          line-height: 100%;
          background-color: rgba(240,242,245,0.5);
          font-size: 110%;
        }

        div.bigheader{
          display: flex;
          flex:1;
          align-items: center;
          line-height: 120%;
        }

        td.minus{
          background-color: red;
          color: white ;
          text-align: right;
          -webkit-border-radius: 5px 5px 5px 5px ;
	          border-radius: 5px 5px 5px 5px ;
        }

        td.plus{
          background-color: white;
          color: black bold;
          text-align: right;
        }

    </style>
</head>
  <body>
    <div id="app">
       @include ('layouts.header')
       <div class="container">

           <main>
            @yield('content')
          </main>

        @include('layouts.flash')
        @include ('layouts.footer')
    </div>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="{{ asset('js/display.js') }}" defer></script>
       @yield('js')
    </div>
  </body>
</html>
