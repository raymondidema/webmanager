<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	<title>Installatie webmanager</title>
	<link rel="stylesheet" href="/assets/twitter/css/bootstrap.css">
	<!-- <link rel="stylesheet" href="/assets/twitter/css/bootstrap-theme.css"> -->
	<link rel="stylesheet" href="/assets/stylesheet.css">
	
	
</head>
<body style="padding-top:50px;">
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-3 col-md-offset-3">

				<h1><span class="glyphicon glyphicon-dashboard"></span> Webmanager <small>{{ Lang::get('webmanager::content.installation') }} step 2</small></h1>
				<hr />
				@if(count($errors))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Lang::get('webmanager::errors.database_connect') }}
				</div>
				<hr />
				@endif
				<p>{{ Lang::get('webmanager::content.informationStep2', ['email' => '<a href="mailto:'. Config::get('webmanager::company_details.support_email') .'">'. Config::get('webmanager::company_details.support_email') .'</a>']) }}</p>
				<p><small>&copy; 2013 copyright {{ Config::get('webmanager::company_details.company') }}</small></p>

			</div>
			<div class="col-md-3">
			{{ Form::open() }}
				<div class="form-group">
					{{ Form::label('username','Username') }}
					{{ Form::text('username',null,['class' => 'form-control' ,'placeholder' => 'Superadmin']) }}
				</div>
				<div class="form-group">
					{{ Form::label('email','Email address') }}
					{{ Form::text('email',null,['class' => 'form-control' ,'placeholder' => 'Email address', 'type' => 'email']) }}
				</div>
				<div class="form-group">
					{{ Form::label('password','Password') }}
					{{ Form::password('password',['class' => 'form-control' ,'placeholder' => 'Password']) }}
					<div id="passwordindicator">
						<div class="password"></div>
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('password_confirm','Password confirm') }}
					{{ Form::password('password_confirm',['class' => 'form-control' ,'placeholder' => 'Password confirm']) }}
				</div>
				<div class="form-group">
					{{ Form::submit(Lang::get('webmanager::forms.save'),['class' => 'btn btn-info']) }}
				</div>
			{{ Form::close() }}
			</div>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="/assets/twitter/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function()
		{
			$('#password').on('keyup',function()
			{
				checkPassword($(this).val());
			});
		});

		function checkPassword(password)
		{
			var strength = 0;

			if (password.length > 7) strength += 1
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength +=1

			if(strength < 1)
			{
				$('.password').css('width','0%')
				$('.password').css('background','black')
				$('#passwordindicator').css('color','black')
			}
			else if(strength == 1)
			{
				$('.password').css('width','25%')
				$('.password').css('background','red')
				$('#passwordindicator').css('color','red')
			}
			else if(strength == 2)
			{
				$('.password').css('width','50%')
				$('.password').css('background','orange')
				$('#passwordindicator').css('color','orange')
			}
			else if(strength == 3)
			{
				$('.password').css('width','75%')
				$('.password').css('background','green')
				$('#passwordindicator').css('color','green')
			}else
			{
				$('.password').css('width','100%')
				$('.password').css('background','green')
				$('#passwordindicator').css('color','green')
			}

		}
	</script>
</body>
</html>