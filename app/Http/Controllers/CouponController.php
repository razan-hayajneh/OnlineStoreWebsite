<?php

namespace App\Http\Controllers;

use App\DataTables\CouponDataTable;
use App\Exports\CouponExport;
use App\Http\Requests;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Coupon;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use PDF;
use Carbon\Carbon;

class CouponController extends AppBaseController
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }

    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('coupons.index');
    }

    public function create()
    {
        return view('coupons.create');
    }

    public function store(CreateCouponRequest $request)
    {
        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/coupons.singular')]));

        return redirect(route('coupons.index'));
    }

    public function show($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }

        return view('coupons.show')->with('coupon', $coupon);
    }

    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }

        return view('coupons.edit')->with('coupon', $coupon);
    }

    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);


        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }

        $coupon = $this->couponRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/coupons.singular')]));

        return redirect(route('coupons.index'));
    }

    public function destroy($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/coupons.singular')]));

        return redirect(route('coupons.index'));
    }
}
