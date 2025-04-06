<?php
namespace CMS\Menu\Database\seeds;
use Illuminate\Database\Seeder;
use CMS\Menu\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Menu::class,10)->create();
    }
}
