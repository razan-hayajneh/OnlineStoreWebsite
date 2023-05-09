<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SocialMedia
 * @package App\Models
 * @version February 27, 2023, 12:38 pm UTC
 *
 * @property string $icon
 * @property string $key
 * @property string $url
 */
class SocialMedia extends Model
{
    use HasFactory;

    public $table = 'social_media';

    public $fillable = [
        'icon',
        'key',
        'url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'icon' => 'string',
        'key' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'icon' => 'required|image|max:1000',
        'key' => 'required',
        'url' => 'required|url'
    ];


}
