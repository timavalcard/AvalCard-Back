<?php
namespace CMS\Course\Providers;

use CMS\Category\Models\Category;
use CMS\Course\Models\Course;
use CMS\Course\Models\Lesson;
use CMS\Course\Models\Season;
use CMS\Course\Policies\CoursePolicy;
use CMS\Course\Policies\LessonPolicy;
use CMS\Course\Policies\SeasonPolicy;
use CMS\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->loadRoutesFrom(__DIR__ . '/../Routes/courses_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/seasons_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/lessons_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Courses');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', "Courses");
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Season::class, SeasonPolicy::class);
        Gate::policy(Lesson::class, LessonPolicy::class);
    }

    public function boot()
    {
        /*Category::$post_type[]="course";
        $this->app->booted(function () {
            config()->set('AdminSidebar.courses', [
                "icon" => "fa-graduation-cap",
                "name" => "دوره ها",
                "link" => route('courses.index'),
                "children" => [
                    ["name" => "لیست دوره های ویدیویی", "link" => route('courses.index', ["type" => "video"])],
                    ["name" => "لیست دوره های کتابی", "link" => route('courses.index', ["type" => "book"])],
                    ["name" => "لیست دوره های صوتی", "link" => route('courses.index', ["type" => "podcast"])],
                    ["name" => "دسته بندی ها", "link" => route("admin_add_category", ['post_type' => 'course']), "permission" => Permission::PERMISSION_MANAGE_COURSES],
                ],
                "permission" => [
                    Permission::PERMISSION_MANAGE_COURSES,
                    Permission::PERMISSION_MANAGE_OWN_COURSES
                ]
            ]);
        });*/
    }
}

