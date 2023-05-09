<?php

namespace App\Http\Controllers;

use App\DataTables\OptionDataTable;
use App\Exports\OptionExport;
use App\Http\Requests;
use App\Http\Requests\CreateOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Repositories\OptionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Option;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Response;

class OptionController extends AppBaseController
{
    /** @var OptionRepository $optionRepository*/
    private $optionRepository;

    public function __construct(OptionRepository $optionRepo)
    {
        $this->optionRepository = $optionRepo;
    }

    /**
     * Display a listing of the Option.
     *
     * @param OptionDataTable $optionDataTable
     *
     * @return Response
     */
    public function index(OptionDataTable $optionDataTable)
    {
        return $optionDataTable->render('options.index');
    }

    /**
     * Show the form for creating a new Option.
     *
     * @return Response
     */
    public function create()
    {
        return view('options.create');
    }

    /**
     * Store a newly created Option in storage.
     *
     * @param CreateOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateOptionRequest $request)
    {
        // $input = $request->all();
        $name = ['ar' => $request['name_ar'], 'en' => $request['name_en']];


        $input = ['name' => $name];
        $option = $this->optionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/options.singular')]));

        return redirect(route('options.index'));
    }

    /**
     * Display the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $option = $this->optionRepository->find($id);
        $option->name_ar = $option->getTranslation('name', 'ar') ?? '';
        $option->name_en = $option->getTranslation('name', 'en') ?? '';

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }

        return view('options.show')->with('option', $option);
    }

    /**
     * Show the form for editing the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }
        $option->name_ar = $option->getTranslation('name', 'ar') ?? '';
        $option->name_en = $option->getTranslation('name', 'en') ?? '';

        return view('options.edit')->with('option', $option);
    }

    /**
     * Update the specified Option in storage.
     *
     * @param int $id
     * @param UpdateOptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOptionRequest $request)
    {
        $option = $this->optionRepository->find($id);
        $name = ['ar' => $request['name_ar'], 'en' => $request['name_en']];

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }
        $input = ['name' => $name];

        $option = $this->optionRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/options.singular')]));

        return redirect(route('options.index'));
    }

    /**
     * Remove the specified Option from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }

        $this->optionRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/options.singular')]));

        return redirect(route('options.index'));
    }

    public function exportPdf()
    {
        $options = Option::all();
        $lang = app()->getLocale();
        foreach ($options  as $value) {
            $name = $value->toArray();
            $value->option_name = $lang == 'ar' ? $name['name']['ar'] :  $name['name']['en'];
        }
        if (count($options) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message'=>$message] );
        }
        $pdf = Pdf::loadView('options.pdf', compact('options'));
        return $pdf->stream('options.pdf');
    }
    public function exportExcel()
    {
        $options = Option::all();
        $lang = app()->getLocale();
        foreach ($options  as $value) {
            $name = $value->toArray();
            $value->option_name = $lang == 'ar' ? $name['name']['ar'] :  $name['name']['en'];
        }
        if (count($options) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message'=>$message] );
        }
        return Excel::download(new OptionExport($options), 'options.XLSX');
    }
}
