<div class="row">
	<div class="col-sm-4 col-sm-offset-4 form-design">
		{!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
		{!! Form::label('street', 'Street', ['class' => 'control-label']) !!}
		{!! Form::text('street', null, ['class' => 'form-control', 'required' => 'required']) !!}
		
		{!! Form::label('city', 'City', ['class' => 'control-label']) !!}
		{!! Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) !!}
		
		{!! Form::label('zip', 'Zip Code', ['class' => 'control-label']) !!}
		{!! Form::text('zip', null, ['class' => 'form-control', 'required' => 'required']) !!}
		
		{!! Form::label('state', 'State/Province', ['class' => 'control-label']) !!}
		{!! Form::text('state', null, ['class' => 'form-control', 'required' => 'required']) !!}
		
		{!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
		{!! Form::text('country', null, ['class' => 'form-control', 'required' => 'required']) !!}
		<br>
		{!! NoCaptcha::renderJs() !!}
		{!! NoCaptcha::display() !!}
		<br>
		<p><input id="field_terms" type="checkbox" required>
		<label for="field_terms">I accept the <u>Terms and Conditions</u></label></p>

		{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary btn-block form-margin']) !!}	
	</div>
</div>
