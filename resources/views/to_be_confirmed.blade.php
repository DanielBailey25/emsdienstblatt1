@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Ausstehende Bestätigungen</h1>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('info'))
            <div class="alert alert-primary">
                {{ session()->get('info') }}
            </div>
        @endif
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                    <th scope="col">Mitarbeiter</th>
                    <th scope="col">Neuer Name</th>
                    <th scope="col">Erstellt am</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($confirmations as $confirmation)
                     <tr>
                        <th scope="row">{{$confirmation->requestUser()->name}}</th>
                        <td>{{$confirmation->new_value}}</td>
                        <td>{{$confirmation->readableCreatedAt()}}</td>
                        <td><a href="{{route('acceptConfirmation', $confirmation->id)}}"><span class="badge bg-secondary bg-success">bestätigen</span></a></td>
                        <td><a href="{{route('declineConfirmation', $confirmation->id)}}"><span class="badge bg-secondary bg-danger">ablehnen</span></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
