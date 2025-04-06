<?php

namespace CMS\Course\Models;

use CMS\Category\Models\Category;
use CMS\Comment\Models\Comment;
use CMS\Course\Repositories\CourseRepo;
use CMS\Media\Models\Media;
use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $table="course_user";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
