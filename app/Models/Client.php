<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Client
 * @package App\Models
 * @version May 3, 2023, 12:34 am EEST
 *
 * @property string $first_name
 * @property string $last_name
 * @property number $phone
 * @property string $address
 * @property number $user_id
 */
class Client extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'clients';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'phone' => 'required|unique',
        'email' => 'required|unique'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
