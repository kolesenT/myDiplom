<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Discipline;
use App\Models\Journal;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\User_info;
use App\Policies\DisciplinePolicy;
use App\Policies\JournalPolicy;
use App\Policies\ScedulePolicy;
use App\Policies\SchoolClassPolicy;
use App\Policies\User_infoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Journal::class => JournalPolicy::class,
        User_info::class => User_infoPolicy::class,
        Discipline::class => DisciplinePolicy::class,
        Schedule::class => ScedulePolicy::class,
        SchoolClass::class => SchoolClassPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
