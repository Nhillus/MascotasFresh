<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Passport::routes();

        //Necesario para definir los permisos
        Passport::tokensCan([
            'Admin' => 'Perfom any actions',
            'Medico' => 'Add/Edit/Delete Animals',
            'Asistente Producto' => 'Add/Edit/Delete Products',
            'basic' => 'List Animals',
        ]);

        Passport::setDefaultScope([
            'basic'
        ]);

    }
}
