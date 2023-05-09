<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductOptionKey
 * @package App\Models
 * @version February 15, 2023, 9:30 am UTC
 *
 * @property foreignId $product_id
 * @property foreignId $option_key_id
 * @property number $price
 * @property integer $quantity
 */
class ProductOptionKey extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product_option_keys';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'option_key_id',
        'price',
        'quantity'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'quantity' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|exists:,id',
        'option_key_id' => 'required|exists:option_keys,id',
        'price' => 'required',
        'quantity' => 'required'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function optionKey()
    {
        return $this->belongsTo(OptionKey::class);
    }
}
