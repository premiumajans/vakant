<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\SiteLanguage;
use App\Models\Slider;
use App\Models\SliderTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('slider index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sliders = Slider::orderBy('order')->get();
        return view('backend.slider.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('slider create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        checkPermission('slider create');
        try {
            $languages = SiteLanguage::where('status', 1)->get();
            $slider = new Slider();
            if (empty(Slider::first())) {
                $sliderOrder = 1;
            } else {
                $sliderOrder = Slider::all()->last()->order + 1;
            }
            $slider->photo = upload('sliders', $request->file('photo'));
            $slider->order = $sliderOrder;
            $slider->status = 1;
            $slider->save();
            foreach ($languages as $lan) {
                $translation = new SliderTranslation();
                $translation->locale = $lan->code;
                $translation->title = $request->title[$lan->code];
                $translation->description = $request->description[$lan->code];
                $translation->alt = $request->alt[$lan->code];
                $translation->slider_id = $slider->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function update(Request $request, Slider $slider)
    {
        checkPermission('slider edit');
        try {
            DB::transaction(function () use ($request, $slider) {
                if ($request->hasFile('photo')) {
                    $slider->photo = upload('sliders', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $slider->translate($lang->code)->title = $request->title[$lang->code];
                    $slider->translate($lang->code)->alt = $request->alt[$lang->code];
                    $slider->translate($lang->code)->description = $request->description[$lang->code];
                }
                $slider->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function edit(Slider $slider)
    {
        checkPermission('slider edit');
        return view('backend.slider.edit', get_defined_vars());
    }

    public function delSlider($id)
    {
        checkPermission('slider delete');
        try {
            unlink(Slider::find($id)->photo);
            Slider::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.slider.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.slider.index');
        }
    }

    public function sliderOrder(Request $request, $id)
    {
        checkPermission('slider edit');
        try {
            $slider = Slider::find($id);
            $orders = [];
            foreach (Slider::orderBy('order', 'asc')->get() as $sl) {
                $orders[] = $sl->order;
            }
            if ($request->direction == "up") {
                $prevKey = (array_search($slider->order, $orders)) - 1;
                Slider::where('order', $orders[$prevKey])->update([
                    'order' => $slider->order,
                ]);
                $slider->update(['order' => $orders[$prevKey]]);
            } else {
                if ($slider->order == end($orders)) {
                    Slider::where('order', $orders[count($orders) - 2])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[count($orders) - 2]]);
                } elseif ($slider->order == $orders[0]) {
                    Slider::where('order', $orders[1])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[1]]);
                } else {
                    $nextKey = (array_search($slider->order, $orders)) + 1;
                    Slider::where('order', $orders[$nextKey])->update([
                        'order' => $orders[$nextKey - 1],
                    ]);
                    $slider->update(['order' => $orders[$nextKey]]);
                }
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function sliderStatus($id)
    {
        checkPermission('slider edit');
        return CRUDHelper::status('\App\Models\Slider', $id);
    }
}
