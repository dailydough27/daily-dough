<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request;
class AdminKey { public function handle(Request $request,Closure $next){ if(!$request->session()->get('dd_admin')) return redirect('/admin/login'); return $next($request); } }
