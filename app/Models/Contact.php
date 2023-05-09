<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contact
 * @package App\Models
 * @version February 27, 2023, 8:44 am UTC
 *
 * @property string $email
 * @property string $phone
 * @property string $phone2
 * @property string $googleStore
 * @property string $appStore
 * @property string $longitude
 * @property string $latitude
 * @property string $whatsapp
 */
class Contact extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contacts';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'email',
        'phone',
        'phone2',
        'googleStore',
        'appStore',
        'longitude',
        'latitude',
        'location',
        'whatsapp'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'phone' => 'string',
        'phone2' => 'string',
        'googleStore' => 'string',
        'appStore' => 'string',
        'latitude' => 'string',
        'whatsapp' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required',
        'phone' => 'required|min:9|max:10',
        'whatsapp' => 'sometimes|size:13',
    ];


}
