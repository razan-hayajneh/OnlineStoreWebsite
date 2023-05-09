<?php

namespace App\Repositories;

use App\Models\SocialMedia;
use App\Repositories\BaseRepository;

/**
 * Class SocialMediaRepository
 * @package App\Repositories
 * @version February 27, 2023, 12:38 pm UTC
*/

class SocialMediaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'icon',
        'key',
        'url'
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SocialMedia::class;
    }
}
