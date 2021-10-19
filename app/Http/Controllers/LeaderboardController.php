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
        array_slice($lifetime, 0, 3);
        return view('leaderboard', [
            'lifetime' => $lifetime,
            'lifetimeUser' => $lifetimeUser,
        ]);
    }
}
