<?php

namespace CMS\Course\Models;

use CMS\Category\Models\Category;
use CMS\Comment\Models\Comment;
use CMS\Course\Repositories\CourseRepo;
use CMS\Media\Models\Media;
use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $guarded = [];
    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];

    public function banner()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class,"commentable","comment_able_type","comment_able_id");
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function transaction()
    {
        return $this->morphMany(Transaction::class,"transactionable");
    }

    public function payment()
    {
        return $this->payments()->latest()->first();
    }



    public function getDuration()
    {
        return (new CourseRepo())->getDuration($this->id);
    }

    public function hasStudent($student_id)
    {
        return resolve(CourseRepo::class)->hasStudent($this, $student_id);
    }

    public function formattedDuration()
    {
        $duration = $this->getDuration();
        $h = round($duration / 60) < 10 ? '0' . round($duration / 60) : round($duration / 60);
        $m = ($duration % 60) < 10 ? '0' . ($duration % 60) : ($duration % 60);
        return $h . ':' . $m . ":00";
    }

    public function getFormattedPrice()
    {
        return number_format($this->price);
    }




    public function getFinalPriceAttribute($code = null, $withDiscounts = false)
    {
        return $this->price;
    }



    public function getUrlAttribute()
    {
        return route('singleCourse', $this->slug);
    }

    public function lessonsCount()
    {
        return (new CourseRepo())->getLessonsCount($this->id);
    }

    public function shortUrl()
    {
        return route('singleCourse', $this->id);
    }

    public function downloadLinks(): array
    {
        $links = [];
        foreach (resolve(CourseRepo::class)->getLessons($this->id) as $lesson) {
            $links[] = $lesson->downloadLink();
        }

        return $links;
    }
    public function getPostExcerptAttribute(){
        return strlen($this->body) > 251 ? substr($this->body,0,251)."..." : $this->body;
    }
}
