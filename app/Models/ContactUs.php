<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ContactUs
 * @package App\Models
 * @version February 26, 2023, 11:52 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $phone
 */
class ContactUs extends Model
{
    use HasFactory;

    public $table = 'contactuses';

    public $fillable = [
        'name',
        'email',
        'message',
        'phone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'message' => 'string',
        'phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required|min:10',
        'phone' => 'sometimes|min:9|mix:10'
    ];


}
