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
                <div class="card bg-light py-3 px-3">
                    <h1 class='fs-3 mb-3'>Urlaub einreichen</h1>
                    <form method="POST" action="{{route('formCreateAbsence')}}">
                        @csrf
                        <input type="hidden" class="btn-check" name="absence_type" id="btnradio1" autocomplete="off" value="2" checked>
                        <div class="mb-3">
                          <label for="selectStartDate" class="form-label">Von Datum</label>
                          <input type="date" class="form-control" id="selectStartDate" name="start_date" value="{{old('start_date')}}">
                          <div id="dateHelp" class="form-text">Rechts auf den Kalender klicken, um das Datum einfacher auszuwählen.</div>
                        </div>
                        <div class="mb-3">
                          <label for="selectEndDate" class="form-label">Bis Datum</label>
                          <input type="date" class="form-control" id="selectEndDate" name="end_date" value="{{old('end_date')}}">
                        </div>
                        <button type="submit" class="btn btn-primary text-white">Einreichen</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
