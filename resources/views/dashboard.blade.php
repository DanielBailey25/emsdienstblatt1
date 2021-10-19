@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="py-4 col d-flex flex-column h-sm-100">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @foreach ($notifications as $notification)
            <div class="modal-content mb-3 bg-light">
                <div class="modal-header">
                    @if ($notification->isNews)
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Neue News: {{$notification->title}}<span class="badge badge-secondary text-danger">{{$notification->readableCreatedAt()}}</span></h5>
                    @elseif ($notification->title)
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">{{$notification->title}}<span class="badge badge-secondary text-danger">{{$notification->readableCreatedAt()}}</span></h5>
                    @else
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Nachricht von {{$notification->creator()->name}}<span class="badge badge-secondary text-danger">{{$notification->readableCreatedAt()}}</span></h5>
                    @endif
                </div>
                <div class="modal-body">
                  <p>
                    {!!nl2br(e($notification->content))!!}
                  </p>
                </div>
                <div class="modal-footer">
                  <a href="{{route('notificationRead', $notification->id)}}" type="button" class="btn btn-primary text-white">Als gelesen markieren</a>
                </div>
            </div>
        @endforeach
        <div class="row row-cols-auto">
            @if($currentWorker->count() == 0)
                <div class="col-md py-4">
                    <div class="alert alert-primary" role="alert">
                        Es ist zurzeit keine Einheit im Dienst.
                    </div>
                </div>
            @else
            <div class="col-12 mb-3">
                <div class="col-md-2">
                    <div class="card bg-light p-3">
                        Einheiten im Dienst: {{$maxWorkerCount}}
                    </div>
                </div>
            </div>
                @foreach($currentWorker as $worker)
                    <div class="col-12 col-lg-6 col-md-12 col-xl-6 col-xxl-4 mb-4">
                        <div class="card bg-light">
                            <div class="card-header @if($worker->item->type->id == 1) bg-primary @else bg-danger @endif text-white">{{ $worker->item->name }}<form action={{route('formStartWorker')}} method="POST" id="currentWorkTileButton_{{$worker->id}}">@csrf<input type='hidden' value=1 name='state_id'><input type='hidden' value={{$worker->item_id}} name='item_id'><span onclick="getElementById('currentWorkTileButton_{{$worker->id}}').submit();" class="lh-sm badge rounded-pill bg-dark makeClickable assignToCurrentWorkerButton" style="font-size: 12px">Eintragen</span></form></div>
                            <div class="card-body-md">
                                <div class='table-responsive'>
                                    <table class="table text-white table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">R</th>
                                                <th scope="col">E-ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Beginn</th>
                                                @hasrole ('Admin')
                                                <th scope="col"></th>
                                                @endhasrole
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($worker->state->id == 5)
                                              <tr class="table-danger">
                                            @else
                                              <tr>
                                            @endif
                                                <th>{{ $worker->user->rank }}</th>
                                                <td>{{ $worker->user->player_id }}</td>
                                                <td>{{ $worker->user->name }}</td>
                                                <td>{{ $worker->state->name }}</td>
                                                <td>{{ $worker->readableStartedAtDiff() }}</td>
                                                @hasrole ('Admin')
                                                <td><a href="{{route('stopWorkerById', $worker->id)}}"><span class="badge bg-secondary bg-danger">austragen</span></a></td>
                                                @endhasrole
                                            </tr>
                                            @foreach ($worker->related() as $subWorker)
                                            @if ($subWorker->state->id == 5)
                                                <tr class="table-danger">
                                            @else
                                                <tr>
                                            @endif
                                                <th>{{ $subWorker->user->rank }}</th>
                                                <td>{{ $subWorker->user->player_id }}</td>
                                                <td>{{ $subWorker->user->name }}</td>
                                                <td>{{ $subWorker->state->name }}</td>
                                                <td>{{ $subWorker->readableStartedAtDiff() }}</td>
                                                @hasrole ('Admin')
                                                <td><a href="{{route('stopWorkerById', $subWorker->id)}}"><span class="badge bg-secondary bg-danger">austragen</span></a></td>
                                                @endhasrole
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
