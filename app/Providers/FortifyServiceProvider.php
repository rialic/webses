<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\Auth\VerifyEmailResource;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Requests
        $this->app->bind(LoginRequest::class, LoginUserRequest::class);

        // Responses
        $this->app->bind(LoginResponseContract::class, AuthResource::class);
        $this->app->bind(RegisterResponseContract::class, RegisterResource::class);
        $this->app->bind(VerifyEmailResponseContract::class, VerifyEmailResource::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Login
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('us_email', $request->input('email'))->orWhere('us_cpf', $request->input('email'))->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages(['email' => 'Credenciais incorretas.']);
            }

            // TODO SE O USUÁRIO JÁ FOR CADASTRADO E TENTAR ACESSAR UM SUBDOMAIN QUE ELE NÃO TEM ACESSO, ENTRAR CADASTRAR ELE NO NOVO SUDOMAIN
            // E DEPOIS LOGAR ELE
            return $user;
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Rate Limiter
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });
    }
}
