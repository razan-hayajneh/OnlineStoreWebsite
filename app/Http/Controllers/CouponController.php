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
    /** @var CouponRepository $couponRepository*/
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }

    /**
     * Display a listing of the Coupon.
     *
     * @param CouponDataTable $couponDataTable
     *
     * @return Response
     */
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('coupons.index');
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param CreateCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
        // $input = $request->all();

        $description = ['ar' => $request['description_ar'], 'en' => $request['description_en']];

        $input = ['description' => $description,'code' => $request['code'],'is_ratio' => $request['is_ratio'], 'value' => $request['value'],'expiration_date' => $request['expiration_date'], ];
       
        $coupon = $this->couponRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/coupons.singular')]));

        return redirect(route('coupons.index'));
    }

    /**
     * Display the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }

        $coupon->description_ar = $coupon->getTranslation('description', 'ar')??'';
        $coupon->description_en = $coupon->getTranslation('description', 'en')??'';

        return view('coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }

        $coupon->description_ar = $coupon->getTranslation('description', 'ar')??'';
        $coupon->description_en = $coupon->getTranslation('description', 'en')??'';

        $coupon->expiration_date=  $coupon->expiration_date->format('m/d/yyyy');
// dd($coupon );

        return view('coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);
        $description = ['ar' => $request['description_ar'], 'en' => $request['description_en']];


        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('coupons.index'));
        }
        $input = ['description' => $description,'code' => $request['code'],'is_ratio' => $request['is_ratio'], 'value' => $request['value'],'expiration_date' => $request['expiration_date'], ];

        $coupon = $this->couponRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/coupons.singular')]));

        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @param int $id
     *
     * @return Response
     */
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
    public function exportPdf()
    {
        $coupons = Coupon::all();
        $lang = app()->getLocale();
        foreach ($coupons  as $value) {
            $description = $value->toArray();
            $value->desc = $lang == 'ar' ? $description['description']['ar'] :  $description['description']['en'];
            if ($value->is_ratio == 1) {
                $value->is_ratio = $lang == 'ar' ? 'نسبة' :  'ratio';
            } else {
                $value->is_ratio = $lang == 'ar' ? 'قيمة ثابتة'  :  'Fixed';
            }
        }
        if (count($coupons) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        $pdf = PDF::loadView('coupons.pdf', compact('coupons'));
        return $pdf->stream('coupons.pdf');
    }
    public function exportExcel()
    {
        $coupons = Coupon::all();
        $lang = app()->getLocale();
        foreach ($coupons  as $value) {
            $description = $value->toArray();
            $value->desc = $lang == 'ar' ? $description['description']['ar'] :  $description['description']['en'];
            if ($value->is_ratio == 1) {
                $value->is_ratio = $lang == 'ar' ? 'نسبة' :  'ratio';
            } else {
                $value->is_ratio = $lang == 'ar' ? 'قيمة ثابتة'  :  'Fixed';
            }
        }
        if (count($coupons) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        return Excel::download(new CouponExport($coupons), 'coupons.XLSX');
    }
}
