<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductImagesRequest;
use App\Repositories\ProductRepository;
use Flash;
use App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use App\Models\ProductOptionKey;
use App\Http\Controllers\AppBaseController;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportProduct;
use Response;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImages;
use App\Traits\UploadTrait;

class ProductController extends AppBaseController
{
    use UploadTrait;
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }
    public function index(ProductDataTable $productDataTable, Request $request)
    {
        $category_id = $request->input('id');

        //  dd($options);
        return $productDataTable->with('id', $request->input('id'))
            ->render('products.index', compact('category_id'));
        // return $productDataTable->render('products.index');
    }

    public function create(Request $request)
    {
        // $categories = Category::where('parent_id' , null)->pluck('name' , 'id');
        $category_id = $request->category_id;
        $options = Option::all()->pluck('name', 'id');
        return view('products.create', compact('category_id', 'options'));
    }


    public function store(CreateProductRequest $request)
    {
        $category_id = $request->category_id;
        $input = $request->all();
        if ($request->has('image_path')) {
            $input['image_path'] = $this->uploadFile($request['image_path'], 'categories/products');
        }
        $product = $this->productRepository->create($input);
        $product_option = ProductOptionKey::create([
            'product_id' => $product->id,
            'option_key_id' => $request->option_key_id,
            'price' => $request->option_price,
            'quantity' => $request->option_quantity,
        ]);

        Flash::success(__('messages.saved', ['model' => __('models/products.singular')]));

        return redirect(route('products.index', ['id' => $category_id]));
    }


    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }


    public function edit($id)
    {
        // $category_id= $request->category_id;

        $product = $this->productRepository->find($id);
        $category_id = $product->category_id;

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('products.index'));
        }
        $options = Option::all()->pluck('name', 'id');

        return view('products.edit', compact('category_id', 'options'))->with(['product' => $product, 'category_id' => $category_id]);
    }


    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('products.index'));
        }
        $input = $request->all();
        if ($request->has('image_path') && $request->image_path != null) {
            $product['image_path'] ? $this->deleteFile($product['image_path'], 'categories/products') : null;
            $input['image_path'] = $this->uploadFile($request['image_path'], 'categories/products');
        } else if ($request->image_path == null) {
            $input['image_path'] = $product->image_path;
        }
        $product = $this->productRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/products.singular')]));

        return redirect(route('products.index', ['id' => $request->category_id]));
    }


    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/products.singular')]));

        return redirect(route('products.index'));
    }

    public function exportPdf(Request $request)
    {
        $category_id = $request->input('category_id');
        $products = Product::where('category_id', $category_id)->get();
        $lang = app()->getLocale();
        foreach ($products  as $value) {
            $name = $value->toArray();
            if ($value->discount_type == 1) {
                $value->status = $lang == 'ar' ? 'نسبة' :  'Ratio';
            } else {
                $value->status = $lang == 'ar' ? 'قيمة'  :  'amount';
            }
        }
        //    dd($);
        if (count($products) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }

        $pdf = PDF::loadView('products.pdf', compact('products'));
        return $pdf->stream('products.pdf');
    }
    public function exportExcel(Request $request)
    {
        $category_id = $request->input('category_id');
        $products = Product::where('category_id', $category_id)->get();
        $lang = app()->getLocale();
        //    dd(count($products) );
        if (count($products) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        return Excel::download(new ExportProduct($products), 'products.XLSX');
    }
    public function getOptionKey(Request $request)
    {
        $product_id = $request->id;
        $product = $this->productRepository->find($product_id);
        $category_id = $product->category_id;
        $product_option = ProductOptionKey::where('product_id', $request->id)->with('optionKey.option')->get();
        $options = Option::all()->pluck('name', 'id');
        // dd($options);
        return view('products.OptionKey')->with(['category_id' => $category_id, 'options' => $options, 'product_options' => $product_option, 'product_id' => $product_id]);
    }
    public function productOption(Request $request)
    {

        $lang = app()->getLocale();
        $product_option = ProductOptionKey::create([
            'product_id' => $request->product_id,
            'option_key_id' => $request->option_key_id,
            'price' => $request->option_price,
            'quantity' => $request->option_quantity,
        ]);

        Flash::success(__('option saved', ['model' => __('models/products.singular')]));
        // $message = $lang=='en'?'option adeded succssesfully':'تم اضاقة الخيار بنجاح';
        return redirect()->back();
    }

    public function updateProductOption(Request $request)
    {


        $ProductOptionKey = ProductOptionKey::find($request->id);

        if (empty($ProductOptionKey)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect()->back();
        }

        $ProductOptionKey->update($request->all());

        Flash::success(__('messages.updated', ['model' => __('models/products.singular')]));
        return redirect()->back();
    }


    public function OptionDestroy($id)
    {
        $lang = app()->getLocale();

        $ProductOptionKey = ProductOptionKey::find($id);

        if (empty($ProductOptionKey)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect()->back();
        }
        $ProductOptionKey->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/products.singular')]));
        // $message = $lang=='en'?'Image deleted succssesfully':'تم حذف الصورة بنجاح';
        return redirect()->back();
    }
}
