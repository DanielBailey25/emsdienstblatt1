<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-grey d-flex sticky-top">
    <div
        class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2">
        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5"><span class="d-none d-sm-inline">{{Auth::user()->client->name}} Dienstblatt</span></span>
        </a>
        <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start"
            id="menu">
            <li class="nav-item">
                <a href="{{ route('startWorker') }}" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-box-arrow-right text-success"></i><span class="ms-2 d-none d-sm-inline">Eintragen</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('formStopWorker') }}" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-box-arrow-left text-danger"></i><span class="ms-2 d-none d-sm-inline">Austragen</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('createAbsence') }}" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-calendar-date"></i><span class="ms-2 d-none d-sm-inline">Abwesenheit</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfh_YNEnEPwsKTOdZyjNwpzXdQQAoEF461_sZbHGJ8REpxcTw/viewform" target="_blank" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-journal-text"></i><span class="ms-2 d-none d-sm-inline">Prüfungsanmeldung</span>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-house"></i><span class="ms-2 d-none d-sm-inline">Dienstblatt</span>
                </a>
            </li>
            <li>
                <a href="{{ route('workers') }}" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-people"></i><span class="ms-2 d-none d-sm-inline">Mitarbeiter</span> </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fs-5 bi-info-square"></i><span class="ms-2 d-none d-sm-inline">Information</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="{{ route('showAbsences') }}">Freistellungen</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('events') }}">Termine</a></li>
                    <li><a class="dropdown-item" href="{{ route('news') }}">News</a></li>
                    <li><a class="dropdown-item" href="{{ route('bans') }}">Hausverbote</a></li>
                    <li><a class="dropdown-item" href="{{ route('interns') }}">Praktikanten</a></li>
                    {{-- <li><a class="dropdown-item" href="{{ route('showAbsences') }}">Krankenscheine</a> --}}
                    </li>
                    <li><a class="dropdown-item" href="{{ route('nordmap') }}">Norden-Karte</a></li>
                </ul>
            </li>
            @if ($trainings->count() > 0)
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fs-5 bi-book"></i><span class="ms-2 d-none d-sm-inline">Ausbildung</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                        @foreach ($trainings as $training)
                            @can('call training_' . $training->id)
                                <li><a class="dropdown-item" href="{{route('training', [$training->id])}}">{{$training->title}}</a></li>
                            @endcan
                        @endforeach
                    </ul>
                </li>
            @endif
            @hasanyrole('Admin|Editor')
                {{-- Don't display the administration area under md size. --}}
                <li class="d-none d-md-block">
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown d-none d-md-block">
                    <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fs-5 bi-building"></i><span class="ms-2 d-none d-sm-inline">Administration</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                        @hasrole('Admin')
                            <li><a class="dropdown-item" href="{{ route('users') }}">Benutzer verwalten</a></li>
                            <li><a class="dropdown-item" href="{{route('createTraining')}}">Ausbildung hinzufügen</a></li>
                            {{-- <li><a class="dropdown-item" href="#">Gebäude / Fahrzeuge</a></li> --}}
                        @endhasrole
                        <li><a class="dropdown-item" href="{{route('unlockTrainingView')}}">Ausbildungen freischalten</a></li>
                    </ul>
                </li>
            @endhasanyrole
        </ul>
        <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png"
                    alt="hugenerd" width="28" height="28" class="rounded-circle">
                <span class="d-none d-sm-inline mx-2">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="{{route('profile')}}">Profil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Abmelden
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
