<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use SoftDeletes;
    use HasRelationships;
    use HasFactory;

    public $table = 'orders';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'client_id',
        'total_price',
        'coupon_id',
        'final_price',
        'tax',
        'order_status',
        'canceled',
        'address',
        'notes'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'total_price' => 'float',
        'coupon_id' => 'integer',
        'final_price' => 'float',
        'tax' => 'float'
    ];

    public static $rules = [
        'user_id' => 'required|exists:users,id,deleted_at,NULL',
        'total_price' => 'required',
        'coupon_id' => 'nullable|exists:coupons,id,deleted_at,NULL',
        'final_price' => 'required'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
    public function products()
    {
        return $this->belongsToMany(ProductOptionKey::class, 'product_order', 'order_id', 'product_option_key_id')->withPivot('id', 'product_option_key_id', 'price', 'purchase_price', 'quantity');
    }
}
