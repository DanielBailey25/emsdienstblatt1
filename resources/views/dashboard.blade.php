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
            @if (($notification->isNotifiedUser() || $notification->isNotifiedUserRole()) || $notification->isPublic())
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
            @endif
        @endforeach
        <div class="row row-cols-auto">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <div class="card bg-light p-3">
                            Einheiten im Dienst: {{$maxWorkerCount}}
                        </div>
                    </div>
                    @if ($workerForUser)
                    <div class="col-md-2">
                        <a href="{{route('changeStatus')}}" class="text-decoration-none text-white">
                            <div class="card p-3 {{$workerForUser->state->id == 5 ? 'bg-danger' : 'bg-success'}}" style="cursor: pointer">
                                {{$workerForUser->state->name}}
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @foreach ($items as $item)
                <div class="col-12 col-lg-6 col-md-12 col-xl-6 col-xxl-4 mb-4">
                    <div class="card bg-light">
                        <div class="card-header @if($item->workers()->isEmpty()) bg-grey-light @elseif($item->type->id == 1) bg-primary @else bg-danger @endif text-white">{{ $item->name }}<form action={{route('formStartWorker')}} method="POST" id="currentWorkTileButton_{{$item->id}}">@csrf<input type='hidden' value=1 name='state_id'><input type='hidden' value={{$item->id}} name='item_id'><span onclick="getElementById('currentWorkTileButton_{{$item->id}}').submit();" class="lh-sm badge rounded-pill bg-dark makeClickable assignToCurrentWorkerButton" style="font-size: 12px">Eintragen</span></form></div>
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
                                        @foreach($currentWorker as $worker)
                                            @if ($worker->item_id == $item->id)
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
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
