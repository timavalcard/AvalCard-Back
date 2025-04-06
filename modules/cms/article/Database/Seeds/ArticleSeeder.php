<?php
namespace CMS\Article\Database\Seeds;

use Illuminate\Database\Seeder;
use CMS\Article\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();
        factory(Article::class,20)->create();
    }
}
