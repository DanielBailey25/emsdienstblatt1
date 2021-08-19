@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class="row align-items-center h-100">
            <div class="col-md-5 mx-auto">
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
                <div class="card bg-light p-3">
                    <form method="POST" action="{{route('createEvent')}}">
                        @csrf
                        <h1 class="fs-3 mb-4">Termin erstellen</h1>
                        <div class="mb-3">
                            <label for="selectReceiver" class="form-label">Einladung an:</label>
                            <select name="receiver_id" class="form-select">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="selectDate" class="form-label">Datum</label>
                            <input type="date" class="form-control" id="selectDate" name="date" value="{{old('date')}}">
                        </div>
                        <div class="mb-3">
                            <label for="selectTime" class="form-label">Uhrzeit</label>
                            <input type="time" class="form-control" id="selectTime" name="time" value="{{old('time')}}">
                        </div>
                        <div class="mb-3">
                            <label for="addLocation" class="form-label">Ort</label>
                            <input type="text" class="form-control" id="addLocation" name="location" value="{{old('location')}}">
                            <div id="locationHelp" class="form-text">Dieses Feld ist optional</div>
                        </div>
                        <button type="submit" class="btn btn-primary text-white">Erstellen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
