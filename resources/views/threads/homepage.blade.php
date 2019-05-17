@extends('layouts.app')

@section('content')
<div class="container col-md-10 my-0">
<div id="myCarousel" class="carousel slide justify-content-center hidden ">
	<!-- 轮播（Carousel）指标 -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	<!-- 轮播（Carousel）项目 -->
	<div class="carousel-inner">
		<div class="item active  ">
			<img src="./images/tree1.jpg" alt="red" >
			<div class="carousel-caption">
		        <h3>金色的树</h3>
		        <p>中秋最美，加拿大北部!</p>
	      	</div>

		</div>
		<div class="item ">
			<img src="./images/tree2.jpg" alt="red" >
			<div class="carousel-caption">
		        <h3>红色的树</h3>
		        <p>初秋最美，加拿大北部!</p>
	      	</div>

		</div>

		<div class="item ">
			<img src="./images/tree3.jpg" alt="red" >
			<div class="carousel-caption">
		        <h3>绿色的树</h3>
		        <p>夏天最美，加拿大北部!</p>
	      	</div>
		</div>
	</div>
	<!-- 轮播（Carousel）导航 -->
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>


  <div class="row justify-content-center">
		<div class="col-md-10 col-sm-6 ">
			@foreach($channels as $channel)

		      <div  style="border-radius:5px 5px 0 0;margin-top: 5px; background-color:rgb(240,148,2); color: white;font: 20px bold ; ">
		          {{ $channel->name }}
		      </div>

				@include ('threads._list',['threads' => $threadslist[$channel->id]])

				<div class="panel panel-footer border " style=" background-color:white; color: blue;" ><em><a href="/threads/{{$channel->name}}" >{{__('threads.readmore')}} </a></em></div>

			@endforeach

		</div>
	</div>

</div>

@endsection
