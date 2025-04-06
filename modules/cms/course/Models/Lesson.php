<?php

namespace CMS\Course\Models;


use CMS\Course\Repositories\LessonRepo;
use CMS\Media\Models\Media;
use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Lesson extends Model
{
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];

    const STATUS_OPENED = 'opened';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED];


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'lesson_user', 'lesson_id', 'user_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    public function transaction()
    {
        return $this->morphMany(Transaction::class,"transactionable");
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function hasStudent($student_id)
    {
        return resolve(LessonRepo::class)->hasStudent($this, $student_id);
    }
    public function getConfirmationStatusCssClass()
    {
        if ($this->confirmation_status == self::CONFIRMATION_STATUS_ACCEPTED) return "text-success";
        elseif ($this->confirmation_status == self::CONFIRMATION_STATUS_REJECTED) return "text-error";
    }

    public function isFree()
    {

    }

    public function path()
    {
        return $this->course->path() . '?lesson=l-' . $this->id . "-" . $this->slug;
    }

    public function downloadLink()
    {

        if ($this->media_id)
        return URL::temporarySignedRoute('media.download', now()->addDay() , ['media' => $this->media_id,"course"=>$this->course_id,"lesson"=>$this->id]);
    }
    public function formattedDuration()
    {
        $duration = $this->time;
        $h = round($duration / 60) < 10 ? '0' . round($duration / 60) : round($duration / 60);
        $m = ($duration % 60) < 10 ? '0' . ($duration % 60) : ($duration % 60);
        return $h . ':' . $m . ":00";
    }
    public function getCourseMediaIdAttribute(){
        return $this->course->media_id;
    }
}
