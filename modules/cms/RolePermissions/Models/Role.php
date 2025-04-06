<?php


namespace CMS\RolePermissions\Models;


use phpDocumentor\Reflection\Types\Self_;

class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_SUPER_ADMIN = 'super admin';
    const ROLE_SHOP_MANAGER = 'shop manager';
    const ROLE_BLOG_MANAGER = 'blog manager';
    const ROLE_COMMENT_MANAGER = 'comment manager';
    const ROLE_PAGE_MANAGER = 'page manager';
    const ROLE_NEWSLETTER_MANAGER = 'newsletter manager';
    const ROLE_MENU_MANAGER = 'menu manager';
    const ROLE_USER = 'user';
    const ROLE_AFFILIATE = 'affiliate';
    const ROLE_AFFILIATE_NEED_AUTHORIZE = 'affiliate wait for confirm';
    const ROLE_SEO_MANAGER = 'seo manager';
    const ROLE_TEACHER = 'teacher';
    static $roles = [

        self::ROLE_SUPER_ADMIN => [
            Permission::PERMISSION_SUPER_ADMIN
        ],
        self::ROLE_BLOG_MANAGER =>[
            Permission::PERMISSION_MANAGE_Article,
            Permission::PERMISSION_MANAGE_TAG,
            Permission::PERMISSION_MANAGE_CATEGORY
        ],
        self::ROLE_SHOP_MANAGER =>[
            Permission::PERMISSION_MANAGE_SHOP,
            Permission::PERMISSION_MANAGE_CATEGORY,
            Permission::PERMISSION_MANAGE_ATTRIBUTE
        ],
        self::ROLE_COMMENT_MANAGER =>[
            Permission::PERMISSION_MANAGE_COMMENT
        ],
        self::ROLE_PAGE_MANAGER =>[
            Permission::PERMISSION_MANAGE_PAGE
        ],
        self::ROLE_NEWSLETTER_MANAGER =>[
            Permission::PERMISSION_MANAGE_NEWSLETTER
        ],
        self::ROLE_MENU_MANAGER =>[
            Permission::PERMISSION_MANAGE_MENU
        ],
        self::ROLE_USER =>[
            Permission::PERMISSION_USER
        ],
        self::ROLE_SEO_MANAGER=>[
            Permission::PERMISSION_SEO_MANAGER
        ],
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ],
        self::ROLE_AFFILIATE_NEED_AUTHORIZE=>[
            Permission::PERMISSION_USER
        ]
    ];
}
