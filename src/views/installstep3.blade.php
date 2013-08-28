<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	<title>Installatie webmanager</title>
	{{ HTML::style('/packages/raymondidema/webmanager/twitter/css/bootstrap.css') }}
	{{ HTML::style('/packages/raymondidema/webmanager/stylesheet.css') }}
	
	
</head>
<body style="padding-top:50px;">
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-3 col-md-offset-3">

				<h1><span class="glyphicon glyphicon-dashboard"></span> Webmanager <small>{{ Lang::get('webmanager::content.installation') }} step 3</small></h1>
				<hr />
				@if(count($errors))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Lang::get('webmanager::errors.email') }}
				</div>
				<hr />
				@endif
				<p>{{ Lang::get('webmanager::content.informationStep3', ['email' => '<a href="mailto:'. Config::get('webmanager::company_details.support_email') .'">'. Config::get('webmanager::company_details.support_email') .'</a>']) }}</p>
				<p><small>&copy; 2013 copyright {{ Config::get('webmanager::company_details.company') }}</small></p>

			</div>
			<div class="col-md-3">
			{{ Form::open() }}
				<div class="form-group">
					{{ Form::label('driver','Mail driver') }}
					{{ Form::select('driver', ['' => Lang::get('webmanager::forms.choose_sendsystem')
					,'smtp' => 'smtp',
					'mail' => 'mail',
					'sendmail' => 'sendmail'
					], 'smtp') }}
				</div>
				<div class="form-group">
					{{ Form::label('encryption','E-Mail Encryption Protocol') }}
					{{ Form::select('encryption', ['' => Lang::get('webmanager::forms.choose_sendoption')
					,'tls' => 'tls',
					'ssl' => 'ssl',
					
					], 'tls') }}
				</div>
				<div class="form-group">
					{{ Form::label('hostname','SMTP Host Address') }}
					{{ Form::text('hostname',null,['class' => 'form-control' ,'placeholder' => 'smtp.example.com']) }}
				</div>
				<div class="form-group">
					{{ Form::label('port','SMTP Host Port') }}
					{{ Form::text('port',null,['class' => 'form-control' ,'placeholder' => '587']) }}
				</div>
				<div class="form-group">
					{{ Form::label('fromemail','Global "From" Address') }}
					{{ Form::text('fromemail',null,['class' => 'form-control' ,'placeholder' => 'Name', 'type' => 'email']) }}<Br />
					{{ Form::text('fromname',null,['class' => 'form-control' ,'placeholder' => 'Email address', 'type' => 'email']) }}
				</div>
				<div class="form-group">
					{{ Form::label('username','SMTP Server Username') }}
					{{ Form::text('username',null,['class' => 'form-control' ,'placeholder' => 'Email address', 'type' => 'email']) }}
				</div>
				<div class="form-group">
					{{ Form::label('password','SMTP Server Password') }}
					{{ Form::password('password',['class' => 'form-control' ,'placeholder' => 'Password']) }}
				</div>
				<div class="form-group">
					{{ Form::submit(Lang::get('webmanager::forms.save'),['class' => 'btn btn-info']) }}
				</div>
			{{ Form::close() }}
			</div>
		</div>
	</div>
	{{ HTML::script('http://code.jquery.com/jquery-1.10.1.min.js') }}
	{{ HTML::script('/packages/raymondidema/webmanager/twitter/js/bootstrap.min.js') }}
</body>
</html>