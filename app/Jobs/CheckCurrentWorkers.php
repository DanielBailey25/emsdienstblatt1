<?php

namespace App\Jobs;

use App\Models\CurrentWorker;
use App\Models\IdleWarn;
use App\Models\Log;
use App\Models\Notification;
use App\Models\User;
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
        // Ignored warn for 30 minutes -> close current worker and mark warn as seen.
        $warns = IdleWarn::where(['seen' => false])->where('created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString())->get();
        foreach($warns as $warn) {
            $warn->seen = true;
            $warn->save();
            //Notify admins
            // Notification::create([
            //     'title' => 'Systembenachrichtigung',
            //     'content' => 'Der User ' . User::find($warn->warned_user_id)->name . ' wurde am ' . $warn->readableNow() . ' aufgrund von Inaktivität aus dem Dashboard geworfen.',
            //     'notified_role' => 'Admin'
            // ]);

            //Notify warned user;
            Notification::create([
                'title' => 'Systembenachrichtigung',
                'content' => 'Du wurdest am ' . $warn->readableNow() . ' aufgrund von Inaktivität automatisch aus dem Dashboard geworfen.',
                'notified_user_id' => $warn->warned_user_id,
            ]);
            Log::create([
                'related_user_id' => $warn->warned_user_id,
                'content' => 'Der User ' . User::find($warn->warned_user_id)->name . ' wurde am ' . $warn->readableNow() . ' aufgrund von Inaktivität aus dem Dashboard geworfen.',
            ]);

            $currentWorker = CurrentWorker::where(['user_id'=> $warn->warned_user_id, 'ended_at'=> null])->first();
            if ($currentWorker) {
                $currentWorker->stopWorker();
            }
        }
    }
}
