@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Top 3 diesen Monat</h4>
                        <table class="table table-striped table-hover text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Stunden</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($month as $userId => $countInMinutes)
                                    <tr>
                                        @if ($loop->index == 0)
                                            <td><span style="font-size: 1.5rem;">🥇</span></td>
                                        @elseif ($loop->index == 1)
                                            <td><span style="font-size: 1.5rem;">🥈</span></td>
                                        @else
                                            <td><span style="font-size: 1.5rem;">🥉</span></td>
                                        @endif
                                        @if ($loop->index == 0)
                                            <td style="color: gold">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 1)
                                            <td style="color: silver">{{App\Models\User::find($userId)->name}}</td>
                                        @else
                                            <td style="color: #FF5733">{{App\Models\User::find($userId)->name}}</td>
                                        @endif
                                        <td>{{Carbon\CarbonInterval::minutes($countInMinutes)->cascade()->forHumans()}}</td>
                                    </tr>
                               @endforeach
                               @if (!array_key_exists(Auth::user()->id, $month))
                               <tr>
                                    <td><span style="font-size: 1.5rem;">-</span></td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td>{{Carbon\CarbonInterval::minutes($monthUser)->cascade()->forHumans()}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h4>Top 3 Lifetime</h4>
                        <table class="table table-striped table-hover text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Stunden</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lifetime as $userId => $countInMinutes)
                                    <tr>
                                        @if ($loop->index == 0)
                                            <td><span style="font-size: 1.5rem;">🥇</span></td>
                                        @elseif ($loop->index == 1)
                                            <td><span style="font-size: 1.5rem;">🥈</span></td>
                                        @else
                                            <td><span style="font-size: 1.5rem;">🥉</span></td>
                                        @endif
                                        @if ($loop->index == 0)
                                            <td style="color: gold">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 1)
                                            <td style="color: silver">{{App\Models\User::find($userId)->name}}</td>
                                        @else
                                            <td style="color: #FF5733">{{App\Models\User::find($userId)->name}}</td>
                                        @endif
                                        <td>{{Carbon\CarbonInterval::minutes($countInMinutes)->cascade()->forHumans()}}</td>
                                    </tr>
                               @endforeach
                               @if (!array_key_exists(Auth::user()->id, $lifetime))
                               <tr>
                                    <td><span style="font-size: 1.5rem;">-</span></td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td>{{Carbon\CarbonInterval::minutes($lifetimeUser)->cascade()->forHumans()}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h4>Top 3 diese Woche</h4>
                        <table class="table table-striped table-hover text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Stunden</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($week as $userId => $countInMinutes)
                                    <tr>
                                        @if ($loop->index == 0)
                                            <td><span style="font-size: 1.5rem;">🥇</span></td>
                                        @elseif ($loop->index == 1)
                                            <td><span style="font-size: 1.5rem;">🥈</span></td>
                                        @else
                                            <td><span style="font-size: 1.5rem;">🥉</span></td>
                                        @endif
                                        @if ($loop->index == 0)
                                            <td style="color: gold">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 1)
                                            <td style="color: silver">{{App\Models\User::find($userId)->name}}</td>
                                        @else
                                            <td style="color: #FF5733">{{App\Models\User::find($userId)->name}}</td>
                                        @endif
                                        <td>{{Carbon\CarbonInterval::minutes($countInMinutes)->cascade()->forHumans()}}</td>
                                    </tr>
                               @endforeach
                               @if (!array_key_exists(Auth::user()->id, $week))
                               <tr>
                                    <td><span style="font-size: 1.5rem;">-</span></td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td>{{Carbon\CarbonInterval::minutes($weekUser)->cascade()->forHumans()}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
