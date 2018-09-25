@extends('layouts.login')

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="msg">Sign in</div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-line">
                <input type="email" class="form-control"  placeholder="Email" value="{{ old('email') }}"  id="email" name="email"  required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8 p-t-5">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}  id="rememberme" class="filled-in chk-col-pink">
                <label for="rememberme">Remember Me</label>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-sm-offset-3">
                    <a href="{{ url('/auth/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Log-in with Facebook</a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-sm-offset-3">
                    <a href="{{ url('/auth/reddit') }}" class="btn btn-primary btn-reddit"><i class="fa fa-reddit fa-fw"></i> Log-in with Reddit</a>
                </div>
            </div>
        </div>
        <!-- <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
                <a href="sign-up.html">Register Now!</a>
            </div>
            <div class="col-xs-6 align-right">
                <a href="forgot-password.html">Forgot Password?</a>
            </div>
        </div> -->
    </form>
@endsection