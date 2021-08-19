@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="mb-4">
            <h1 class="display-8" style="display: inline">Terminübersicht</h1>
            <form action="{{route('createEvent')}}" style="float: right">
                <button type="submit" class="btn btn-success text-white">hinzufügen</button>
            </form>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($events->count() > 0)
            <table class="table table-striped table-hover text-white">
                <thead>
                    <tr>
                        <th scope="col">Von</th>
                        <th scope="col">An</th>
                        <th scope="col">Datum / Uhrzeit</th>
                        <th scope="col">Ort</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ablehnen</th>
                        <th scope="col">Bestätigen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <th scope="row">{{$event->sender->name}}</th>
                            <th scope="row">{{$event->receiver->name}}</th>
                            <td>{{$event->datetime}}</td>
                            <td>{{$event->location}}</td>
                            @if ($event->is_accepted)
                                <td><span class="badge rounded-pill bg-success">bestätigt</span></td>
                            @elseif($event->is_accepted === false)
                                <td><span class="badge rounded-pill bg-danger">abgelehnt</span></td>
                            @else
                                <td><span class="badge rounded-pill bg-primary">noch nicht bestätigt</span></td>
                            @endif
                            @if ($event->receiver_id == Auth::user()->id)
                                <td><button type="button" class="btn btn-default btn-sm" onclick="deleteItem(${curID})"><i class="fs-5 bi-x-circle text-danger"></i></button></td>
                                <td><button type="button" class="btn btn-default btn-sm" onclick="deleteItem(${curID})"><i class="fs-5 bi-check-circle text-success"></i></button></td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                Du hast zurzeit keine offenen Termine.
            </div>
        @endif
    </div>
</div>
@endsection
