<?php

namespace CMS\Course\Listeners;

use CMS\Course\Models\Course;
use CMS\Course\Models\Lesson;
use CMS\Course\Repositories\CourseRepo;
use CMS\Course\Repositories\LessonRepo;

class RegisterUserInTheLesson
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        if ($event->transaction->transactionable_type == Lesson::class) {
            $course=resolve(LessonRepo::class)->find($event->transaction->transactionable)->course;
            resolve(LessonRepo::class)->addStudentToLesson($event->transaction->transactionable, $event->transaction->user_id,$course);
        }
    }
}
