@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class="row align-items-center h-100">
            <div class="col-md-5 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card bg-light py-3 px-3">
                    <h1 class='fs-3'>Verwarnung erteilen</h1>
                    <form method="POST" action="{{route('createWarn')}}">
                        @csrf
                        <div class="mb-3">
                          <label for="selectStartDate" class="form-label">Mitarbeiter</label>
                          <input type="text" disabled class="form-control" value="{{$warnedUser->name}}">
                          <input type="hidden" class="form-control" name="warned_user" value="{{$warnedUser->id}}">
                        </div>
                        <div class="mb-3">
                          <label for="selectEndDate" class="form-label">Nachricht</label>
                          <textarea required value="{{old('content')}}" class="form-control bg-light" name="content" id="content" rows="3" maxlength="500"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary text-white">Erteilen</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
