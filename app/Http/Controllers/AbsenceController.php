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
            'start_date' => 'required | date',
            'end_date' => 'required | date | after_or_equal:start_date',
            'time_added' => 'nullable',
            'start_time' => 'nullable | date_format:"H:i"',
            'end_time' => 'nullable | date_format:"H:i"| after:start_time',
        ],[], [
            'start_date' => 'Von Datum',
            'end_date' => 'Bis Datum',
            'start_time' => 'Ab Uhrzeit',
            'end_time' => 'Bis Uhrzeit',
        ]);

        if ($request->start_time == null || $request->start_time == null) {
            $request->start_time = '00:00';
        }
        if ($request->end_time == null || $request->time_added == null) {
            $request->end_time = '23:59';
        }
        $from = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $to = Carbon::parse($request->end_date . ' ' . $request->end_time);

        Absence::create([
            'from' => $from->toDateTimeString(),
            'to' => $to->toDateTimeString(),
            'time_included' => ($request->input('time_added')) ? true : false,
            'user_id' => Auth::user()->id,
            'absence_type_id' => (int) $request->input('absence_type'),
        ]);

        return redirect('/create/absence')->with('message', 'Es wurde erfolgreich eine Abwesenheit erstellt / beantragt.');
    }
}
