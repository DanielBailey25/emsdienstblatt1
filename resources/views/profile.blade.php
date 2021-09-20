@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class='row py-4'>
            <div class='col-md-6'>
                <div class='card bg-grey'>
                    <div class='card-body'>
                        <center>
                            <img src="https://pbs.twimg.com/media/DkqIyk5XoAAAK6i.jpg" width="140" height="140" style="border-radius: 50%;">
                            <h1 class="fs-4 text mt-3 text-white">{{$user->name}}</h1>
                            <h1 class="fs-6 text mt-3">Rank: {{$user->rank}}</h1>
                            <h1 class="fs-6 text">Einreise-ID: {{$user->player_id}}</h1>
                        </center>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card bg-grey'>
                    <div class='card-body'>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{route('changePassword')}}">
                            @csrf
                            <div class="mb-3">
                              <label for="selectStartDate" class="form-label">Altes Passwort</label>
                              <input required type="password" class="form-control" id="selectStartDate" name="old_pw" value="{{old('old_pw')}}">
                            </div>
                            <div class="mb-3">
                              <label for="selectEndDate" class="form-label">Neues Passwort</label>
                              <input required type="password" class="form-control" id="selectEndDate" name="new_pw" value="{{old('new_pw')}}">
                            </div>
                            <div class="mb-3">
                                <label for="selectEndDate" class="form-label">Neues Passwort wiederholen</label>
                                <input required type="password" class="form-control" id="selectEndDate" name="repeat_new_pw" value="{{old('repeat_new_pw')}}">
                              </div>
                            <button type="submit" class="btn btn-primary text-white">Ändern</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class='col-md-6 py-3'>
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
                                N/A
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-6 py-3'>
                <div class='card bg-grey'>
                    <div class='card-body'>
                        <div class="row">
                            <div class="col-6">
                                Bugs melden:
                            </div>
                            <div class="col-6">
                                LuaScript76#6969
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
