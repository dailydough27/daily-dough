<?php
namespace App\Http\Controllers;
use App\Models\Product; use App\Models\Setting; use Inertia\Inertia;
class HomeController extends Controller { public function index(){return Inertia::render('Home',['products'=>Product::where('is_active',true)->orderBy('id')->get(),'settings'=>['instagram'=>Setting::getValue('instagram'),'tiktok'=>Setting::getValue('tiktok'),'whatsapp'=>Setting::getValue('whatsapp')]]);} }
