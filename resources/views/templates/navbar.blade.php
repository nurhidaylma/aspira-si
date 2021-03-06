<nav class="navbar navbar-expand-lg navbar-light  nav-main sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('feed')}}">ASPIRA-SI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Route::currentRouteNamed('feed') || Route::currentRouteNamed('feedPopular') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('feed')}}">Feed <span class="sr-only">(current)</span></a>
                </li>
                @if(session(0)->getTable() == 'mahasiswa')
                    <li class="nav-item {{ Route::currentRouteNamed('all_announcement') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('all_announcement')}}">Announcement <span class="sr-only">(current)</span></a>
                    </li>
                @elseif(session(0)->getTable() == 'entitas_si')
                    <li class="nav-item {{ Route::currentRouteNamed('foryou') ? 'active' : '' }}">
                        {{--                        <a class="nav-link" href="{{route('foryou')}}">For You <span class="sr-only">(current)</span></a>--}}
                        <a class="nav-link" href="{{route('foryou')}}">For You <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed('announcement') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('announcement')}}">Announcement <span class="sr-only">(current)</span></a>
                    </li>
                @else
                    <li class="nav-item {{ Route::currentRouteNamed('bpmAllAspiration') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('bpmAllAspiration')}}">All Aspiration <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed('user_management') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('user_management')}}">User Management <span class="sr-only">(current)</span></a>
                    </li>
                @endif

                <li class="dropdown dr-notif ml-lg-5 ml-md-5 ml-sm-0">
                    <a class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-toggle="dropdown" href="#">
                        @if($notifikasiByUser->count() > 0)
                            <img src="{{asset('assets/icon/bell-fill.svg')}}" alt="">
                        @else
                            <img src="{{asset('assets/icon/bell.svg')}}" alt="">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 400px;max-height: 500px; overflow: scroll">
                        {{--                        if there is notification maka tampilkan di bawah ini, else...--}}
                        @if($notifikasiByUser->count() > 0)
                            <div class="dropdown-item">
                                <a href="{{route('delete_notifikasi')}}" class="dropdown-item-text text-right text-danger">delete all..</a>
                            </div>
                            @foreach($notifikasiByUser as $notif)
                                <div class="dropdown-item" style="white-space: normal;">
                                    <a href="{{route('detailAspiration',$notif->id_aspirasi)}}">
                                        <span class="dropdown-item-text " >Aspirasi: {{$notif->judul_aspirasi}}</span>
                                        <span class="dropdown-item-text" >{{$notif->teks_notifikasi}}</span>
                                    </a>
                                </div>
                                <div class="dropdown-divider"></div>
                            @endforeach
                        @else
                            <span class="dropdown-item disabled" href="profile-praktikan.html" disabled="true">No Notification</span>
                        @endif
                    </div>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-toggle="dropdown" href="#">
                        <img alt="image" class="rounded-circle mr-1" style="max-width: 30px"
                             src="{{asset('assets/img/telkom.jpg')}}">
                        @if(session(0)->getTable() == 'mahasiswa')
                            <div class="d-sm-none d-lg-inline-block">Hi, {{session(0)->nama_mahasiswa}}</div>
                        @elseif(session(0)->getTable() == 'entitas_si')
                            <div class="d-sm-none d-lg-inline-block">Hi, {{session(0)->nama_entitas}}</div>
                        @else
                            <div class="d-sm-none d-lg-inline-block">Hi, {{session(0)->username}}</div>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if(session(0)->getTable() == 'mahasiswa')
                            <a class="dropdown-item has-icon" href="{{route('profile',[session(0)->id_mahasiswa])}}">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                        @elseif(session(0)->getTable() == 'entitas_si')
                            {{--                            <a class="dropdown-item has-icon" href="{{route('profile',[session(0)->id_entitas])}}">--}}
                            {{--                                <i class="far fa-user"></i> Profile--}}
                            {{--                            </a>--}}

                            {{--                            <div class="dropdown-divider"></div>--}}
                        @else
                            {{--                            <a class="dropdown-item has-icon" href="{{route('admin_panel')}}">--}}
                            {{--                                <i class="far fa-user"></i> Admin Panel--}}
                            {{--                            </a>--}}

                            {{--                            <div class="dropdown-divider"></div>--}}
                        @endif

                        <a class="dropdown-item has-icon text-danger" href="{{route('logout')}}">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>
