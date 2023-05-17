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
        $suggestedForYou = $this->productRepository->getProductsWhereActiveCategory();
        $categories = Category::where('active', 1)->get();
        return $this->sendResponse(
            [
                'squareCategories' => CategoryResource::collection($categories),
                'suggestedForYou' => ProductResource::collection($suggestedForYou)
            ],
            __('messages.retrieved', ['model' => __('awt.data')])
        );
    }
}
