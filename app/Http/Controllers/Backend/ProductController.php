<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AltCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('products index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $products = Product::all();
        return view('backend.products.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('products create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $altCategories = AltCategory::where('category_id', (Category::first()->id))->get();
        return view('backend.products.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('products create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $product = new Product();
            $product->photo = upload('products', $request->file('photo'));
            $product->category_id = $request->category;
            $product->alt_category_id = $request->altCategory;
            $product->save();
            foreach (active_langs() as $active_lang) {
                $translation = new ProductTranslation();
                $translation->name = $request->name[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->product_id = $product->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.products.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.products.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('products edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product = Product::find($id);
        $altCategories = AltCategory::where('category_id', $product->category_id)->get();
        return view('backend.products.edit', get_defined_vars());
    }

    public function update(Request $request, Product $product)
    {
        abort_if(Gate::denies('products edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $product) {
                $product->category_id = $request->category;
                $product->alt_category_id = $request->altCategory;
                if ($request->hasFile('photo')) {
                    unlink(public_path($product->photo));
                    $product->photo = upload('products', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $product->translate($lang->code)->name = $request->name[$lang->code];
                    $product->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $product->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.products.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.products.index'));
        }
    }

    public function changeCategory(Request $request)
    {
        abort_if(Gate::denies('products edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $altCategories = AltCategory::where('category_id', $request->category_id)->get();
        $html = '<select name="altCategory" id="altCategory" class="form-control">';
        foreach ($altCategories as $al) {
            $html .= '<option value="' . $al->id . '">' . $al->translate('az')->name . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public function delProduct($id)
    {
        abort_if(Gate::denies('products delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Product::find($id)->photo);
            Product::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }
}
