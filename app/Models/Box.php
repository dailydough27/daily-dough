<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Box extends Model
{
    protected $fillable=['name','size','price','is_active'];
    protected $casts=['size'=>'integer','price'=>'decimal:2','is_active'=>'boolean'];
}
