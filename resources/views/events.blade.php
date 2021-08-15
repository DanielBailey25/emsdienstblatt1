@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Terminübersicht</h1>
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                    <th scope="col">Von</th>
                    <th scope="col">Datum / Uhrzeit</th>
                    <th scope="col">Ort</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th scope="row">{{$event->sender->name}}</th>
                        <td>{{$event->datetime}}</td>
                        <td>{{$event->location}}</td>
                        <td>{{$event->is_accepted}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
