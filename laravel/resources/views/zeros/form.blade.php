<div class="row">
	<div class="col-sm-4 col-sm-offset-4 form-design">
		{!! Form::label('ethereum_address', 'Ethereum Address', ['class' => 'control-label']) !!}
		{!! Form::text('ethereum_address', null, ['class' => 'form-control', 'required' => 'required']) !!}

{{-- 		{!! Form::label('ip', 'IP', ['class' => 'control-label']) !!}
		{!! Form::text('ip', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}

		<br>
		{!! NoCaptcha::renderJs() !!}
		{!! NoCaptcha::display() !!}
		<br>


		<p><input id="field_terms" type="checkbox" required>
		<label for="field_terms">I accept the <u>Terms and Conditions</u></label></p>

		{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary btn-block form-margin']) !!}		
	</div>
</div>

