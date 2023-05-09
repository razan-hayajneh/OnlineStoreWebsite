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
 * Class OptionKey
 * @package App\Models
 * @version February 9, 2023, 9:04 am UTC
 *
 * @property string $key
 * @property integer $option_id
 * @property number $price
 */
class OptionKey extends Model
{
    use TransformableTrait;
    use SoftDeletes, CascadeSoftDeletes;
    use HasTranslations;
    use HasFactory;

    public $table = 'option_keys';


    protected $dates = ['deleted_at'];
    public $translatable = ['key'];



    public $fillable = [
        'key',
        'option_id',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'option_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key_en' => 'required|unique:option_keys,id',
        'key_ar' => 'required|unique:option_keys,id',
        'option_id' => 'required|exists:options,id,deleted_at,NULL'
    ];

    public function products()
    {
        return $this->hasMany(ProductOptionKey::class,'option_key_id');
    }

   /**
     * Get all of the optionKeys for the Option
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
