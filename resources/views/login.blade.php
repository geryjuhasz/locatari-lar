<html>
	<head>
		{{ Html::style('packages/bootstrap/css/bootstrap.css') }}
		{{ Html::style('css/general.css') }}
		{{ Html::style('css/login.css') }}
		{{ Html::style('css/main.css') }}
		
		{{ Html::script('js/jquery.js') }}
		{{ Html::script('js/jquery-ui.custom.js') }}
		{{ Html::script('js/main.js') }}
		<title>Login</title>
	</head>
	<body class="login">
		<div class="container">
			<form class="form-signin" method="POST" action="{{ URL::action('AdminsController@login') }}">
				@include('partials.flash')
				<h3 class="form-signin-heading">Asociatie.ro login</h3>
				<input name="name" class="form-control" type="text" autofocus="" placeholder="Name">
				<input name="password" class="form-control" type="password" placeholder="Password">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<label class="checkbox">
					<input name="remember" type="checkbox" value="remember-me">
					Remember me
				</label>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</div>
	</body>
</html>