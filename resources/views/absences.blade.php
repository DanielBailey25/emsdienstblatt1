@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            @foreach ($absenceTypes as $absenceType)
                <div class="col-xl-6 mb-5">
                    <h1 class="display-8">Typ: {{$absenceType->name}}</h1>
                    <table class="table table-striped table-hover text-white">
                        <thead>
                            <tr>
                            <th scope="col">Mitarbeiter</th>
                            <th scope="col">Von</th>
                            <th scope="col">Bis</th>
                            @if($absenceType->id != 2)
                                <th scope="col">Status</th>
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absenceType->absences() as $absence)
                                <tr>
                                    <th scope="row">{{$absence->user->name}}</th>
                                    <td>{{$absence->from}}</td>
                                    <td>{{$absence->to}}</td>
                                    @if ($absence->approvedBy)
                                    <td><span class="badge rounded-pill bg-success">{{$absence->approvedBy->name}}</span></td>
                                    @elseif($absence->id != 2)
                                    <td><span class="badge rounded-pill bg-primary">Nicht bestätigt</span></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
