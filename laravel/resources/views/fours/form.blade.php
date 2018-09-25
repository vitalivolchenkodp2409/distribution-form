<div class="row">
	<div class="col-sm-4 col-sm-offset-4 form-design">
		{!! Form::label('email_address', 'Email Address', ['class' => 'control-label']) !!}
		{!! Form::email('email_address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		{!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
		{!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		{!! Form::label('university_email_address', 'University Email Address', ['class' => 'control-label']) !!}
		{!! Form::email('university_email_address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		{!! Form::label('university_website', 'University Website', ['class' => 'control-label']) !!}
		{!! Form::text('university_website', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		{!! Form::label('undergraduate_major', 'Undergraduate Major', ['class' => 'control-label']) !!}
		{!! Form::text('undergraduate_major', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		{!! Form::label('graduation_year', 'Graduation Year', ['class' => 'control-label']) !!}
		{!! Form::text('graduation_year', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}


		{!! Form::label('ethereum_address', 'Ethereum Address', ['class' => 'control-label']) !!}
		{!! Form::text('ethereum_address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

		<br>
		<p><input id="university_ambassadors" type="checkbox" name="university_ambassadors" value="Yes">
		<label for="university_ambassadors">Would you like to be University Ambassador?</label></p>


		<br>
		{!! NoCaptcha::renderJs() !!}
		{!! NoCaptcha::display() !!}

		<br>
		<p><input id="field_terms" type="checkbox" required>
		<label for="field_terms">I accept the <u>Terms and Conditions</u></label></p>


		{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary btn-block form-margin']) !!}	
	</div>
</div>
