<?php

namespace App\Providers;

use App\Models\LogBook;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::define('endorsement.create', function (User $user) {
        $allowedRoles = ['lecturer', 'supervisor'];
        $isAllowed = in_array($user->user_role, $allowedRoles);
        Log::info("User role: {$user->user_role}, Is allowed: " . ($isAllowed ? 'true' : 'false'));
        return $isAllowed;
        });
        Gate::define('endorsement.delete', fn(User $user) => $user->user_role === 'lecturer');
        Gate::define('application.create', fn(User $user) => $user->user_role === 'student');
        Gate::define('application.edit', fn(User $user) => $user->user_role === 'lecturer');
        Gate::define('application.delete', fn(User $user) => $user->user_role === 'student');
        Gate::define('openings.create', fn(User $user) => $user->user_role === 'lecturer');
        Gate::define('openings.edit', fn(User $user) => $user->user_role === 'lecturer');
        Gate::define('openings.delete', fn(User $user) => $user->user_role === 'lecturer');
        Gate::define('logBook.create', fn(User $user) => $user->user_role === 'student');
        Gate::define('logBook.update', function (User $user, LogBook $logBook) {
        return $user->user_role === 'supervisor' && $user->id === $logBook->supervisor_id;
        });

    }
}
