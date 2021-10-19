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
        $userIdStats = CurrentWorker::whereNotNull('ended_at')->get()->groupBy('user_id');
        $lifetime = [];
        foreach($userIdStats as $userId => $workers) {
            if (!User::find($userId)) {
                continue;
            }
            $countMinutes = 0;
            foreach ($workers as $worker) {
                $started =  Carbon::parse($worker->started_at);
                $ended =  Carbon::parse($worker->ended_at);
                $countMinutes += $started->diffInMinutes($ended);
            }
            $lifetime[$userId] = $countMinutes;
            arsort($lifetime);
        }
        $lifetimeUser = $lifetime[Auth::user()->id];
        $lifetime = array_slice($lifetime, 0, 3, true);

        $userIdStats = CurrentWorker::whereNotNull('ended_at')->where('ended_at', '>=', Carbon::now()->subMonth(1)->toDateTimeString())->get()->groupBy('user_id');
        $month = [];
        foreach($userIdStats as $userId => $workers) {
            if (!User::find($userId)) {
                continue;
            }
            $countMinutes = 0;
            foreach ($workers as $worker) {
                $started =  Carbon::parse($worker->started_at);
                $ended =  Carbon::parse($worker->ended_at);
                $countMinutes += $started->diffInMinutes($ended);
            }
            $month[$userId] = $countMinutes;
            arsort($month);
        }
        $monthUser = $month[Auth::user()->id];
        $month = array_slice($month, 0, 3, true);

        $userIdStats = CurrentWorker::whereNotNull('ended_at')->where('ended_at', '>=', Carbon::now()->subWeek(1)->toDateTimeString())->get()->groupBy('user_id');
        $week = [];
        foreach($userIdStats as $userId => $workers) {
            if (!User::find($userId)) {
                continue;
            }
            $countMinutes = 0;
            foreach ($workers as $worker) {
                $started =  Carbon::parse($worker->started_at);
                $ended =  Carbon::parse($worker->ended_at);
                $countMinutes += $started->diffInMinutes($ended);
            }
            $week[$userId] = $countMinutes;
            arsort($week);
        }
        $weekUser = $week[Auth::user()->id];
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
