<div class="row">
	<div class="col-sm-4 col-sm-offset-4 form-design">
		{!! Form::label('privacy', 'Privacy', ['class' => 'control-label']) !!}
		{!! Form::select('privacy', ['Anonymous'=> 'Anonymous', 'Raw'=> 'Raw'], null, ['class' => 'form-control', 'required' => 'required']) !!}

		{!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
		{!! Form::select('type', ['Audio'=> 'Audio', 'Video'=> 'Video'], null, ['class' => 'form-control', 'required' => 'required']) !!}

		{!! Form::label('number', 'Number', ['class' => 'control-label']) !!}
		{!! Form::select('number', ['3'=> '3','4'=> '4','5'=> '5','6'=> '6','7'=> '7','8'=> '8','9'=> '9','10'=> '10','11'=> '11','12'=> '12','13'=> '13','14'=> '14','15'=> '15','16'=> '16','17'=> '17','18'=> '18','19'=> '19','20'=> '20'], null, ['class' => 'form-control', 'required' => 'required']) !!}

		<br>
		{!! NoCaptcha::renderJs() !!}
		{!! NoCaptcha::display() !!}
		<br>
		<p><input id="field_terms" type="checkbox" required>
		<label for="field_terms">I accept the <u>Terms and Conditions</u></label></p>

		{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary btn-block form-margin']) !!}	
	</div>
</div>
