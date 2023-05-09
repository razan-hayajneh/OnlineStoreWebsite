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
 * Class Option
 * @package App\Models
 * @version February 9, 2023, 9:03 am UTC
 *
 * @property string $name
 */
class Option extends Model
{
    use TransformableTrait;
    use SoftDeletes, CascadeSoftDeletes;
    use HasTranslations;
    use HasFactory;

    public $table = 'options';


    protected $dates = ['deleted_at'];
    public $translatable = ['name'];
    protected $cascadeDeletes = ['optionKeys'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_en' => 'required|unique:options,id',
        'name_ar' => 'required|unique:options,id'

    ];

    /**
     * Get all of the optionKeys for the Option
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function optionKeys()
    {
        return $this->hasMany(OptionKey::class);
    }


}
