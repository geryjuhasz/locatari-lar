<html>
	<head>
		{{ Html::style('packages/bootstrap/css/bootstrap.css') }}
		{{ Html::style('css/general.css') }}
		{{ Html::style('css/login.css') }}
		{{ Html::style('css/main.css') }}
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
		
		
		{{ Html::script('js/jquery.mtz.monthpicker.js') }}
		{{ Html::script('js/main.js') }}
                
		<script>
			urls = {
				adsController: '{{ URL::to("ads") }}',
				usersController: '{{ URL::to("users") }}',
				reportsController: '{{ URL::to("reports") }}'
			};
			@yield('script', '')
		</script>
		<title>@yield('title', 'Asociatie')</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1>Asociatie.ro</h1>
			</div>
			<div class="header-left">
				@include('partials.nav')
			</div>
                        <div class="header-right">
                                @include('partials.header_selector')
			</div>
			<div class="row" id="content">
				@include('partials.flash')
				@yield('content')
				@include('partials.monthpicker_settings')
			</div>
		</div>


	</body>
</html>