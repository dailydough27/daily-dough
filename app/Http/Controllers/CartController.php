<?php
namespace App\Http\Controllers;
use App\Models\Box; use App\Models\Product; use Illuminate\Http\Request; use Inertia\Inertia;
class CartController {
 public function show(Request $request){return Inertia::render('Cart',['cart'=>array_values(session('cart',[]))]);}
 public function addBox(Request $request){
  $data=$request->validate(['box_id'=>'required|exists:boxes,id','selection'=>'required|array']);
  $box=Box::where('is_active',true)->findOrFail($data['box_id']);
  $products=Product::where('is_active',true)->whereIn('id',array_keys($data['selection']))->get()->keyBy('id');
  $total=array_sum(array_map('intval',$data['selection']));
  abort_if($total!==$box->size,422,'Please select exactly '.$box->size.' cookies.');
  $selection=[]; $extra=0;
  foreach($data['selection'] as $id=>$qty){
   $qty=(int)$qty; if($qty<=0||!isset($products[$id])) continue; $product=$products[$id];
   $standard=$box->size===4 ? (in_array($product->slug,['classic-chocolate-chip','double-chocolate','lotus','red-velvet'])?1:0) : ($box->size===6?1:2);
   $rate=in_array($product->slug,['kinder','pistachio'])?50:(in_array($product->slug,['lotus','red-velvet'])?30:($product->slug==='double-chocolate'?20:0));
   $extra+=max(0,$qty-$standard)*$rate;
   $selection[]=['product_id'=>(int)$id,'name'=>$product->name,'quantity'=>$qty];
  }
  abort_if(!$selection,422,'Choose at least one flavor.');
  $unit=(float)$box->price+$extra; $cart=session('cart',[]); $key=uniqid('box_',true);
  $cart[$key]=['id'=>$key,'kind'=>'box','box_id'=>$box->id,'box_name'=>$box->name,'box_size'=>$box->size,'quantity'=>1,'unit_price'=>$unit,'base_price'=>(float)$box->price,'extras'=>$extra,'subtotal'=>$unit,'selection'=>$selection];
  session(['cart'=>$cart]); return redirect()->route('cart');
 }
 public function addItem(Request $request){
  $data=$request->validate(['name'=>'required|string|max:120','price'=>'required|numeric|min:0','kind'=>'required|string|max:40','details'=>'nullable|array']);
  $cart=session('cart',[]); $key=uniqid('item_',true); $price=(float)$data['price'];
  $cart[$key]=['id'=>$key,'kind'=>$data['kind'],'box_id'=>null,'box_name'=>$data['name'],'box_size'=>null,'quantity'=>1,'unit_price'=>$price,'subtotal'=>$price,'selection'=>$data['details']??[]];
  session(['cart'=>$cart]); return redirect()->route('cart');
 }
 public function update(Request $request,string $line){$cart=session('cart',[]);if(isset($cart[$line])){$q=max(1,min(10,(int)$request->input('quantity',1)));$cart[$line]['quantity']=$q;$cart[$line]['subtotal']=$cart[$line]['unit_price']*$q;session(['cart'=>$cart]);}return back();}
 public function remove(string $line){$cart=session('cart',[]);unset($cart[$line]);session(['cart'=>$cart]);return back();}
}
