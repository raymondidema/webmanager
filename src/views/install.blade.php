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

				<h1><span class="glyphicon glyphicon-dashboard"></span> Webmanager <small>{{ Lang::get('webmanager::content.installation') }}</small></h1>
				<hr />
				@if(count($errors))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Lang::get('webmanager::errors.database_connect') }}
				</div>
				<hr />
				@endif
				<p>{{ Lang::get('webmanager::content.welcome', ['email' => '<a href="mailto:'. Config::get('webmanager::company_details.support_email') .'">'. Config::get('webmanager::company_details.support_email') .'</a>']) }}</p>
				<p><small>&copy; 2013 copyright {{ Config::get('webmanager::company_details.company') }}</small></p>

			</div>
			<div class="col-md-3">
			{{ Form::open() }}
				<div class="form-group">
					{{ Form::label('language', Lang::get('webmanager::forms.select_language')) }}
					{{ Form::select('language', ['' => Lang::get('webmanager::forms.choose_language')
					,'nl' => Lang::get('webmanager::forms.dutch'),
					'en' => Lang::get('webmanager::forms.english'),
					'fr' => Lang::get('webmanager::forms.france'),
					'de' => Lang::get('webmanager::forms.german'),
					'it' => Lang::get('webmanager::forms.italian'),
					],
					Cookie::get('lang','none')
					) }}
				</div>
				<div class="form-group">
				{{ Form::label('database',Lang::get('webmanager::forms.database'),['class' => 'control-label']) }}
				{{ Form::text('database',null,['class' => 'form-control' ,'placeholder' => Lang::get('webmanager::forms.database')]) }}
				</div>
				<div class="form-group">
				{{ Form::label('username',Lang::get('webmanager::forms.username')) }}
				{{ Form::text('username',null,['class' => 'form-control', 'placeholder' => Lang::get('webmanager::forms.username')]) }}
				</div>
				<div class="form-group">
				{{ Form::label('password',Lang::get('webmanager::forms.password')) }}
				{{ Form::password('password',['class' => 'form-control', 'placeholder' => Lang::get('webmanager::forms.password')]) }}
				</div>
				<div class="form-group">
				{{ Form::label('prefix',Lang::get('webmanager::forms.dbprefix')) }}
				{{ Form::text('prefix',null,['class' => 'form-control', 'placeholder' => 'ex_']) }}
				</div>
				<div class="form-group">
					{{ Form::submit(Lang::get('webmanager::forms.validate'),['class' => 'btn btn-info']) }}
				</div>
			{{ Form::close() }}
			</div>
		</div>
	</div>
	{{ HTML::script('http://code.jquery.com/jquery-1.10.1.min.js') }}
	{{ HTML::script('/packages/raymondidema/webmanager/twitter/js/bootstrap.min.js') }}
	<script>
		$('#language').change(function()
		{
			window.location = '/installation/'+$(this).val();
		})
	</script>
</body>
</html>