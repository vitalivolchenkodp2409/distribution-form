<div class="row">
	<div class="col-sm-4 col-sm-offset-4 form-design">
		{!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
		{!! Form::text('phone_number', null, ['class' => 'form-control', 'required' => 'required']) !!}


		<br>
		{!! NoCaptcha::renderJs() !!}
		{!! NoCaptcha::display() !!}
		<br>
		<p><input id="field_terms" type="checkbox" required>
		<label for="field_terms">I accept the <u>Terms and Conditions</u></label></p>

		{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary btn-block form-margin']) !!}	
	</div>
</div>
