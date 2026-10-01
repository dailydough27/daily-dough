<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\DeliveryZone; use Illuminate\Http\Request; use Inertia\Inertia;
class DeliveryController extends Controller { public function index(){return Inertia::render('Admin/Delivery',['zones'=>DeliveryZone::orderBy('name')->get()]);} public function store(Request $r){$d=$r->validate(['name'=>'required|max:120','fee'=>'required|numeric|min:0','is_active'=>'boolean']);DeliveryZone::create($d);return back();} public function update(Request $r,DeliveryZone $zone){$d=$r->validate(['name'=>'required|max:120','fee'=>'required|numeric|min:0','is_active'=>'boolean']);$zone->update($d);return back();} public function destroy(DeliveryZone $zone){$zone->update(['is_active'=>false]);return back();} }
