<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use CMS\Article\Database\Seeds\ArticleSeeder;
use CMS\Category\seeds\CategorySeeder;
use CMS\Comment\seeds\CommentSeeder;
use CMS\Menu\Database\seeds\MenuSeeder;
use CMS\Page\Database\seeds\PageSeeder;
use CMS\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use CMS\Tag\seeds\TagSeeder;
use CMS\User\Database\seeds\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PageSeeder::class);
       // $this->call(CommentSeeder::class);
        $this->call(MenuSeeder::class);
       Schema::enableForeignKeyConstraints();
    }
}
