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
                                Welcome to the Facebook Page!
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

                                    @if(isset($data['provider']))

                                        <div class="form-group" {{ $data['mark'] == true ? 'hidden':'' }} align="center">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-offset-3">
                                                    <a href="{{ url('/home/facebook/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Log-in with Facebook </a>
                                                </div>
                                            </div>
                                            <p>
                                                Join now and will received 3 Arrows! 30 Arrows max for friends.
                                            </p>
                                        </div>
                                        <div class="form-group" align="center">
                                            <form id="unlink-form" action="{{ route('unlink_fb') }}" method="post" role="form" style="display: block;" >
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <input type="submit" name="unlink" id="unlink"  class="btn btn-primary btn-facebook" value=" Unlink Facebook ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <p>
                                                If you click Unlink Facebook, you lose 1 Arrows!
                                            </p>

                                        </div>

                                        @if(!Session::has('friends'))

                                            <div class="form-group"  {{ $data['mark'] == false ? 'hidden':'' }} align="center">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-offset-3">
                                                        <a href="{{ url('/home/facebook/friends/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Find Friends </a>
                                                    </div>
                                                </div>
                                                <p>
                                                    You need at least 100 friends and 16 photos to earn Arrows here.
                                                </p>
                                            </div>

                                        @else

                                            <div class="form-group" align="center">
                                                <form id="unlink-form" action="{{ route('friendslock') }}" method="post" role="form" style="display: block;" >
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-sm-offset-3">
                                                                <input type="submit" name="unlink" id="unlink"  class="btn btn-primary btn-facebook" value=" Remove access to friends ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <p>
                                                    If you click Unlink Facebook, you lose 1 Arrows!
                                                </p>
                                            </div>

                                            {{--@if ( $friends = session('friends'))

                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Facebook friends
                                                        </h2>
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            @foreach($friends as $friend)
                                                                <p> <img src="{{$friend['picture']['data']['url']}}" alt="{{$friend['picture']['data']['url']}}" height="{{$friend['picture']['data']['height']}}">
                                                                    {{$friend['id']}} : {{$friend['name']}}</p>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>

                                            @endif--}}
                                            @if ( $friends = $data['friends'])


                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Facebook friends
                                                        </h2>
                                                    </div>
                                                    <div class="body">

                                                        <div class="row">
                                                            @foreach($friends as $friend)
                                                                <p> <img src="{{$friend['link_picture']}}" alt="{{$friend['link_picture']}}" height="{{$friend['link_picture']}}">
                                                                    {{$friend['id']}} : {{$friend['name']}}</p>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        @endif

                                        @if(!Session::has('fotos'))

                                            <div class="form-group" {{ $data['mark'] == false ? 'hidden':'' }} align="center">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-offset-3">
                                                        <a href="{{ url('/home/facebook/photos/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Add access to photos </a>
                                                    </div>
                                                </div>
                                                <p>
                                                    You need at least 100 friends and 16 photos to earn Arrows here.
                                                    If you does this earns 3 Karma.
                                                </p>
                                            </div>

                                        @else

                                            <div class="form-group" align="center">
                                                <form id="unlink-form" action="{{ route('lockPhotos') }}" method="post" role="form" style="display: block;" >
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-sm-offset-3">
                                                                <input type="submit" name="unlink" id="unlink"  class="btn btn-primary btn-facebook" value=" Remove access to photos ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <p>
                                                    If you click Unlink Facebook, you lose 1 Arrows!
                                                </p>
                                            </div>

                                            {{--@if ( $fotos = session('fotos'))

                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Facebook fotos
                                                        </h2>
                                                    </div>
                                                    <div class="body">

                                                        <div class="row">
                                                            @foreach($fotos as $foto)
                                                                <div class="col-3">
                                                                    <img src="{{$foto['images'][0]['source']}}" alt="{{$foto['id']}}" height="200">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif--}}
                                            @if ( $photos = $data['photos'])


                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Facebook fotos
                                                        </h2>
                                                    </div>
                                                    <div class="body">

                                                        <div class="row">
                                                            @foreach($photos as $photo)
                                                                <div class="col-3">
                                                                    <img src="{{$photo['link_photo']}}" alt="{{$photo['id']}}" height="200">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        @endif

                                        <div class="form-group" align="center">
                                            <form id="unlink-form" action="{{ route('like') }}" method="post" role="form" style="display: block;" >
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <input type="submit" name="unlink" id="unlink"  class="btn btn-primary btn-facebook" value=" Like our Facebook page ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <p>
                                                User who click "Like our Facebook page" will received 1 Arrows!
                                            </p>
                                        </div>

                                    @else

                                        <div class="form-group" {{ $data['mark'] == true ? 'hidden':'' }} align="center">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-offset-3">
                                                    <a href="{{ url('/home/facebook/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Log-in with Facebook </a>
                                                </div>
                                            </div>
                                            <p>
                                                Join now and will received 3 Arrows! 30 Arrows max for friends.
                                            </p>
                                        </div>

                                        <div class="form-group" align="center">
                                            <form id="unlink-form" action="{{ route('like') }}" method="post" role="form" style="display: block;" >
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <input type="submit" name="unlink" id="unlink"  class="btn btn-primary btn-facebook" value=" Like our Facebook page ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <p>
                                                User who click "Like our Facebook page" will received 1 Arrows!
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