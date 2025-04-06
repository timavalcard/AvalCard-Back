<?php
namespace API\Page\Repositories;

use CMS\Page\Models\Page;


class APIPageRepository
{

    public static function find_by_slug_not_fail($slug)
    {
        return Page::query()->where("slug",$slug)->first();
    }

}
