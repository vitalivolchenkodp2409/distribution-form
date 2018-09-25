    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">

                    @if($current_user->avatar == null)
                        <img src="{{ URL::asset('images/user.png') }}" width="48" height="48" alt="User" />
                    @else
                        <img src="{{ $current_user->avatar }}" width="48" height="48" alt="User" />
                    @endif
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$current_user->name}}</div>
                    <div class="email">{{$current_user->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            @can('Manage Own Profile')
                            <li>
                                <a href="{{url('/profile')}}"><i class="material-icons">person</i>Profile</a>
                            </li>
                            @endcan
                            <li>
                                <a href="{{ url('/select-type') }}" ><i class="material-icons">autorenew</i>Change Type</a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="material-icons">input</i>Sign Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{!! url('/home') !!}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
			<li>
			<a href="{{ url('/select-type') }}">
				<i class="material-icons">autorenew</i>
				<span>Change Account Type</span>

			</a>
			</li>

                    <li>
                        <a href="{{ url('/zeros/create') }}">
                            <i class="material-icons">spellcheck</i>
                            <span>Ethereum Address</span>
                        </a>
                    </li>
                    @if($current_user->type=="simple"||$current_user->type=="advance")
			<li class="header">SIMPLE VERIFICATIONS </li>
			<ul>
                    <li>
                        <a href="{{ url('/ones/create') }}">
                            <i class="material-icons">account_box</i>
                            <span>Home Address</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/twos/create') }}">
                            <i class="material-icons">assessment</i>
                        	    <span>DUBs</span>
                	        </a>
               	     </li>
        	            <li>
        	                <a href="{{ url('/threes/create') }}">
        	                    <i class="material-icons">perm_phone_msg</i>
                            <span>Phone Verification</span>
       	                 </a>
     	               </li>
			</ul>


			@endif
                    @if($current_user->type=="advance")

			 <li class="header">ADVANCED VERIFICATIONS</li>
				<ul>

			 <li>
                            <a href="{{ url('/fives/create') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>IRT Activity</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/fives/create') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>Snap Score</span>
                            </a>
                        </li>
			<li>
                            <a href="{{ route('fbpage') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>Link Facebook</span>
                            </a>
                        </li>

                       {{-- <li>
                            <a href="{{ url('/fives/create') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>Reddit Karma</span>
                            </a>
                        </li>--}}
                        <li>
                            <a href="{{ route('reddpage') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>Reddit Karma</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('snapchat_page') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>Snapchat Story</span>
                            </a>
                        </li>

			</ul>
			<li class="header">LEGACY VERIFICATIONS</li>
                                <ul>
                        <li>
                            <a href="{{ url('/fives/create') }}">
                                <i class="material-icons">camera_roll</i>
                                <span>Selfie verification</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/fours/create') }}">
                                <i class="material-icons">school</i>
                                <span>University verification</span>
                            </a>
                        </li>
			</li>

			</ul>
            @if(auth()->user()->email === 'admin@projectoblio.com')
            <li class="header">OAUTH CLIENTS</li>
                <ul>
                    <li>
                        <a href="{{ url('/oauth-clients') }}">
                            <i class="material-icons">security</i>
                            <span>Oauth Clients</span>
                        </a>
                    </li>
                </ul>
            @endif
			</li>

			</ul>

                    @endif


                </ul>
            </div>
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
{{--         <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside> --}}
        <!-- #END# Right Sidebar -->
    </section>
