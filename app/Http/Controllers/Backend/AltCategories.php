<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AltCategory;
use App\Models\AltCategoryTranslation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AltCategories extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('alt-categories index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::all();
        $altCategories = AltCategory::all();
        return view('backend.categories.alt.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('alt-categories create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.categories.alt.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('alt-categories create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $category = Category::find($request->category);
            $altCategory = new AltCategory();
            $category->alt()->save($altCategory);
            foreach (active_langs() as $lang) {
                $translation = new AltCategoryTranslation();
                $translation->locale = $lang->code;
                $translation->alt_category_id = $altCategory->id;
                $translation->name = $request->name[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.alt-categories.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.alt-categories.index');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('alt-categories edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $altCategory = AltCategory::find($id);
        return view('backend.categories.alt.edit', get_defined_vars());
    }

    public function update(Request $request, AltCategory $altCategory)
    {
        abort_if(Gate::denies('alt-categories edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $altCategory) {
                $altCategory->category_id = $request->category;
                foreach (active_langs() as $lang) {
                    $altCategory->translate($lang->code)->name = $request->name[$lang->code];
                }
                $altCategory->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.alt-categories.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.alt-categories.index'));
        }
    }

    public function altCategoryStatus($id)
    {
        abort_if(Gate::denies('alt-categories edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = AltCategory::where('id', $id)->value('status');
        if ($status == 1) {
            AltCategory::where('id', $id)->update(['status' => 0]);
        } else {
            AltCategory::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.alt-categories.index');
    }

    public function delAltCategory($id)
    {
        abort_if(Gate::denies('alt-categories delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            AltCategory::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.alt-categories.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.alt-categories.index');
        }
    }
}
