<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportCategory;
use App\Traits\UploadTrait;

class CategoryController extends AppBaseController
{

    use UploadTrait;
    /** @var CategoryRepository $categoryRepository*/
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     *
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        if ($request->has('image_path')) {
            $input['image_path'] = $this->uploadFile($request['image_path'], 'categories');
        }
        $category = $this->categoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/categories.singular')]));

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $category = $this->categoryRepository->find($id);
        $categories = Category::where('parent_id', $id)->get();

        if (empty($categories)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categories', $categories);
    }


    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));
            return redirect(route('categories.index'));
        }
        return view('categories.edit')->with(['category' => $category]);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);
        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('categories.index'));
        }
        $input = $request->all();
        if ($request->has('image_path') && $request->image_path != null) {
            $this->deleteFile($category['image_path'], 'categories');
            $input['image_path'] = $this->uploadFile($request['image_path'], 'categories');
        }else if ($request->image_path == null) {
            $input['image_path'] = $category->image_path;
        }
        $category = $this->categoryRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/categories.singular')]));

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('categories.index'));
        }
        $this->deleteFile($category['image'], 'categories');

        $this->categoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/categories.singular')]));

        return redirect(route('categories.index'));
    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $category = Category::find($request['id']);
            $category['active'] = $category['active'] ? 0: 1;
            $category->save();
            return $this->ApiResponse('success', '', $category['active']);
        }
    }

    public function exportPdf()
    {
        $categories = Category::all();
        $lang = app()->getLocale();
        foreach ($categories  as $value) {
            $name = $value->toArray();
            //  dd($name['title']['ar']);
            $value->categor_name = $lang == 'ar' ? $name['name']['ar'] :  $name['name']['en'];
            if ($value->active == 1) {
                $value->status = $lang == 'ar' ? 'نشط' :  'active';
            } else {
                $value->status = $lang == 'ar' ? 'غير نشط'  :  'not active';
            }
        }
        if (count($categories) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        // dd($categories);
        $pdf = PDF::loadView('categories.pdf', compact('categories'));
        return $pdf->stream('categories.pdf');
    }
    public function exportExcel()
    {
        $categories = Category::all();
        $lang = app()->getLocale();
        foreach ($categories  as $value) {
            if ($value->active == 1) {
                $value->status = $lang == 'ar' ? 'نشط' :  'active';
            } else {
                $value->status = $lang == 'ar' ? 'غير نشط'  :  'not active';
            }
        }
        if (count($categories) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        // dd($categories);
        return Excel::download(new ExportCategory($categories), 'categories.XLSX');
    }
}
