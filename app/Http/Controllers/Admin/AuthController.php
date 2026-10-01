<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Http\Request; use Inertia\Inertia;
class AuthController extends Controller { public function create(){return Inertia::render('Admin/Login');} public function store(Request $r){$r->validate(['password'=>'required']); if(hash_equals((string)env('DAILY_DOUGH_ADMIN_PASSWORD','change-me'),(string)$r->password)){ $r->session()->regenerate();$r->session()->put('dd_admin',true);return redirect('/admin'); } return back()->withErrors(['password'=>'Invalid admin password.']); } public function destroy(Request $r){$r->session()->forget('dd_admin');return redirect('/admin/login');} }
