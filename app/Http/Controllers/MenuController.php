<?php
namespace App\Http\Controllers;
use App\Models\Box; use App\Models\Product; use Inertia\Inertia;
class MenuController extends Controller { public function index(){return Inertia::render('Menu',['products'=>Product::where('is_active',true)->orderBy('id')->get(),'boxes'=>Box::where('is_active',true)->orderBy('size')->get()]);} public function buildBox(){return Inertia::render('BuildBox',['products'=>Product::where('is_active',true)->orderBy('id')->get(),'boxes'=>Box::where('is_active',true)->orderBy('size')->get()]);} }
