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
 * Class Coupon
 * @package App\Models
 * @version February 9, 2023, 2:50 pm UTC
 *
 * @property string $code
 * @property string $description
 * @property boolean $is_ratio
 * @property number $value
 * @property string $expiration_date
 */
class Coupon extends Model
{
    use TransformableTrait;
    use SoftDeletes, CascadeSoftDeletes;
    use HasTranslations;
    use HasFactory;

    public $table = 'coupons';
    public $translatable = ['description'];



    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'description',
        'is_ratio',
        'value',
        'expiration_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'is_ratio' => 'boolean',
        'value' => 'float',
        'expiration_date' => 'date:yy-m-d'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required|unique:coupons,deleted_at,NULL',
        'value' => 'required',
        'expiration_date' => 'required',
    ];

    /**
     * Get the order associated with the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
