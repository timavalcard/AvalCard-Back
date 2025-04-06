<?php


namespace CMS\RolePermissions\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_SHOP = 'shop manager';
    const PERMISSION_MANAGE_Article = 'blog manager';
    const PERMISSION_MANAGE_USERS = 'manage users';
    const PERMISSION_SUPER_ADMIN = 'super admin';
    const PERMISSION_MANAGE_COMMENT = 'comment manager';
    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage role_permissions';
    const PERMISSION_MANAGE_PAGE = 'page manager';
    const PERMISSION_MANAGE_CONTACT = 'contact manager';
    const PERMISSION_MANAGE_NEWSLETTER = 'newsletter manager';
    const PERMISSION_MANAGE_MENU = 'menu manager';
    const PERMISSION_MANAGE_TAG = 'tag manager';
    const PERMISSION_MANAGE_CATEGORY = 'category manager';
    const PERMISSION_MANAGE_ATTRIBUTE = 'attribute manager';
    const PERMISSION_USER = 'user';
    const PERMISSION_AFFILIATE = 'affiliate';
    const PERMISSION_SHOW_MANAGER = 'show manager';
    const PERMISSION_SEO_MANAGER = 'seo manager';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_MANAGE_COURSES = 'manage courses';
    const PERMISSION_MANAGE_OWN_COURSES = 'manage own courses';
    static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_SHOP,
        self::PERMISSION_MANAGE_Article,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_COMMENT,
        self::PERMISSION_MANAGE_PAGE,
        self::PERMISSION_MANAGE_NEWSLETTER,
        self::PERMISSION_MANAGE_MENU,
        self::PERMISSION_MANAGE_TAG,
        self::PERMISSION_MANAGE_CATEGORY,
        self::PERMISSION_MANAGE_ATTRIBUTE,
        self::PERMISSION_USER,
        self::PERMISSION_AFFILIATE,
        self::PERMISSION_SHOW_MANAGER,
        self::PERMISSION_SEO_MANAGER,
        self::PERMISSION_MANAGE_CONTACT,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES,
        self::PERMISSION_TEACH,
    ];

    static $admin_permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_SHOP,
        self::PERMISSION_MANAGE_Article,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_COMMENT,
        self::PERMISSION_MANAGE_PAGE,
        self::PERMISSION_MANAGE_NEWSLETTER,
        self::PERMISSION_MANAGE_MENU,
        self::PERMISSION_MANAGE_TAG,
        self::PERMISSION_MANAGE_CATEGORY,
        self::PERMISSION_MANAGE_ATTRIBUTE,
        self::PERMISSION_SHOW_MANAGER,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES,
    ];



}
