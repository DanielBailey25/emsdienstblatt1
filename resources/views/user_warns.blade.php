@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Verwarnungen</h1>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                    <th scope="col">Mitarbeiter</th>
                    <th scope="col">Nachricht</th>
                    <th scope="col">Ausgestellt von</th>
                    <th scope="col">Erstellt am</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warns as $warn)
                     <tr>
                        <th scope="row">{{$warn->warnedUser->name}}</th>
                        <td>{{$warn->content}}</td>
                        <td>{{$warn->creator()->name}}</td>
                        <td>{{$warn->created_at}}</td>
                        <td><a href="{{route('deleteWarn', $warn->id)}}"><span class="badge bg-secondary bg-danger">löschen</span></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
