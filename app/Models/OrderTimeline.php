<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class OrderTimeline
 * @package App\Models
 * @version May 18, 2023, 1:19 pm EEST
 *
 * @property foreignId $order_id
 * @property string $status
 * @property string $date
 */
class OrderTimeline extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'order_timelines';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'status',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|exists:orders,id,deleted_at,NULL',
        'status' => 'required',
        'date' => 'required'
    ];

    
}
