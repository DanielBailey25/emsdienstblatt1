@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-5">
                <h1 class="display-8">Abwesenheiten</h1>
                <table class="table table-striped table-hover text-white">
                    <thead>
                        <tr>
                            <th scope="col">Mitarbeiter</th>
                            <th scope="col">Von</th>
                            <th scope="col">Bis</th>
                            <th scope="col">Status</th>
                            @role('Admin')
                                <th scope="col">Ablehnen</th>
                                <th scope="col">Bestätigen</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absences as $absence)
                            <tr>
                                <th scope="row">{{$absence->user->name}}</th>
                                <td>{{$absence->readableStartDate()}}</td>
                                <td>{{$absence->readableEndDate()}}</td>
                                @if ($absence->approvedBy)
                                    <td><span class="badge rounded-pill bg-success">{{$absence->approvedBy->name}}</span></td>
                                @elseif($absence->absence_type_id != 2)
                                    <td><span class="badge rounded-pill bg-primary">noch nicht bestätigt</span></td>
                                @elseif($absence->is_approved === false)
                                    <td><span class="badge rounded-pill bg-danger">abgelehnt</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-success">bestätigt</span></td>
                                @endif
                                @role('Admin')
                                    <td><button type="button" class="btn btn-default btn-sm" onclick="deleteItem(${curID})"><i class="fs-5 bi-x-circle text-danger"></i></button></td>
                                    <td><button type="button" class="btn btn-default btn-sm" onclick="deleteItem(${curID})"><i class="fs-5 bi-check-circle text-success"></i></button></td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
