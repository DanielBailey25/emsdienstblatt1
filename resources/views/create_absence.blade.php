@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class="row align-items-center h-100">
            <div class="col-5 mx-auto">
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
                    <h1 class='fs-3'>Abwesenheit einreichen</h1>
                    <form method="POST" action="{{route('formCreateAbsence')}}">
                        @csrf
                        <div class="btn-group mb-2" role="group">
                            <input type="radio" class="btn-check" name="absence_type" id="btnradio2" autocomplete="off" value="1" checked>
                            <label class="btn btn-outline-primary text-white" for="btnradio2">Freistellung</label>

                            <input type="radio" class="btn-check" name="absence_type" id="btnradio1" autocomplete="off" value="2">
                            <label class="btn btn-outline-primary text-white" for="btnradio1">Urlaub</label>

                            <input type="radio" class="btn-check" name="absence_type" id="btnradio3" autocomplete="off" value="3">
                            <label class="btn btn-outline-primary text-white" for="btnradio3">Besprechung</label>
                        </div>
                        <div class="mb-3">
                          <label for="selectStartDate" class="form-label">Von Datum</label>
                          <input type="date" class="form-control" id="selectStartDate" name="start_date" value="{{old('start_date')}}">
                          <div id="dateHelp" class="form-text">Rechts auf den Kalender klicken, um das Datum einfacher auszuwählen.</div>
                        </div>
                        <div class="mb-3">
                          <label for="selectEndDate" class="form-label">Bis Datum</label>
                          <input type="date" class="form-control" id="selectEndDate" name="end_date" value="{{old('end_date')}}">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="addTime" name="time_added">
                            <label class="form-check-label" for="addTime">Uhrzeit angeben</label>
                          </div>
                        <div id="timeBlock" class="d-none">
                            <div class="mb-3">
                                <label for="selectStartTime" class="form-label">Ab Uhrzeit</label>
                                <input type="time" class="form-control" id="selectStartTime" name="start_time" value="{{old('start_time')}}">
                            </div>
                            <div class="mb-3">
                                <label for="selectEndTime" class="form-label">Bis Uhrzeit</label>
                                <input type="time" class="form-control" id="selectEndTime" name="end_time" value="{{old('end_time')}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary text-white">Einreichen</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var checkbox = document.getElementById('addTime');

    checkbox.addEventListener('change', function() {
    if (this.checked) {
        timeBlock = document.getElementById('timeBlock');
        timeBlock.classList.remove('d-none');
    } else {
        timeBlock = document.getElementById('timeBlock');
        timeBlock.classList.add('d-none');
    }
    });
</script>
@endsection
