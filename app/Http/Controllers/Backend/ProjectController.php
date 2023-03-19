<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectPhoto;
use App\Models\ProjectTranslation;
use Exception;
use Google\Service\Dataflow\Resource\ProjectsTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('projects index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = Project::all();
        return view('backend.projects.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('projects create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.projects.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('projects create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $project = new Project();
            $project->status = 1;
            $project->save();
            foreach (active_langs() as $active_lang) {
                $translate = new ProjectTranslation();
                $translate->locale = $active_lang->code;
                $translate->project_id = $project->id;
                $translate->title = $request->title[$active_lang->code];
                $translate->content1 = $request->content1[$active_lang->code];
                $translate->content2 = $request->content2[$active_lang->code];
                $translate->content3 = $request->content3[$active_lang->code];
                $translate->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.projects.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.projects.index');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('projects edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $project = Project::find($id);
        return view('backend.projects.edit', get_defined_vars());
    }

    public function update(Request $request, Project $project)
    {
        abort_if(Gate::denies('projects edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $project) {
                if ($request->hasFile('photos')) {
                    foreach ($project->images as $img) {
                        unlink(public_path('images/' . $img->photo));
                    }
                    $project->images()->delete();
                    foreach (multi_upload('projects', $request->file('photos')) as $image) {
                        $projectPhoto = new ProjectPhoto();
                        $projectPhoto->photo = $image;
                        $project->images()->save($projectPhoto);
                    }
                }
                foreach (active_langs() as $lang) {
                    $project->translate($lang->code)->title = $request->title[$lang->code];
                    $project->translate($lang->code)->content1 = $request->content1[$lang->code];
                    $project->translate($lang->code)->content2 = $request->content2[$lang->code];
                    $project->translate($lang->code)->content3 = $request->content3[$lang->code];
                }
                $project->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.projects.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.projects.index'));
        }
    }

    public function projectStatus($id)
    {
        abort_if(Gate::denies('projects edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = Project::where('id', $id)->value('status');
        if ($status == 1) {
            Project::where('id', $id)->update(['status' => 0]);
        } else {
            Project::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.projects.index');
    }

    public function delProject($id)
    {
        abort_if(Gate::denies('projects delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $project = Project::find($id);
            foreach ($project->images as $img) {
                unlink(public_path('images/' . $img->photo));
            }
            $project->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.projects.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.projects.index');
        }
    }
}
