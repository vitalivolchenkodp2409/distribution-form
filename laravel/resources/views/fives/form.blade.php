<div class="row">
	<div class="col-sm-4 col-sm-offset-4 form-design">
		
		{!! Form::label('video', 'Video', ['class' => 'control-label']) !!}
		{!! Form::file('video', null, ['class' => 'form-control', 'required' => 'required']) !!}

		{!! Form::label('referral_emails', 'Referral Emails', ['class' => 'control-label']) !!}
		{!! Form::email('referral_emails', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		<br>
		{!! NoCaptcha::renderJs() !!}
		{!! NoCaptcha::display() !!}
		<br>
		<p><input id="field_terms" type="checkbox" required>
		<label for="field_terms">I accept the <u>Terms and Conditions</u></label></p>

		{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary btn-block form-margin']) !!}	
	</div>
</div>
