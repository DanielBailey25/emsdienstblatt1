@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-5">
                <div class="card bg-light py-3 px-3">
                    <h1 class='fs-3 mb-3 text-white'>Wartungsarbeiten</h1>
                    <p>Hier gibt's noch nichts zu sehen...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
