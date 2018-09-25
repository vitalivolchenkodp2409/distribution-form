@extends('layouts.login')

@section('content')

    <div class="form-horizontal">
        <div class="msg">Authorization Request</div>
        <div>
            <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>
        </div>
        @if (count($scopes) > 0)
            <div class="scopes">
                    <p><strong>This application will be able to:</strong></p>

                    <ul>
                        @foreach ($scopes as $scope)
                            <li>{{ $scope->description }}</li>
                        @endforeach
                    </ul>
            </div>
        @endif
        <div style="display: flex; flex-direction: row; justify-content: space-between; margin-top: 20px;">
             <form method="post" action="{{ url('/oauth/authorize') }}">
                {{ csrf_field() }}

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <button type="submit" class="btn btn-success btn-approve">Authorize</button>
            </form>
            <form method="post" action="{{ url('/oauth/authorize') }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <button class="btn btn-danger">Deny</button>
            </form>
        </div>
        <!-- <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
                <a href="sign-up.html">Register Now!</a>
            </div>
            <div class="col-xs-6 align-right">
                <a href="forgot-password.html">Forgot Password?</a>
            </div>
        </div> -->
    </div>
@endsection