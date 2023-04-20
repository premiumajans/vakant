<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PharIo\Version\Exception;
use Symfony\Component\HttpFoundation\Response;

class TermController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('term index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $term = Term::first();
        return view('backend.term.index', get_defined_vars());
    }


    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('term edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $term = Term::find($id);
            foreach (active_langs() as $lang){
                $term->translate($lang->code)->description = $request->description[$lang->code];
                $term->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.term.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.term.index'));
        }
    }
}
