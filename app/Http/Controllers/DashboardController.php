<?php

namespace App\Http\Controllers;

use App\Models\AssignedControlCenter;
use App\Models\CurrentWorker;
use App\Models\IdleWarn;
use App\Models\Item;
use App\Models\Notification;
use App\Models\NotificationRead;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($this->checkIfIdleWarnExists()) {
            return redirect()->route('idleWarnIndex');
        }

        $currentWorker = $this->getActiveWorker();
        $maxWorkerCount = $this->getCountActiveWorkers();
        $notifications = $this->notificationForUser();
        $workerForUser = $this->getActiveWorkerForCurrentUser();

        return view('dashboard', [
            'currentWorker' => $currentWorker,
            'maxWorkerCount' => $maxWorkerCount,
            'notifications' => $notifications,
            'workerForUser' => $workerForUser,
            'items' => Item::all(),
        ]);
    }

    public function checkIfIdleWarnExists() {
        $user = Auth::user();
        $warn = IdleWarn::where([
            'warned_user_id' => $user->id,
            'seen' => false,
        ])->first();
        $currentWorker = CurrentWorker::where(['user_id' => $user->id, 'ended_at' => null])->where('started_at', '<=', Carbon::now()->subHours(3)->toDateTimeString())->first();
        if($warn && $currentWorker) {
            return true;
        }
        if($warn) {
            $warn->seen = true;
            $warn->save();
        }
        return false;
    }

    public function notificationForUser() {
        $notificationsRead = NotificationRead::where('read_by_user_id', Auth::user()->id)->pluck('notification_id');
        $notifications = Notification::whereDate('created_at', '>=', Auth::user()->created_at ?? '1970-01-01')->whereNotIn('id', $notificationsRead)->get();
        return $notifications;
    }

    public function markNotificationAsRead($id) {
        $notification = Notification::find($id);
        if ($notification) {
            NotificationRead::create([
                'notification_id' => $notification->id,
                'read_by_user_id' => Auth::user()->id,
            ]);
        }
        return redirect()->route('home')->with('message', 'Die Benachrichtigung wurde als gelesen markiert.');
    }

    public function getActiveWorker() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id])->orderBy('item_id')->get();
    }

    public function getActiveWorkerForCurrentUser() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id, 'user_id' => Auth::user()->id])->first();
    }

    public function getCountActiveWorkers() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id, ])->count();
    }

    public function getItemsByType($typeId) {
        return Item::where(['client_id' => Auth::user()->client_id, 'item_type_id' => $typeId])->get();
    }

    public function getControlCentersByClientId() {
        return AssignedControlCenter::where('client_id', Auth::user()->client_id)->get();
    }

    public function switchItemClosedState(Request $request) {
        $itemId = $request->input('item_id');
        $isClosed = $request->input('is_closed');

        $item = Item::where('id', $itemId)->first();
        $item->is_closed = !$isClosed;
        $item->save();

        return redirect()->route('home');
    }

    public function centerChangeAssignment(Request $request) {
        $centerId = $request->input('center_id');

        $center = AssignedControlCenter::where('id', $centerId)->first();

        // Check if center is allready assigned to the curren user
        if ($center->user_id == Auth::user()->id) {
            // If thats the case, unassign the user from the center
            $center->user_id = null;
        } else {
            $center->user_id = Auth::user()->id;
        }
        $center->save();

        return redirect()->route('home');
    }
}
