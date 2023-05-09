<?php

namespace App\Repositories;

use App\Models\OptionKey;
use App\Repositories\BaseRepository;

/**
 * Class OptionKeyRepository
 * @package App\Repositories
 * @version February 9, 2023, 9:04 am UTC
*/

class OptionKeyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'option_id',
        'price'
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
        return OptionKey::class;
    }
}
