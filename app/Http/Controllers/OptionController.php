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
    private $optionRepository;

    public function __construct(OptionRepository $optionRepo)
    {
        $this->optionRepository = $optionRepo;
    }

    public function index(OptionDataTable $optionDataTable)
    {
        return $optionDataTable->render('options.index');
    }

    public function create()
    {
        return view('options.create');
    }

    public function store(CreateOptionRequest $request)
    {
        $input = $request->all();
        $option = $this->optionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/options.singular')]));

        return redirect(route('options.index'));
    }

    public function show($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }

        return view('options.show')->with('option', $option);
    }

    public function edit($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }

        return view('options.edit')->with('option', $option);
    }

    public function update($id, UpdateOptionRequest $request)
    {
        $option = $this->optionRepository->find($id);
        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('options.index'));
        }
        $input = $request->all();

        $option = $this->optionRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/options.singular')]));

        return redirect(route('options.index'));
    }

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
            $message = 'No any data to export';
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
            $message = 'No any data to export';
            return redirect()->back()->with(['message'=>$message] );
        }
        return Excel::download(new OptionExport($options), 'options.XLSX');
    }
}
