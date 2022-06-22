<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use App\Models\Passport\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::useClientModel(Client::class);
    }
}
