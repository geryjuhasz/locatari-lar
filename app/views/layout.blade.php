<html>
	<head>
		{{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('css/general.css') }}
		{{ HTML::style('css/main.css') }}
		{{ HTML::style('css/jquery-ui/jquery-ui-1.10.3.custom.css') }}
                {{ HTML::style('css/datepicker.css') }}
		
		{{ HTML::script('packages/tinymce/tinymce.min.js') }}
		{{-- HTML::script('packages/ckeditor/ckeditor.js') --}}
		{{ HTML::script('js/jquery.js') }}
		{{ HTML::script('js/jquery-ui.custom.js') }}
		{{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('js/main.js') }}
                {{ HTML::script('js/bootstrap-datepicker.js') }}
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
			</div>
		</div>
	</body>
</html>