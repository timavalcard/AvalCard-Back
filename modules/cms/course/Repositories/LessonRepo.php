<?php

namespace CMS\Course\Repositories;

use CMS\Course\Models\Lesson;
use Illuminate\Support\Str;

class LessonRepo
{
    public function find($id){
        return Lesson::find($id);
    }
    public function store($courseId, $values)
    {
        return Lesson::create([
            "title" => $values->title,
            "slug" => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            "time" => $values->time,
            "priority" => $this->generateNumber($values->number, $courseId),
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'course_id' => $courseId,
            'user_id' => auth()->id(),
            'body' => $values->body,
            'price' => $values->price,
            'confirmation_status' => Lesson::CONFIRMATION_STATUS_PENDING,
            "status"=> Lesson::STATUS_OPENED,
            "free" => $values->is_free
        ]);
    }

    public function paginate($courseId)
    {
        return Lesson::where('course_id', $courseId)->orderBy('priority')->paginate();
    }

    public function findByid($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update($id, $courseId, $values)
    {
        return Lesson::where('id', $id)->update([
            "title" => $values->title,
            "slug" => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            "time" => $values->time,
            "priority" => $this->generateNumber($values->number, $courseId),
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'body' => $values->body,
            'price' => $values->price,
            "free" => $values->is_free
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        if (is_array($id)) {
            return Lesson::query()->whereIn('id', $id)->update(['confirmation_status' => $status]);
        }
        return Lesson::where('id', $id)->update(['confirmation_status'=> $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Lesson::where('id', $id)->update(['status'=> $status]);
    }

    public function generateNumber($number, $courseId): int
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findByid($courseId)->lessons()->orderBy('priority', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
        return $number;
    }

    public function acceptAll($courseId)
    {
        return Lesson::where("course_id", $courseId)->update(['confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED]);
    }

    public function getAcceptedLessons(int $courseId)
    {
        return Lesson::where('course_id', $courseId)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)
            ->get();
    }

    public function getFirstLesson(int $courseId)
    {
        return Lesson::where('course_id', $courseId)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)
            ->orderBy('priority', 'asc')->first();
    }

    public function getLesson(int $courseId, int $lessonId)
    {
        return Lesson::where('course_id', $courseId)->where('id', $lessonId)->first();
    }
    public function addStudentToLesson(Lesson $lesson, $studentId,$course)
    {
        if (!$this->getLessonStudentById($lesson, $studentId) && !resolve(CourseRepo::class)->getCourseStudentById($course,$studentId) ) {
            $lesson->students()->attach($studentId,[
                "user_id"=>$studentId,
                "course_id"=>$course->id,
            ]);
        }
    }
    public function hasStudent(Lesson $lesson, $student_id)
    {
        return $lesson->students->contains($student_id);
    }
    public function getLessonStudentById(Lesson $lesson, $studentId)
    {
        return $lesson->students()->where("user_id", $studentId)->first();
    }
}
