@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Hausverbote</h1>
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Von</th>
                    <th scope="col">Bis</th>
                    <th scope="col">ausgestellt von</th>
                    <th scope="col">Grund</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bans as $ban)
                     <tr>
                        <th scope="row">{{$ban->name}}</th>
                        <td>{{$ban->from}}</td>
                        <td>{{$ban->to}}</td>
                        <td>{{$ban->created_by_id}}</td>
                        <td>{{$ban->reason}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
