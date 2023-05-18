<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRatingAPIRequest;
use App\Repositories\RatingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RatingResource;


class RatingAPIController extends AppBaseController
{
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepository = $ratingRepo;
    }

    public function index(Request $request)
    {
        $ratings = $this->ratingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            RatingResource::collection($ratings),
            __('messages.retrieved', ['model' => __('models/ratings.plural')])
        );
    }

    public function store(CreateRatingAPIRequest $request)
    {
        $input = $request->all();

        $rating = $this->ratingRepository->create($input);

        return $this->sendResponse(
            new RatingResource($rating),
            __('messages.saved', ['model' => __('models/ratings.singular')])
        );
    }
}
