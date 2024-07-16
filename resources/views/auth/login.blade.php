@extends('web.layout')

@section('title')
    Sign In
@endsection

@section('main')
    	<!-- Hero-area -->
        <div class="hero-area section">

            <!-- Backgound Image -->
            <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/page-background.jpg')}})"></div>
            <!-- /Backgound Image -->

            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <ul class="hero-area-tree">
                            <li><a href="{{ url('/') }} ">{{__('web.home')}}</a></li>
                            <li>{{__('web.signin')}}</li>
                        </ul>
                        <h1 class="white-text">{{__('web.signInDesc')}}</h1>

                    </div>
                </div>
            </div>

        </div>
        <!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- login form -->
					<div class="col-md-6 col-md-offset-3">
						<div class="contact-form">
							<h4>{{__('web.signin')}}</h4>

                            @include('web.include.messages')

							<form method="POST" action="{{ url('/login') }}">
                                @csrf
								<input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
								<input class="input" type="password" name="password" placeholder="{{__('web.password')}}">
                                <a href="{{url('/register')}}">{{__('web.noAccount')}}</a>
                                <br>
                                <input type="checkbox" id="" name="remember"> {{__('web.rememberMe')}}
                                <br>
								<button id="signin-form-btn" type="submit" class="main-button icon-button pull-right">{{__('web.signin')}}</button>
							</form>
                            {{-- <a href="{{url('forgot-password')}}"> {{__('web.forgotPassword')}}? </a> --}}
						</div>
					</div>
					<!-- /login form -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->
@endsection