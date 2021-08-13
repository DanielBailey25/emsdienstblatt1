@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class="row row-cols-auto">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('RTW 06') }}</div>
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
                                    <tr>
                                        <th>01</th>
                                        <td>38</td>
                                        <td>Michael_Geissler</td>
                                        <td></td>
                                        <td>Außendienst</td>
                                        <td>21:23</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('RTW 21') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
