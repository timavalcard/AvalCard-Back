<?php
namespace CMS\Comment\seeds;

use Illuminate\Database\Seeder;
use CMS\Comment\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();
        factory(Comment::class,20)->create();
    }
}
