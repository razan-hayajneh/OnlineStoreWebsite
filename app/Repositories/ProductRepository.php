<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version February 8, 2023, 4:56 pm UTC
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'price',
        'category_id',
        'quantity',
        'discount',
        'discount_type',
        'image_path'
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
    public function getProductsWhereActiveCategory()
    {
        return Product::whereHas('category', function ($query) {
            $query->where('active', 1);
        })->orderBy(DB::raw('RAND()'))->take(10)->get();
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
