@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="py-4 col d-flex flex-column h-sm-100">

        @include('components.infobar')

        <div class="row row-cols-auto py-4">
            @if($currentWorker->count() == 0)
                <div class="col-md">
                    <div class="alert alert-primary" role="alert">
                        Es ist zurzeit keine Einheit im Dienst.
                    </div>
                </div>
            @else
                @foreach($currentWorker as $worker)
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header bg-primary text-white">{{ $worker->item->name }}</div>
                            <div class="card-body-md">
                                <div class='table-responsive'>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">R</th>
                                                <th scope="col">DN</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Beginn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($worker->user->rank == 0)
                                              <tr class="table-danger">
                                            @else
                                              <tr>
                                            @endif
                                                <th>{{ $worker->user->rank }}</th>
                                                <td>{{ $worker->user->service_number }}</td>
                                                <td>{{ $worker->user->name }}</td>
                                                <td>{{ $worker->name }}</td>
                                                <td>{{ $worker->state->name }}</td>
                                                <td>{{ $worker->readableStartedAt() }}</td>
                                            </tr>
                                            @foreach ($worker->related() as $subWorker)
                                            @if ($subWorker->user->rank == 0)
                                                <tr class="table-danger">
                                            @else
                                                <tr>
                                            @endif
                                                <th>{{ $subWorker->user->rank }}</th>
                                                <td>{{ $subWorker->user->service_number }}</td>
                                                <td>{{ $subWorker->user->name }}</td>
                                                <td>{{ $subWorker->name }}</td>
                                                <td>{{ $subWorker->state->name }}</td>
                                                <td>{{ $subWorker->readableStartedAt() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
