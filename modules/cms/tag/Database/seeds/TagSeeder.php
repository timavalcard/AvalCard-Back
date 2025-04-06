<?php
namespace CMS\Tag\seeds;
use Illuminate\Database\Seeder;
use CMS\Tag\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        factory(Tag::class,20)->create();
    }
}
