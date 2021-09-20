@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Mitarbeiterliste</h1>
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                    <th scope="col">Mitarbeiter</th>
                    <th scope="col">Rank</th>
                    <th scope="col">Einreise-ID</th>
                    <th scope="col">Tel.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                     <tr>
                        <th scope="row">{{$worker->name}}</th>
                        <td>{{$worker->rank}}</td>
                        <td>{{$worker->player_id}}</td>
                        <td>{{$worker->phone}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
