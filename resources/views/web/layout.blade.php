<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>SkillsHub - @yield('title')</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('web/img/logo.ico') }}">

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}" >

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('web/css/style.css ') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @yield('styles')
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->



    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="{{url('/')}}">
							<img src="{{ asset('web/img/logo.png') }} " alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

	        <!-- Navigation -->
			    <x-navbar></x-navbar>
            <!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->


        @yield('main')

        <!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- social -->
					<div class="col-md-4 col-md-push-8">

                        <!-- Social Links -->
						<x-social-links></x-social-links>
                        <!-- Social Links -->

					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
							<span>&copy; Copyright 2024. All Rights Reserved. | Made with <i class="fa fa-heart-o" aria-hidden="true"></i></span>
						</div>
					</div>
					<!-- /copyright -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->

		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="{{ asset('web/js/jquery.min.js') }} "></script>
		<script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }} "></script>
		<script type="text/javascript" src="{{ asset('web/js/main.js') }} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

        <script>

            $('#logout-link').click(function(e){
                e.preventDefault()
                $('#logout-form').submit()
            })
        </script>

        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('8348cf078eb9d94a91e8', {
                cluster: 'mt1'
            });

            var channel = pusher.subscribe('notifications-channel');
                channel.bind('exam-added', function(data) {
                    toastr.success(' Exam Was Deleted')
            });


        </script>

        @yield('scripts')

	</body>
</html>
