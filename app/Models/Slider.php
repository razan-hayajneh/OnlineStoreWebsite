<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Slider
 * @package App\Models
 * @version February 26, 2023, 11:08 am UTC
 *
 * @property string $image
 */
class Slider extends Model
{

    use HasFactory;

    public $table = 'sliders';

    public $fillable = [
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' =>  'required|image|mimes:jpg,jpeg,png,gif,svg|max:100000',

    ];


}
