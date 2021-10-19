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
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <h1 class="display-8">Urlaubsübersicht</h1>
                <table class="table table-striped table-hover text-white">
                    <thead>
                        <tr>
                            <th scope="col">Mitarbeiter</th>
                            <th scope="col">Von</th>
                            <th scope="col">Bis</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absences as $absence)
                            <tr>
                                <th scope="row">{{$absence->user->name}}</th>
                                <td>{{$absence->readableStartDate()}}</td>
                                <td>{{$absence->readableEndDate()}}</td>
                                <td><span class="badge rounded-pill bg-success">bestätigt</span></td>
                                <td>
                                    @hasrole('Admin')
                                        <a href="{{route('deleteAbsence', $absence->id)}}"><span class="badge rounded-pill bg-danger">löschen</span></a>
                                    @else
                                        @if ($absence->user_id == Auth::user()->id)
                                            <a href="{{route('deleteAbsence', $absence->id)}}"><span class="badge rounded-pill bg-danger">löschen</span></a>
                                        @endif
                                    @endhasrole
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
