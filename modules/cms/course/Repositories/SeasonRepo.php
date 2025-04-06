<?php

namespace CMS\Course\Repositories;


use CMS\Course\Models\Lesson;
use CMS\Course\Models\Season;

class SeasonRepo
{
    public function getCourseSeasons($course)
    {
        return Season::where('course_id', $course)
            ->where('confirmation_status', Season::CONFIRMATION_STATUS_ACCEPTED)
            ->orderBy('number')->get();
    }

    public function findByIdandCourseId($seasonId, $courseId)
    {
        return Season::where('course_id', $courseId)->where('id', $seasonId)->first();
    }
    public function store($id, $values)
    {
        return Season::create([
            'course_id' => $id,
            'user_id' => auth()->id(),
            'title' => $values->title,
            'number' => $this->generateNumber($values->number, $id),
            'confirmation_status' => Season::CONFIRMATION_STATUS_PENDING,
            'status' => Season::STATUS_OPENED
        ]);
    }

    public function findByid($id)
    {
        return Season::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Season::where('id', $id)->update([
            'title' => $values->title,
            'number' => $this->generateNumber($values->number, $id),
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Season::where('id', $id)->update(['confirmation_status'=> $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Season::where('id', $id)->update(['status'=> $status]);
    }

    public function generateNumber($number, $courseId): int
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findByid($courseId)->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
        return $number;
    }

    public static function accepted_seasons_with_accepted_lessons($course){
        return $course->seasons()->where('confirmation_status', Season::CONFIRMATION_STATUS_ACCEPTED)->with(["lessons"=>function($query){
            $query->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED);
        }])->orderBy("number")->get();
    }
}
