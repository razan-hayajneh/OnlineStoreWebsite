<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderTimelineAPIRequest;
use App\Http\Requests\API\UpdateOrderTimelineAPIRequest;
use App\Models\OrderTimeline;
use App\Repositories\OrderTimelineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\OrderTimelineResource;
use Response;

/**
 * Class OrderTimelineController
 * @package App\Http\Controllers\API
 */

class OrderTimelineAPIController extends AppBaseController
{
    /** @var  OrderTimelineRepository */
    private $orderTimelineRepository;

    public function __construct(OrderTimelineRepository $orderTimelineRepo)
    {
        $this->orderTimelineRepository = $orderTimelineRepo;
    }

    /**
     * Display a listing of the OrderTimeline.
     * GET|HEAD /orderTimelines
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        
        $orderTimelines = $this->orderTimelineRepository->where('order_id',request('id'))->get();

        return $this->sendResponse(
            OrderTimelineResource::collection($orderTimelines),
            __('messages.retrieved', ['model' => __('models/orderTimelines.plural')])
        );
    }


}
