<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->bigInteger('season_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->boolean('free')->default(false);
            $table->longText('body')->nullable();
            $table->tinyInteger("time")->unsigned()->nullable();
            $table->float("priority")->unsigned()->nullable();
            $table->enum('confirmation_status', \CMS\Course\Models\Lesson::$confirmationStatuses)
                ->default(\CMS\Course\Models\Lesson::CONFIRMATION_STATUS_PENDING);
            $table->enum('status', \CMS\Course\Models\Lesson::$statuses)
                ->default(\CMS\Course\Models\Lesson::STATUS_OPENED);
            $table->timestamps();


            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
