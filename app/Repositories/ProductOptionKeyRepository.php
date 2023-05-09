<?php

namespace App\Repositories;

use App\Models\ProductOptionKey;
use App\Repositories\BaseRepository;

/**
 * Class ProductOptionKeyRepository
 * @package App\Repositories
 * @version February 15, 2023, 9:30 am UTC
*/

class ProductOptionKeyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'option_key_id',
        'price',
        'quantity'
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
        return ProductOptionKey::class;
    }
}
