<?php

namespace CMS\Ticket\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Ticket\Models\Ticket;
use CMS\Ticket\policies\TicketPolicy;
use CMS\RolePermissions\Models\Permission;

class TicketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/ticket_route.php");
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Ticket");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
       // $this->loadFactoriesFrom(__DIR__."/../Database/factories");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('tickets')) {
            Gate::policy(Ticket::class, TicketPolicy::class);
        }
        $this->app->booted(function (){
            config()->set("AdminSidebar.tickets",[
                "name" => "مدیریت تیکت ها",
                "link" => route("tickets.index"),
                "icon" => "fa-tickets",
                "children"=>[
                    ["name"=>"لیست تیکت ها","link"=>route("tickets.index")],
                    ["name"=>"ارسال تیکت جدید","link"=>route("tickets.add")],
                ],
                "permission"=>Permission::PERMISSION_SUPER_ADMIN
            ]);
        });
    }
}
