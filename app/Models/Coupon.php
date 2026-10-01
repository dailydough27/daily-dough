<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Coupon extends Model { protected $fillable=['code','type','value','min_subtotal','is_active','expires_at']; protected $casts=['value'=>'decimal:2','min_subtotal'=>'decimal:2','is_active'=>'boolean','expires_at'=>'datetime']; public function validFor(float $subtotal): bool { return $this->is_active && $subtotal >= (float)$this->min_subtotal && (!$this->expires_at || $this->expires_at->isFuture()); } public function discount(float $subtotal): float { if(!$this->validFor($subtotal)) return 0; return min($subtotal,$this->type==='percent' ? $subtotal*((float)$this->value/100) : (float)$this->value); } }
