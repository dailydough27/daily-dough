<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Order; use Inertia\Inertia;
class DashboardController extends Controller { public function index(){return Inertia::render('Admin/Dashboard',['stats'=>['orders'=>Order::count(),'pending'=>Order::where('status','pending')->count(),'today'=>Order::whereDate('created_at',today())->count(),'revenue'=>Order::whereNotIn('status',['cancelled'])->sum('total')],'recent'=>Order::latest()->take(8)->get()]);} }
