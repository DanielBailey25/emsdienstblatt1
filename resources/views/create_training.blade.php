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
                    <h1 class='fs-3'>Ausbildung hinzufügen</h1>
                    <div class="card-body">
                        <form method="POST" action="{{route('createTraining')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="title">Titel</label>
                                <input required value="{{old('title')}}" class="form-control bg-light" name="title" rows="1">
                            </div>
                            <div class="form-group mt-2">
                                <label for="url">Datei</label>
                                <input required type="file" class="form-control bg-light" name="file">
                                <div id="uploadFileHelp" class="form-text">pdf, jpeg, jpg, png</div>
                            </div>
                            <div class="form-group mt-4">
                                <input type="submit" class="btn btn-primary text-white" name="submit" value="Erstellen" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
