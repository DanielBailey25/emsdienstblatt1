<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'client_id',
        'rank',
        'player_id',
        'phone',
        'created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getLatestCurrentWorker() {
        return CurrentWorker::where('user_id', $this->id)->orderBy('created_at', 'asc')->first();
    }

    public function hasCourseById($courseId) {
        return CourseRelation::where(['user_id' => $this->id, 'course_id' => $courseId])->first();
    }

    public function readableCreatedAt() {
        if ($this->created_at != null) {
            return Carbon::parse($this->created_at)->isoFormat('DD.MM.YYYY');
        }
        return 'OG';
    }
}
