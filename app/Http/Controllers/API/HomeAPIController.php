<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\{CategoryResource, ProductResource};
use App\Models\{Category, Item};
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class HomeAPIController extends AppBaseController
{

    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = $this->productRepository->getProductsWhereActiveCategory();
        $suggestedForYou = $this->productRepository->getProductsWhereActiveCategory();
        $categories = Category::where('active', 1)->get();
        return $this->sendResponse(
            [
                'categories' => CategoryResource::collection($categories),
                'square_categories' => CategoryResource::collection($categories),
                'sales' => ProductResource::collection($sales),
                'suggested_for_you' => ProductResource::collection($suggestedForYou)
            ],
            __('messages.retrieved', ['model' => __('awt.data')])
        );
    }
}
