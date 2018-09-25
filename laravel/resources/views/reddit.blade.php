@extends('layouts.app2')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Selfi Varification</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" align="center">
                            <h2>
                                Welcome to the Reddit Page!
                            </h2>
                        </div>
                        <div class="body">

                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    <strong>Success!</strong> {{ Session::get('flash_message') }}
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> {{ Session::get('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="center-block">

                                @if(isset($data['provider']) && isset($data['mess']) )

                                    <div class="form-group" align="center">
                                        <p>
                                            {{ $data['mess'] }}
                                        </p>
                                    </div>
                                    <div class="form-group" align="center">
                                        <form id="unlink-form" action="{{ route('unlink_reddit') }}" method="post" role="form" style="display: block;" >
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="unlink" id="unlink"  class="btn btn-primary btn-facebook" value=" Unlink Reddit ">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <p>
                                            If you click Unlink Reddit, you lose 1 Arrows!
                                        </p>
                                    </div>

                                @else

                                    <div class="form-group" align="center">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-offset-3">
                                                <a href="{{ url('/home/reddit/reddit') }}" class="btn btn-primary btn-reddit"><i class="fa fa-reddit"></i> Log-in with Reddit </a>
                                            </div>
                                        </div>
                                        <p>
                                            Join now and will received 1 arrows per 100 reddit-comment-karma! Max 30 arrows.
                                        </p>
                                    </div>

                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection