<?php

namespace App\Http\Controllers;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Exports\ExportClient;
use App\Http\Requests\{CreateClientRequest, UpdateClientRequest};
use App\Repositories\{ClientRepository, UserRepository};
use App\Traits\UploadTrait;
use Flash;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use Response;

class ClientController extends AppBaseController
{
    use UploadTrait;

    private $clientRepository;
    private $userRepository;

    public function __construct(ClientRepository $clientRepo, UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->clientRepository = $clientRepo;
    }

    public function index(ClientDataTable $clientDataTable)
    {
        return $clientDataTable->render('clients.index');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(CreateClientRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['user_type'] = 'client';

        if ($request->has('profile_photo_path')) {
            $input['profile_photo_path'] = $this->uploadFile($request['profile_photo_path'], 'clients');
        }
        $user = $this->userRepository->create($input);
        $input['user_id'] = $user->id;
        $client = $this->clientRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    public function show($id)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with('client', $client);
    }

    public function edit($id)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('client', $client);
    }

    public function update($id, UpdateClientRequest $request)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }
        $input =  $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        if ($request->has('profile_photo_path')) {
            $input['profile_photo_path'] = $this->uploadFile($request['profile_photo_path'], 'clients');
        }
        $user = $this->userRepository->update($input,$client['user_id']);
        // $client = User::find($client['id']);
        $client = $this->clientRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    public function destroy($id)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }
        $this->userRepository->delete($client['user_id']);
        $this->clientRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    public function exportExcel()
    {
        $clients = User::where('user_type','client')->get();
        $lang = app()->getLocale();
        if (count($clients) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        return Excel::download(new ExportClient($clients), 'clients.XLSX');
    }
    public function exportPdf()
    {
        $clients = User::all();
        $lang = app()->getLocale();
        if (count($clients) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }

        $pdf = Pdf::loadView('clients.pdf', compact('clients'));
        return $pdf->stream('clients.pdf');
    }
}
