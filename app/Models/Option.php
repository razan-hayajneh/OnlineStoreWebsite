<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    use HasFactory;

    public $table = 'options';


    protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['optionKeys'];



    public $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    public static $rules = [
        'name' => 'required|unique:options,id'

    ];

    public function optionKeys()
    {
        return $this->hasMany(OptionKey::class);
    }


}
