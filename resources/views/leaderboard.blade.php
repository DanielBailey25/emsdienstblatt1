@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-5">
                <input type="text" class="form-control" id="searchByName" onkeyup="filterTable()" placeholder="Nach einem Namen suchen...">
                <div class="row mt-4">
                    <div class="col-md-4">
                        <h4>Top 3 diesen Monat</h4>
                        <table class="table table-striped table-hover text-white" id="leaderBoardTableMonth">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Dienstzeit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($month as $userId => $countInMinutes)
                                    <tr>
                                        @if ($loop->index == 0)
                                            <td><span style="font-size: 1.5rem;">🥇</span></td>
                                        @elseif ($loop->index == 1)
                                            <td><span style="font-size: 1.5rem;">🥈</span></td>
                                        @elseif ($loop->index == 2)
                                            <td><span style="font-size: 1.5rem;">🥉</span></td>
                                        @else
                                            <td class="text-center align-middle"><span style="font-size: 1.1rem;">{{$loop->index+1}}</span></td>
                                        @endif
                                        @if ($loop->index == 0)
                                            <td style="color: gold">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 1)
                                            <td style="color: silver">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 2)
                                            <td style="color: #FF5733">{{App\Models\User::find($userId)->name}}</td>
                                        @else
                                            <td>{{App\Models\User::find($userId)->name}}</td>
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
                        <table class="table table-striped table-hover text-white" id="leaderBoardTableLifetime">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Dienstzeit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lifetime as $userId => $countInMinutes)
                                    <tr>
                                        @if ($loop->index == 0)
                                            <td><span style="font-size: 1.5rem;">🥇</span></td>
                                        @elseif ($loop->index == 1)
                                            <td><span style="font-size: 1.5rem;">🥈</span></td>
                                        @elseif ($loop->index == 2)
                                            <td><span style="font-size: 1.5rem;">🥉</span></td>
                                        @else
                                            <td class="text-center align-middle"><span style="font-size: 1.1rem;">{{$loop->index+1}}</span></td>
                                        @endif
                                        @if ($loop->index == 0)
                                            <td style="color: gold">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 1)
                                            <td style="color: silver">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 2)
                                            <td style="color: #FF5733">{{App\Models\User::find($userId)->name}}</td>
                                        @else
                                            <td>{{App\Models\User::find($userId)->name}}</td>
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
                        <table class="table table-striped table-hover text-white" id="leaderBoardTableWeekly">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Dienstzeit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($week as $userId => $countInMinutes)
                                    <tr>
                                        @if ($loop->index == 0)
                                            <td><span style="font-size: 1.5rem;">🥇</span></td>
                                        @elseif ($loop->index == 1)
                                            <td><span style="font-size: 1.5rem;">🥈</span></td>
                                        @elseif ($loop->index == 2)
                                            <td><span style="font-size: 1.5rem;">🥉</span></td>
                                        @else
                                            <td class="text-center align-middle"><span style="font-size: 1.1rem;">{{$loop->index+1}}</span></td>
                                        @endif
                                        @if ($loop->index == 0)
                                            <td style="color: gold">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 1)
                                            <td style="color: silver">{{App\Models\User::find($userId)->name}}</td>
                                        @elseif ($loop->index == 2)
                                            <td style="color: #FF5733">{{App\Models\User::find($userId)->name}}</td>
                                        @else
                                            <td>{{App\Models\User::find($userId)->name}}</td>
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

<script>
    function filterTable() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchByName");
      filter = input.value.toUpperCase();
      table = document.getElementById("leaderBoardTableMonth");
      tr = table.getElementsByTagName("tr");
      table = document.getElementById("leaderBoardTableLifetime");
      trLifetime = table.getElementsByTagName("tr");
      table = document.getElementById("leaderBoardTableWeekly");
      trWeekly = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
      for (i = 0; i < trLifetime.length; i++) {
        td = trLifetime[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            trLifetime[i].style.display = "";
          } else {
            trLifetime[i].style.display = "none";
          }
        }
      }
      for (i = 0; i < trWeekly.length; i++) {
        td = trWeekly[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            trWeekly[i].style.display = "";
          } else {
            trWeekly[i].style.display = "none";
          }
        }
      }
    }
    </script>

@endsection