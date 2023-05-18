<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ratings';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'client_id',
        'stars'
    ];

    protected $casts = [
        'stars' => 'float'
    ];

    public static $rules = [
        'product_id' => 'required|exists:products,id,deleted_at,NULL',
        'client_id' => 'required|exists:clients,id,deleted_at,NULL',
        'stars' => 'required|numeric|between:0,5'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
