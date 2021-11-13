<?php

namespace App\Http\Controllers;

use App\Models\CurrentWorker;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index() {
        $userIdStats = CurrentWorker::get()->groupBy('user_id');
        $lifetime = [];
        foreach($userIdStats as $userId => $workers) {
            if (!User::find($userId)) {
                continue;
            }
            $countMinutes = 0;
            foreach ($workers as $worker) {
                $started = Carbon::parse($worker->started_at);
                $ended = ($worker->ended_at == null) ? Carbon::now() :  Carbon::parse($worker->ended_at);
                $countMinutes += $started->diffInMinutes($ended);
            }
            $lifetime[$userId] = $countMinutes;
            arsort($lifetime);
        }
        $lifetimeUser = isset($lifetime[Auth::user()->id]) ? $lifetime[Auth::user()->id] : 0;
        $lifetime = array_slice($lifetime, 0, 3, true);

        $userIdStats = CurrentWorker::whereBetween('started_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get()->groupBy('user_id');
        $month = [];
        foreach($userIdStats as $userId => $workers) {
            if (!User::find($userId)) {
                continue;
            }
            $countMinutes = 0;
            foreach ($workers as $worker) {
                $started =  Carbon::parse($worker->started_at);
                $ended = ($worker->ended_at == null) ? Carbon::now() :  Carbon::parse($worker->ended_at);
                $countMinutes += $started->diffInMinutes($ended);
            }
            $month[$userId] = $countMinutes;
            arsort($month);
        }
        $monthUser = isset($month[Auth::user()->id]) ? $month[Auth::user()->id] : 0;
        $month = array_slice($month, 0, 3, true);

        $userIdStats = CurrentWorker::whereBetween('started_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->groupBy('user_id');
        $week = [];
        foreach($userIdStats as $userId => $workers) {
            if (!User::find($userId)) {
                continue;
            }
            $countMinutes = 0;
            foreach ($workers as $worker) {
                $started =  Carbon::parse($worker->started_at);
                $ended = ($worker->ended_at == null) ? Carbon::now() :  Carbon::parse($worker->ended_at);
                $countMinutes += $started->diffInMinutes($ended);
            }
            $week[$userId] = $countMinutes;
            arsort($week);
        }
        $weekUser = isset($week[Auth::user()->id]) ? $week[Auth::user()->id] : 0;
        $week = array_slice($week, 0, 3, true);
        return view('leaderboard', [
            'lifetime' => $lifetime,
            'lifetimeUser' => $lifetimeUser,
            'month' => $month,
            'monthUser' => $monthUser,
            'week' => $week,
            'weekUser' => $weekUser,
        ]);
    }
}
