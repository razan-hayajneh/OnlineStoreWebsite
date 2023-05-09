<?php

namespace App\Http\Controllers;

use App\DataTables\OptionKeyDataTable;
use App\Exports\OptionKeyExport;
use App\Http\Requests;
use App\Http\Requests\CreateOptionKeyRequest;
use App\Http\Requests\UpdateOptionKeyRequest;
use App\Repositories\OptionKeyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Option;
use App\Models\OptionKey;
use PDF;
// use DragonCode\Contracts\Cashier\Http\Request;
use Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OptionKeyController extends AppBaseController
{
    /** @var OptionKeyRepository $optionKeyRepository*/
    private $optionKeyRepository;

    public function __construct(OptionKeyRepository $optionKeyRepo)
    {
        $this->optionKeyRepository = $optionKeyRepo;
    }

    /**
     * Display a listing of the OptionKey.
     *
     * @param OptionKeyDataTable $optionKeyDataTable
     *
     * @return Response
     */
    public function index(OptionKeyDataTable $optionKeyDataTable, Request $request)
    {



        $option = Option::find($request->input('id'));

    //    dd($option);
        return $optionKeyDataTable->with('id', $request->input('id'))

           ->render('option_keys.index', compact('option'));
        // return $optionKeyDataTable->render('option-keys.index', $id);
    }

    /**
     * Show the form for creating a new OptionKey.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // $option_id = $request->input('id');
        $option = Option::find($request->input('id'));
        return view('option_keys.create', compact('option'));
    }

    /**
     * Store a newly created OptionKey in storage.
     *
     * @param CreateOptionKeyRequest $request
     *
     * @return Response
     */
    public function store(CreateOptionKeyRequest $request)
    {
        $input = $request->all();
        $key = ['ar' => $request['key_ar'], 'en' => $request['key_en']];


        $input = ['key' => $key, 'option_id' => $request['option_id']  ];
        $optionKey = $this->optionKeyRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/optionKeys.singular')]));

        return redirect(route('optionKeys.index', ['id' => $optionKey->option_id]));
    }

    /**
     * Display the specified OptionKey.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $optionKey = $this->optionKeyRepository->find($id);
        $option = Option::find($optionKey->option_id);


        $optionKey->key_ar = $optionKey->getTranslation('key', 'ar') ?? '';
        $optionKey->key_en = $optionKey->getTranslation('key', 'en') ?? '';
        if (empty($optionKey)) {
            Flash::error(__('messages.not_found', ['model' => __('models/optionKeys.singular')]));

            return redirect(route('optionKeys.index'));
        }

        return view('option_keys.show', compact('optionKey', 'option'));
    }

    /**
     * Show the form for editing the specified OptionKey.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $optionKey = $this->optionKeyRepository->find($id);
        $option = Option::find($optionKey->option_id);

        if (empty($optionKey)) {
            Flash::error(__('messages.not_found', ['model' => __('models/optionKeys.singular')]));

            return redirect(route('optionKeys.index'));
        }

        $optionKey->key_ar = $optionKey->getTranslation('key', 'ar')??'';
        $optionKey->key_en = $optionKey->getTranslation('key', 'en')??'';

        return view('option_keys.edit', compact('optionKey', 'option'));
        // ->with('optionKey', $optionKey);
    }

    /**
     * Update the specified OptionKey in storage.
     *
     * @param int $id
     * @param UpdateOptionKeyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOptionKeyRequest $request)
    {
        $optionKey = $this->optionKeyRepository->find($id);

        if (empty($optionKey)) {
            Flash::error(__('messages.not_found', ['model' => __('models/optionKeys.singular')]));

            return redirect(route('optionKeys.index'));
        }

        $optionKey = $this->optionKeyRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/optionKeys.singular')]));

        return redirect(route('optionKeys.index', ['id' => $optionKey->option_id]));
    }

    /**
     * Remove the specified OptionKey from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $optionKey = $this->optionKeyRepository->find($id);
        $optionKeyId = $optionKey->option_id;

        if (empty($optionKey)) {
            Flash::error(__('messages.not_found', ['model' => __('models/optionKeys.singular')]));

            return redirect(route('optionKeys.index'));
        }

        $this->optionKeyRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/optionKeys.singular')]));

        return redirect(route('optionKeys.index', ['id' => $optionKeyId]));
    }

    public function exportPdf($id)
    {
        $optionKeys = OptionKey::where('option_id', $id)->get();
        $option = Option::find($id);
        $lang = app()->getLocale();
        foreach ($optionKeys  as $value) {
            $key = $value->toArray();
            $value->key = $lang == 'ar' ? $key['key']['ar'] :  $key['key']['en'];
        }
        if (count($optionKeys) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message'=>$message] );
        }
        $pdf = Pdf::loadView('option_keys.pdf', compact('optionKeys','option'));
        return $pdf->stream('optionKeys.pdf');
    }
    public function exportExcel($id)
    {
        $optionKeys = OptionKey::where('option_id', $id)->get();
        $option = Option::find($id);

        $lang = app()->getLocale();
        foreach ($optionKeys  as $value) {
            $key = $value->toArray();
            $value->key = $lang == 'ar' ? $key['key']['ar'] :  $key['key']['en'];
        }
        if (count($optionKeys) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message'=>$message] );
        }
        return Excel::download(new OptionKeyExport($optionKeys,$option), 'optionKeys.XLSX');
    }
}
