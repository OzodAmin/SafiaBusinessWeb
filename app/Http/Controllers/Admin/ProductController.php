<?php

namespace App\Http\Controllers\Admin;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\Filling;
use App\Models\Category;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Cover;
use App\Models\Cream;
use App\Models\Decor;
use App\Models\Base;
use App\Models\Size;
use Response;
use Flash;
use Lang;
use App;

class ProductController extends AppBaseController
{
    private $repository;

    public function __construct(ProductRepository $repo)
    {
        $this->repository = $repo;
        $this->defaultLocale = 'ru';
        App::setLocale($this->defaultLocale);
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $products = $this->repository->paginate(20);

        return view('admin.products.index')->with('products', $products);
    }

    public function create()
    {
        $categories = Category::withTranslation()->get();
        $categoriesArray = [];
        foreach($categories as $item) {
            $categoriesArray[$item->id] = $item->title;
        }

        $measures = Measure::withTranslation()->get();
        $measureArray = [];
        foreach($measures as $item) {
            $measureArray[$item->id] = $item->title_short;
        }

        $bases = Base::withTranslation()->get();
        $baseArray = [];
        foreach($bases as $item) {
            $baseArray[$item->id] = $item->title;
        }

        $covers = Cover::withTranslation()->get();
        $coverArray = [];
        foreach($covers as $item) {
            $coverArray[$item->id] = $item->title;
        }

        $creams = Cream::withTranslation()->get();
        $creamArray = [];
        foreach($creams as $item) {
            $creamArray[$item->id] = $item->title;
        }

        $decors = Decor::withTranslation()->get();
        $decorArray = [];
        foreach($decors as $item) {
            $decorArray[$item->id] = $item->title;
        }

        $fillings = Filling::withTranslation()->get();
        $fillingArray = [];
        foreach($fillings as $item) {
            $fillingArray[$item->id] = $item->title;
        }

        $size = Size::get();
        $sizeArray = [];
        foreach($size as $item) {
            $sizeArray[$item->id] = $item->title;
        }

        return view('admin.products.create', 
            compact(['categoriesArray', 'baseArray', 'coverArray', 'creamArray', 'decorArray', 'fillingArray', 'sizeArray', 'measureArray']));
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();

        $request->merge([
            'user_id' => auth()->id()
        ]);

        $product->fill($request->all());

        if ($request->hasFile('featured_image')) {
            $product->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $product->save();
        $product->bases()->attach($request->base_id);
        $product->covers()->attach($request->cover_id);
        $product->creams()->attach($request->cream_id);
        $product->decors()->attach($request->decor_id);
        $product->fillings()->attach($request->filling_id);

        Flash::success('Product saved successfully.');

        return redirect(route('products.index'));
    }

    public function edit($id)
    {
        $product = $this->repository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $measures = Measure::withTranslation()->get();
        $measureArray = [];
        foreach($measures as $item) {
            $measureArray[$item->id] = $item->title_short;
        }

        $categories = Category::withTranslation()->get();
        $categoriesArray = [];
        foreach($categories as $item) {
            $categoriesArray[$item->id] = $item->title;
        }

        $bases = Base::withTranslation()->get();
        $baseArray = [];
        foreach($bases as $item) {
            $baseArray[$item->id] = $item->title;
        }

        $covers = Cover::withTranslation()->get();
        $coverArray = [];
        foreach($covers as $item) {
            $coverArray[$item->id] = $item->title;
        }

        $creams = Cream::withTranslation()->get();
        $creamArray = [];
        foreach($creams as $item) {
            $creamArray[$item->id] = $item->title;
        }

        $decors = Decor::withTranslation()->get();
        $decorArray = [];
        foreach($decors as $item) {
            $decorArray[$item->id] = $item->title;
        }

        $fillings = Filling::withTranslation()->get();
        $fillingArray = [];
        foreach($fillings as $item) {
            $fillingArray[$item->id] = $item->title;
        }

        $size = Size::get();
        $sizeArray = [];
        foreach($size as $item) {
            $sizeArray[$item->id] = $item->title;
        }

        $productBases = $product->bases->pluck('id')->all();
        $productCovers = $product->covers->pluck('id')->all();
        $productCreams = $product->creams->pluck('id')->all();
        $productDecors = $product->decors->pluck('id')->all();
        $productFillings = $product->fillings->pluck('id')->all();

        // echo "<pre>"; 
        // echo "productBases";    print_r($productBases);
        // echo "productCovers";   print_r($productCovers);
        // echo "productCreams";   print_r($productCreams);
        // echo "productDecors";   print_r($productDecors);
        // echo "productFillings"; print_r($productFillings);
        // die("###");

        return view('admin.products.edit',
            compact(['product', 'categoriesArray', 'baseArray', 'coverArray', 'creamArray', 'decorArray', 'fillingArray', 'sizeArray', 'measureArray',
                'productBases', 'productCovers', 'productCreams', 'productDecors', 'productFillings']));
    }

    public function update($id, ProductRequest $request)
    {
        $product = $this->repository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $product->fill($request->except(['clear_image', 'featured_image']));

        if($request->has('clear_image')) {
            $this->removePhoto( $product->featured_image );
            $product->featured_image = '';
        }

        if ($request->hasFile('featured_image')) {
            $product->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $product->save();
        $product->bases()->sync($request->base_id);
        $product->covers()->sync($request->cover_id);
        $product->creams()->sync($request->cream_id);
        $product->decors()->sync($request->decor_id);
        $product->fillings()->sync($request->filling_id);

        Flash::success('Product updated successfully.');
        return redirect(route('products.index'));
    }

    public function destroy($id)
    {
        $product = $this->repository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $this->repository->delete($id);
        $this->removePhoto( $product->featured_image );

        $product->bases()->detach();
        $product->bases()->detach();
        $product->covers()->detach();
        $product->creams()->detach();
        $product->decors()->detach();
        $product->fillings()->detach();

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    protected function uploadPhoto(UploadedFile $file) {

        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $image_name = str_slug($base_name, '_').'_'.time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('uploads/product/'), $image_name);

        Image::make(public_path('uploads/product/').$image_name)
            ->fit(100)
            ->save(public_path('uploads/product/').'admin_'.$image_name);

        Image::make(public_path('uploads/product/').$image_name)
            ->fit(720, 960)
            ->save(public_path('uploads/product/').'thumb_'.$image_name);

        Image::make(public_path('uploads/product/').$image_name)
            ->fit(1200, 1600)
            ->save(public_path('uploads/product/').'icon_'.$image_name);

        return $image_name;
    }

    protected function removePhoto( $image_name ) {

        if( !empty($image_name) ) {

            unlink( public_path('uploads/product/').$image_name );
            unlink( public_path('uploads/product/admin_').$image_name );
            unlink( public_path('uploads/product/thumb_').$image_name );
            unlink( public_path('uploads/product/icon_').$image_name );
        }
    }
}
