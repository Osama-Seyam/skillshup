@extends('web.layout')

@section('title')
    Skills : {{$skill->name()}}
@endsection

@section('main')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/blog-post-background.jpg')}} )"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
                            <li><a href="/">Home</a></li>
							<li><a href="{{url("categories/show/{$skill->category->id}")}}">{{$skill->category->name()}}</a></li>
							<li>{{$skill->name()}}</li>
						</ul>
						<h1 class="white-text">{{$skill->name()}}</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Blog -->
		<div id="blog" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- main blog -->
					<div id="main" class="col-md-12">

						<!-- row -->
						<div class="row">

                            @foreach ($skill->exams as $exam)
                                <!-- single exam -->
                                <div class="col-md-4">
                                    <div class="single-blog">
                                        <div class="blog-img">
                                            <a href="skill.html">
                                               <a href="{{url("exams/show/{$exam->id}")}}"><img  src="{{ asset("uploads/$exam->img")}}" alt=""></a>
                                            </a>
                                        </div>
                                        <h4><a href="{{url("exams/show/{$exam->id}")}}">{{$exam->name()}}</a></h4>
                                        <div class="blog-meta">
                                            <span>{{ Carbon\Carbon::parse($exam->created_at)->format('d M, Y') }}</span>
                                            <div class="pull-right">
                                                <span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{ $exam->users()->count()}} </a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							    <!-- /single exam -->
                            @endforeach
						</div>
						<!-- /row -->

					</div>
					<!-- /main blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

@endsection