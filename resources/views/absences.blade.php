@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-xl-12 col-md-12 mb-5">
                <h1 class="display-8">Abwesenheiten</h1>
                <table class="table table-striped table-hover text-white">
                    <thead>
                        <tr>
                            <th scope="col">Mitarbeiter</th>
                            <th scope="col">Von</th>
                            <th scope="col">Bis</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absences as $absence)
                            <tr>
                                <th scope="row">{{$absence->user->name}}</th>
                                <td>{{$absence->readableStartDate()}}</td>
                                <td>{{$absence->readableEndDate()}}</td>
                                <td><span class="badge rounded-pill bg-success">bestätigt</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
