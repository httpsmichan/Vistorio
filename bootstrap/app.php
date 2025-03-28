<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Host;
use App\Http\Middleware\Receptionist;
use App\Http\Middleware\Visitor;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'=>Admin::class,
            'receptionist'=>Receptionist::class,
            'host'=>Host::class,
            'visitor'=>Visitor::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
