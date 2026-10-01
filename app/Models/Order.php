<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\HasMany;
class Order extends Model { protected $fillable=['order_number','customer_name','phone','area','address','apartment','notes','subtotal','delivery_fee','discount','coupon_code','total','payment_method','status']; protected $casts=['subtotal'=>'decimal:2','delivery_fee'=>'decimal:2','discount'=>'decimal:2','total'=>'decimal:2']; public function items():HasMany{return $this->hasMany(OrderItem::class);} public function statusLabel(): string { return str_replace('_',' ',ucwords($this->status,'_')); } }
