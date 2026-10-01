<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Inertia\Middleware;
class InertiaMiddleware extends Middleware { protected $rootView='app'; public function share(Request $request): array { return array_merge(parent::share($request),['appName'=>'Daily Dough']); } }
