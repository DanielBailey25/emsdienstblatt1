@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-5">
                <div class="card bg-light py-3 px-3">
                    <h1 class='fs-3 mb-3 text-danger'>Du bist seit über 3 Stunden Inaktiv</h1>
                    <p>Du wirst in 30 Minuten nach Versand dieser Nachricht automatisch ausgetragen, wenn du diese Meldung nicht bestätigst.</p>
                    <a href="{{route('seenIdleWarn')}}" type="submit" class="btn btn-primary text-white col-md-2">Bestätigen</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
