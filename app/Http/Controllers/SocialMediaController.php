<?php

namespace App\Http\Controllers;

use App\DataTables\SocialMediaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSocialMediaRequest;
use App\Http\Requests\UpdateSocialMediaRequest;
use App\Repositories\SocialMediaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Traits\UploadTrait;
use Response;

class SocialMediaController extends AppBaseController
{
    use UploadTrait;

    /** @var SocialMediaRepository $socialMediaRepository*/
    private $socialMediaRepository;

    public function __construct(SocialMediaRepository $socialMediaRepo)
    {
        $this->socialMediaRepository = $socialMediaRepo;
    }

    /**
     * Display a listing of the SocialMedia.
     *
     * @param SocialMediaDataTable $socialMediaDataTable
     *
     * @return Response
     */
    public function index(SocialMediaDataTable $socialMediaDataTable)
    {
        return $socialMediaDataTable->render('social_media.index');
    }

    /**
     * Show the form for creating a new SocialMedia.
     *
     * @return Response
     */
    public function create()
    {
        return view('social_media.create');
    }

    /**
     * Store a newly created SocialMedia in storage.
     *
     * @param CreateSocialMediaRequest $request
     *
     * @return Response
     */
    public function store(CreateSocialMediaRequest $request)
    {
        $input = $request->all();

        if ($request->has('icon')) {
            $input['icon'] = $this->uploadFile($request['icon'], 'socialMediaIcons');
        }
        $socialMedia = $this->socialMediaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/socialMedia.singular')]));

        return redirect(route('socialMedia.index'));
    }

    /**
     * Display the specified SocialMedia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $socialMedia = $this->socialMediaRepository->find($id);

        if (empty($socialMedia)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialMedia.singular')]));

            return redirect(route('socialMedia.index'));
        }
        return view('social_media.show')->with('socialMedia', $socialMedia);
    }

    /**
     * Show the form for editing the specified SocialMedia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $socialMedia = $this->socialMediaRepository->find($id);

        if (empty($socialMedia)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialMedia.singular')]));

            return redirect(route('socialMedia.index'));
        }

        return view('social_media.edit')->with('socialMedia', $socialMedia);
    }

    /**
     * Update the specified SocialMedia in storage.
     *
     * @param int $id
     * @param UpdateSocialMediaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocialMediaRequest $request)
    {
        $socialMedia = $this->socialMediaRepository->find($id);

        if (empty($socialMedia)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialMedia.singular')]));

            return redirect(route('socialMedia.index'));
        }

        if ($request->has('icon')) {
            $this->deleteFile($socialMedia['icon'], 'socialMediaIcons');

            $input['icon'] = $this->uploadFile($request['icon'], 'socialMediaIcons');
        }
        $socialMedia = $this->socialMediaRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/socialMedia.singular')]));

        return redirect(route('socialMedia.index'));
    }

    /**
     * Remove the specified SocialMedia from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $socialMedia = $this->socialMediaRepository->find($id);

        if (empty($socialMedia)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialMedia.singular')]));

            return redirect(route('socialMedia.index'));
        }
        $this->deleteFile($socialMedia['icon'], 'socialMediaIcons');

        $this->socialMediaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/socialMedia.singular')]));

        return redirect(route('socialMedia.index'));
    }
}
