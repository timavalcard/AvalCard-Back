<?php
namespace CMS\Category\seeds;
use Illuminate\Database\Seeder;
use CMS\Category\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        factory(Category::class,20)->create();
    }
}
