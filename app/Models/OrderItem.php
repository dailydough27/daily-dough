<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OrderItem extends Model
{
    protected $fillable=['order_id','product_id','box_id','box_size','quantity','unit_price','subtotal','selection'];
    protected $casts=['selection'=>'array','unit_price'=>'decimal:2','subtotal'=>'decimal:2'];
    public function order(): BelongsTo { return $this->belongsTo(Order::class); }
    public function product(): BelongsTo { return $this->belongsTo(Product::class); }
    public function box(): BelongsTo { return $this->belongsTo(Box::class); }
}
