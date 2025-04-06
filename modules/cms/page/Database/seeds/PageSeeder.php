<?php
namespace CMS\Page\Database\seeds;
use Illuminate\Database\Seeder;
use CMS\Page\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::truncate();
        factory(Page::class,20)->create();
    }
}
