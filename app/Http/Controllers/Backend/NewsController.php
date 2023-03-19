<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('news index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $news = News::all();
        return view('backend.news.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('news create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.news.create');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('news edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $news = News::find($id);
        return view('backend.news.edit', get_defined_vars());
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('news create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $news = new News();
            $news->photo = upload('news', $request->file('photo'));
            $news->save();
            foreach (active_langs() as $active_lang) {
                $translate = new NewsTranslation();
                $translate->locale = $active_lang->code;
                $translate->news_id = $news->id;
                $translate->title = $request->title[$active_lang->code];
                $translate->content1 = $request->content1[$active_lang->code];
                $translate->content2 = $request->content2[$active_lang->code];
                $translate->content3 = $request->content3[$active_lang->code];
                $translate->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.about.news.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.about.news.index');
        }
    }

    public function update(Request $request, News $news)
    {
        abort_if(Gate::denies('news edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $news) {
                if ($request->hasFile('photo')) {
                    unlink((public_path($news->photo)));
                    $news->photo = upload('news', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $news->translate($lang->code)->title = $request->title[$lang->code];
                    $news->translate($lang->code)->content1 = $request->content1[$lang->code];
                    $news->translate($lang->code)->content2 = $request->content2[$lang->code];
                    $news->translate($lang->code)->content3 = $request->content3[$lang->code];
                }
                $news->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.about.news.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.about.news.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('news delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            News::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.about.news.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.about.news.index');
        }
    }

}
