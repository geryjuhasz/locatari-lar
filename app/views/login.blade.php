<html>
	<head>
		{{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('css/general.css') }}
		{{ HTML::style('css/login.css') }}
		{{ HTML::style('css/main.css') }}
		
		{{-- HTML::script('packages/bootstrap/js/bootstrap.js') --}}
		{{ HTML::script('js/jquery.js') }}
		{{ HTML::script('js/jquery-ui.custom.js') }}
		{{ HTML::script('js/main.js') }}
		<title>Login</title>
	</head>
	<body class="login">
		<div class="container">
			<form class="form-signin" method="POST" action="{{ URL::action('AdminsController@login') }}">
				@include('partials.flash')
				<h3 class="form-signin-heading">Asociatie.ro login</h3>
				<input name="name" class="form-control" type="text" autofocus="" placeholder="Name">
				<input name="password" class="form-control" type="password" placeholder="Password">
				<label class="checkbox">
					<input name="remember" type="checkbox" value="remember-me">
					Remember me
				</label>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</div>
	</body>
</html>