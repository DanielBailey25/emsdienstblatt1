@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 py-4">
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
                <div class="card bg-light py-3 px-3">
                    <h1 class='fs-3'>Ausbildung freischalten</h1>
                    <div class="card-body">
                        <form method="POST" action="{{route('unlockTrainingForUsers')}}">
                            @csrf
                            <div class="form-group">
                                <label>Mitarbeiter auswählen:</label>
                                <select style="height: 200px" id="category" name="users[]" multiple class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->rank}} {{$user->name}}</option>
                                    @endforeach
                                </select>
                                <div id="dateHelp" class="form-text">Mit cmd oder strg kannst du mehrere Benutzer auswählen.</div>
                            </div>
                            <div class="form-group mt-2">
                                <label>Kurs auswählen</label>
                                <select id="category" name="training" class="form-control">
                                    @foreach ($trainings as $training)
                                        <option value="{{$training->id}}">{{$training->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-4">
                                <input type="submit" class="btn btn-primary text-white" name="submit" value="Freischalten" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
