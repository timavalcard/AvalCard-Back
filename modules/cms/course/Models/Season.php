<?php

namespace CMS\Course\Models;

use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];

    const STATUS_OPENED = 'opened';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED];


    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function transaction()
    {
        return $this->morphMany(Transaction::class,"transactionable");
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'season_user', 'season_id', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
