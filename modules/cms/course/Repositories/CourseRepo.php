<?php

namespace CMS\Course\Repositories;


use CMS\Category\Models\Category;
use CMS\Course\Models\Course;
use CMS\Course\Models\Lesson;
use Illuminate\Support\Str;
use CMS\Product\Models\Product;

class CourseRepo
{
    public function store($values)
    {
        return Course::create([
            'teacher_id' => $values->teacher_id,
            'media_id' => $values->media_id,
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'course_type' => $values->course_type,
            'confirmation_status' => Course::CONFIRMATION_STATUS_PENDING,
        ]);
    }
    public function add_category($course,$catId){
        $cat= Category::find($catId);
        if(is_object($cat)){
            $cat->courses()->save($course);

        }
    }

    public function paginate($type)
    {
        return Course::query()->where("course_type",$type)->paginate();
    }
    public static function like($name=null,$limit=10)
    {
        $courses=collect();
        if($name){
            $courses=Course::query()->where("title","LIKE","%".$name."%")->limit($limit)->get();
        }


        return $courses;
    }
    public static function get_by_limit($type)
    {
        return Course::query()->where("course_type",$type)->limit(10)->get();
    }
    public static function get_by_limit_not_type()
    {
        return Course::query()->limit(10)->get();
    }
    public function findByid($id)
    {
        return Course::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Course::where('id', $id)->update([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'media_id' => $values->media_id,
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['status' => $status]);
    }

    public function getCoursesByTeacherId(?int $id,$type)
    {
        return Course::where('teacher_id', $id)->where("course_type",$type)->get();
    }

    public function latestCourses()
    {
        return Course::where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)->latest()->take(8)->get();
    }

    public function getDuration($id)
    {
        return $this->getLessonsQuery($id)->sum('time');
    }

    public function getLessons($id)
    {
        return $this->getLessonsQuery($id)->get();
    }

    public function getLessonsCount($id)
    {
        return $this->getLessonsQuery($id)->count();
    }

    public function addStudentToCourse(Course $course, $studentId)
    {
        if (!$this->getCourseStudentById($course, $studentId)) {
            $course->students()->attach($studentId);
        }
    }

    public function getCourseStudentById(Course $course, $studentId)
    {
        return $course->students()->where("user_id", $studentId)->first();
    }

    public function hasStudent(Course $course, $student_id)
    {
        return $course->students->contains($student_id);
    }

    private function getLessonsQuery($id)
    {
        return Lesson::where('course_id', $id)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED);
    }

    public function getAll(string $status = null)
    {
        $query = Course::query();
        if ($status) $query->where("confirmation_status", $status);

        return $query
            ->latest()
            ->get();
    }

    public static function find_by_slug($slug){
        //return Course::query()->where("confirmation_status",Course::CONFIRMATION_STATUS_ACCEPTED)->where("slug",$slug)->firstOrFail();
        return Course::query()->where("slug",$slug)->firstOrFail();
    }
    public static function find($id){
    //return Course::query()->where("confirmation_status",Course::CONFIRMATION_STATUS_ACCEPTED)->where("id",$id)->first();
    return Course::query()->where("id",$id)->first();
    }

    public static function get_course_demo_lesson($course){
        return $course->lessons()->where("free",true)->where("confirmation_status",Lesson::CONFIRMATION_STATUS_ACCEPTED)->whereHas("media",function ($query){
            $query->where("type","zip");
        })->first();
    }
    public static function get_multiple_course_prices($course_id,$type="course")
    {
        if($type=="course"){
            return Course::find($course_id);

        } elseif($type=="lesson"){
            return Lesson::find($course_id);
          }
        elseif($type=="product"){
            return Product::find($course_id);
        }
    }
    public static function add_courses_and_lessons_to_user($cart,$studentId){
        if($cart){
            foreach ($cart as $type=>$items) {
                foreach ($items as $item){
                    if($type == "course"){
                        $course=CourseRepo::find($item["id"]);
                        if($course){
                            resolve(CourseRepo::class)->addStudentToCourse($course, $studentId);
                        }
                    } elseif ($type == "lesson"){
                        $lesson=resolve(LessonRepo::class)->find($item["id"]);
                        if($lesson){
                            $course=$lesson->course;
                            resolve(LessonRepo::class)->addStudentToLesson($lesson, $studentId,$course);
                        }

                    }
                }
            }
        }


    }

}
