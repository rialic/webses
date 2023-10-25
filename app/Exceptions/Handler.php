<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        $user = $request->user();
        $isXMLHttpRequest = $request->ajax();

        if ($exception instanceof HttpException && $isXMLHttpRequest) {
            return response()->json([
                'user' => [
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'verified_at' => $user->verified_at,
                    'current_subdomain' => $user->current_subdomain,
                ],
                'message' => $exception->getMessage()
            ], $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }
}
