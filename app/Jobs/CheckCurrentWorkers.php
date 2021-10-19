<?php

namespace App\Jobs;

use App\Models\CurrentWorker;
use App\Models\IdleWarn;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckCurrentWorkers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userIds = CurrentWorker::where('ended_at', null)->where('started_at', '<=', Carbon::now()->subHours(3)->toDateTimeString())->pluck('user_id');
        foreach ($userIds as $id) {
            $currentWarn = IdleWarn::where(['warned_user_id' => $id, 'seen' => false])->first();
            if (!$currentWarn) {
                IdleWarn::create([
                    'warned_user_id' => $id,
                ]);
            }
        }
        $warns = IdleWarn::where(['seen' => false])->where('created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString())->get();
        foreach($warns as $warn) {
            $warn->seen = true;
            $warn->save();
            $currentWorker = CurrentWorker::where(['user_id'=> $warn->warned_user_id, 'ended_at'=> null])->first();
            if ($currentWorker) {
                $currentWorker->stopWorker();
            }
        }
    }
}
