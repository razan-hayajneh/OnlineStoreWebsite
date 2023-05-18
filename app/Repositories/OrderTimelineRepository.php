<?php

namespace App\Repositories;

use App\Models\OrderTimeline;
use App\Repositories\BaseRepository;

/**
 * Class OrderTimelineRepository
 * @package App\Repositories
 * @version May 18, 2023, 1:19 pm EEST
*/

class OrderTimelineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'status',
        'date'
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
        return OrderTimeline::class;
    }
}
