<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\AbsenceType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function showCreateAbsenceView() {
        return view('create_absence');
    }

    public function showAbsences() {
        $absences = Absence::whereIn('absence_type_id', [1,2,3])->whereDate('to', '>=', Carbon::today()->toDateString())->get();

        return view('absences', ['absences' => $absences]);
    }

    public function createAbsence(Request $request) {
        $request->validate([
            'absence_type' => 'required',
            'start_date' => 'required | date | after:yesterday',
            'end_date' => 'required | date | after_or_equal:start_date',
        ],[], [
            'start_date' => 'Von Datum',
            'end_date' => 'Bis Datum',
        ]);

        $from = Carbon::parse($request->start_date . ' 00:01');
        $to = Carbon::parse($request->end_date . ' 23:59');

        Absence::create([
            'from' => $from->toDateTimeString(),
            'to' => $to->toDateTimeString(),
            'user_id' => Auth::user()->id,
            'absence_type_id' => (int) $request->input('absence_type'),
        ]);

        return redirect()->route('createAbsence')->with('message', 'Es wurde erfolgreich eine Abwesenheit erstellt / beantragt.');
    }
}
