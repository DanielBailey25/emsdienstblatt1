@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class='row py-4'>
            <div class='col-md-6'>
                <h1 class="display-8">Benutzer erstellen</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                <div class='card bg-grey'>
                    <div class='card-body'>
                        <div class='row'>
                            <form action="{{route('createUserForm')}}" method="POST">
                                @csrf
                                <div class="form-group mt-2">
                                    <label for="name">Name</label>
                                    <input class="form-control bg-light" name="name" value="{{old('name')}}" rows="1">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="name">Passwort</label>
                                    <input type="password" class="form-control bg-light" name="password"  rows="1">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="name">Rank</label>
                                    <input type="number" min="0" class="form-control bg-light" value="{{old('rank')}}" name="rank" rows="1">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="name">Dienstnummer</label>
                                    <input type="number" min="0" class="form-control bg-light" value="{{old('service_number')}}" name="service_number" rows="1">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="name">Telefonnummer</label>
                                    <input type="number" class="form-control bg-light" value="{{old('phone')}}" name="phone" rows="1">
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="role">Rolle auswählen</label>
                                    <select name="role" class="form-select bg-light">
                                        @foreach ($roles as $role)
                                            <option value={{$role->name}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary text-white mt-4">Benutzer erstellen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection