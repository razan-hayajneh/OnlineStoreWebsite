<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Translatable\HasTranslations;

/**
 * Class Product
 * @package App\Models
 * @version February 8, 2023, 4:56 pm UTC
 *
 * @property string $name
 * @property string $description
 * @property number $price
 * @property integer $category_id
 * @property integer $quantity
 * @property number $discount
 * @property boolean $discount_type
 */
class Product extends Model
{
        use SoftDeletes, CascadeSoftDeletes;
    use HasFactory;

    public $table = 'products';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'quantity',
        'discount',
        'discount_type',
        'image_path'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'price' => 'float',
        'category_id' => 'integer',
        'quantity' => 'integer',
        'discount' => 'float',
        'discount_type' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required',
        'image_path' => 'required|mimes:png,svg,jpg,jpeg',
        'category_id' => 'required|exists:categories,id,deleted_at,NULL',
        'quantity' => 'nullable'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function order()
    {
        return $this->belongsToMany('App\Models\Order', 'product_order', 'product_id', 'order_id')->withPivot('id', 'product_option_key_id', 'price', 'purchase_price', 'quantity');
    }
    public function sumOfQuantity()
    {
        return $this->belongsToMany('App\Models\Order', 'product_order', 'product_id', 'order_id')
            ->selectRaw('quantity');
    }
    // accessor for easier fetching the count
    public function getSumOfQuantityAttribute()
    {
        if (!array_key_exists('sumOfQuantity', $this->relations)) $this->load('sumOfQuantity');

        $related = $this->getRelation('sumOfQuantity')->count('quantity');

        return ($related) ? $related->quantity : 0;
    }
    public function optionKeys()
    {
        return $this->hasMany(ProductOptionKey::class, 'product_id');
    }

    public function ProductImages()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
}
