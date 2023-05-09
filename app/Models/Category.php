<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Category
 * @package App\Models
 * @version February 9, 2023, 12:19 pm UTC
 *
 * @property string $name
 * @property integer $parent_id
 * @property boolean $active
 * @property blob $image
 */
class Category extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    use HasFactory;

    public $table = 'categories';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'active',
        'image_path'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'name' => 'string',
        // 'parent_id' => 'integer',
        // 'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:categories,name',
        'image_path' => 'required|mimes:png,svg,jpg,jpeg',
    ];
}
