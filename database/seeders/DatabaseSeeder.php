<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\Product; use App\Models\Box; use App\Models\DeliveryZone; use App\Models\Setting;
class DatabaseSeeder extends Seeder { public function run():void { Product::query()->delete(); Box::query()->delete(); DeliveryZone::query()->delete(); $items=[
 ['Classic Chocolate Chip','classic-chocolate-chip','Soft, buttery cookie with rich chocolate chips.','/images/classic-chocolate-chip.png'],
 ['Double Chocolate','double-chocolate','Rich chocolate cookie with generous chocolate chunks.','/images/double-chocolate.png'],
 ['Pistachio','pistachio','Pistachio cookie filled with smooth pistachio spread.','/images/pistachio.png'],
 ['Lotus','lotus','Crushed Lotus biscuit cookie with Lotus spread.','/images/lotus.png'],
 ['Red Velvet','red-velvet','Red velvet cookie with creamy white chocolate filling.','/images/red-velvet.png'],
 ['Kinder','kinder','Soft cookie filled with milk chocolate and hazelnut cream.','/images/kinder.png']];
 foreach($items as [$name,$slug,$description,$image]) Product::create(['name'=>$name,'slug'=>$slug,'description'=>$description,'image'=>$image,'is_active'=>true]);
 foreach([['Box of 4',4,190],['Box of 6',6,305],['Box of 12',12,595]] as [$name,$size,$price]) Box::create(['name'=>$name,'size'=>$size,'price'=>$price,'is_active'=>true]);
 foreach([['name'=>'Cairo','fee'=>50],['name'=>'Giza','fee'=>60],['name'=>'New Cairo','fee'=>80],['name'=>'Sheikh Zayed','fee'=>70],['name'=>'6 October','fee'=>70]] as $z) DeliveryZone::create($z+['is_active'=>true]);
 foreach(['free_delivery_threshold'=>'500','brand_tagline'=>'Sweet things bring people together.','instagram'=>'','tiktok'=>'','whatsapp'=>''] as $k=>$v) Setting::putValue($k,$v); } }
