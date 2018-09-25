@extends('layouts.app2')

@section('content')
<div id="oauth-container">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>OAuth Clients</h2>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <passport-clients></passport-clients>
              <passport-authorized-clients></passport-authorized-clients>
              <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
  </section>
</div>
<style>
.card.card-default {
  padding: 9px 12px;
}
</style>
<script src="{{url('/js/oauth.js')}}"></script>
@endsection