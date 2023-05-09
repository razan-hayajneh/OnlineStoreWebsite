<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
*/

class UserRepository  extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'phone',
        'replace_phone',
        'avatar',
        'otp',
        'lang',
        'active',
        'banned',
        'accepted',
        'notify',
        'online',
        'role_id',
        'country_id',
        'city_id',
        'user_type',
        'user_status_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    public function clients()
    {
        return User::where('user_type', 'client')->get();
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
