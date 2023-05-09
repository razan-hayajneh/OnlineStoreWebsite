<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Repositories\SliderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Traits\UploadTrait;
use Response;

class SliderController extends AppBaseController
{
    use UploadTrait;

    /** @var SliderRepository $sliderRepository*/
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the Slider.
     *
     * @param SliderDataTable $sliderDataTable
     *
     * @return Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     *
     * @return Response
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();
        if($request->has('image')){
            $input['image'] = $this->uploadFile($request['image'],'sliders');
        }
        $slider = $this->sliderRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/sliders.singular')]));

        return redirect(route('sliders.index'));
    }

    /**
     * Display the specified Slider.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $slider = $this->sliderRepository->find($id);

        // if (empty($slider)) {
        //     Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

        //     return redirect(route('sliders.index'));
        // }

        // return view('sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified Slider.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $slider = $this->sliderRepository->find($id);

        // if (empty($slider)) {
        //     Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

        //     return redirect(route('sliders.index'));
        // }

        // return view('sliders.edit')->with('slider', $slider);
    }

    /**
     * Update the specified Slider in storage.
     *
     * @param int $id
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderRequest $request)
    {
        // $slider = $this->sliderRepository->find($id);

        // if (empty($slider)) {
        //     Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

        //     return redirect(route('sliders.index'));
        // }

        // $slider = $this->sliderRepository->update($request->all(), $id);

        // Flash::success(__('messages.updated', ['model' => __('models/sliders.singular')]));

        // return redirect(route('sliders.index'));
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

            return redirect(route('sliders.index'));
        }
        $this->deleteFile($slider['image'],'sliders');
        $this->sliderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/sliders.singular')]));

        return redirect(route('sliders.index'));
    }
}
