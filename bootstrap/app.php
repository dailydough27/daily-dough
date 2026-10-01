<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminKey;
use App\Http\Middleware\InertiaMiddleware;
return Application::configure(basePath: dirname(__DIR__))
 ->withRouting(web: __DIR__.'/../routes/web.php',commands: __DIR__.'/../routes/console.php',health:'/up')
 ->withMiddleware(function(Middleware $middleware){ $middleware->web(append: [InertiaMiddleware::class]); $middleware->alias(['dd.admin'=>AdminKey::class]); })
 ->withExceptions(function(Exceptions $exceptions){})
 ->create();
