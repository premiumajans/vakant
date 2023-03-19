<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class FAQController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('faq index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faqs = Faq::all();
        return view('backend.faq.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('faq create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.faq.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('faq create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $faq = new Faq();
            $faq->status = 1;
            $faq->save();
            foreach (active_langs() as $lang) {
                $translation = new FaqTranslation();
                $translation->title = $request->title[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->locale = $lang->code;
                $translation->faq_id = $faq->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.faq.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.faq.index'));
        }
    }

    public function delFAQ($id)
    {
        abort_if(Gate::denies('faq delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Faq::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.faq.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.faq.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('faq edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faq = Faq::find($id);
        return view('backend.faq.edit', get_defined_vars());
    }

    public function update(Request $request, Faq $faq)
    {
        abort_if(Gate::denies('faq edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $faq) {
                foreach (active_langs() as $lang) {
                    $faq->translate($lang->code)->title = $request->title[$lang->code];
                    $faq->translate($lang->code)->description = $request->description[$lang->code];
                }
                $faq->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.faq.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.faq.index'));
        }
    }

    public function faqStatus($id)
    {
        abort_if(Gate::denies('statistics edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = Faq::where('id', $id)->value('status');
        if ($status == 1) {
            Faq::where('id', $id)->update(['status' => 0]);
        } else {
            Faq::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.faq.index');
    }
}
