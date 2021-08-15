@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class='row py-4'>
            <div class='col-md-5'>
                <div class='card bg-grey'>
                    <div class='card-body'>
                        <center>
                            <img src="https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png" width="140" height="140" style="border-radius: 50%;">
                            <h1 class="fs-4 text mt-3 text-white">{{$user->name}}</h1>
                            <h1 class="fs-6 text mt-3">Rank: {{$user->rank}}</h1>
                            <h1 class="fs-6 text">Dienstnummer: {{$user->service_number}}</h1>
                        </center>
                    </div>
                </div>
            </div>
            <div class='col-md-7'>
                <div class='card bg-grey'>
                    <div class='card-body'>
                        <div class="row">
                            <div class="col-6">
                                Telefonnummer:
                            </div>
                            <div class="col-6">
                                {{$user->phone}}
                            </div>
                            <div class="dropdown-divider bg-light"></div>
                            <div class="col-6">
                                Stunden / Woche:
                            </div>
                            <div class="col-6">
                                8 Stunden 32 Minuten
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
