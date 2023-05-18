<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Repositories\BaseRepository;

/**
 * Class RatingRepository
 * @package App\Repositories
 * @version May 18, 2023, 11:35 am EEST
*/

class RatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'client_id',
        'stars'
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
        return Rating::class;
    }
}
