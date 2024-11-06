<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\projectAlbum;
use App\Models\projectCategory;
use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class projectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softlicence = softLicence::where("modelRoute", 'like', Route::currentRouteName())->orderBy("created_at")->first();
        $settings = settings::orderBy("created_at", "desc")->first();
        $projects = project::all();
        return Inertia::render("projectManagement", [
            "projects" => $projects,
            "asset" => asset(''),
            "categories" => projectCategory::all(),
            'licence' => $softlicence,
            "settings" => $settings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'gtitle' => 'required',
            'gdescription' => 'required',
            'cover' => 'required|image',
            'ghtmlpart' => 'required',
            'gcategory' => 'required'
        ]);


        $project = project::create([
            'title' => $request->gtitle,
            'description' => $request->gdescription,
            'htmlPart' => $request->ghtmlpart,
            'category_id' => $request->gcategory,
            'cover' => ltrim(Storage::url($request->cover->store("/public/images/intro/")), "/"),
        ]);

        if ($project) {
            if ($request->hasFile("album")) {
                foreach ($request->album as $file) {
                    projectAlbum::create([
                        'project_id' => $project->id,
                        'picture' => ltrim(Storage::url($file->store("/public/image/project/albums")), '/')
                    ]);
                }
            }
            return redirect()->back()->withSuccess(["intro" => $project]);
        } else {
            return redirect()->back()->withErrors(["custom" => "ups , error"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateproject(Request $request)
    {
        $request->validate([
            'egtitle' => 'required',
            'egdescription' => 'required',
            'eghtmlpart' => 'required',
            'egcategory' => 'required',
            'eid' => 'required|integer'
        ]);

        $findProject = project::find($request->eid);

        if ($findProject->count() > 0) {
            $cover = $findProject->cover;

            if ($request->hasFile('ecover')) {
                $cover = ltrim(Storage::url($request->ecover->store("/public/images/intro/")), "/");
            }

            $updated = $findProject->update([
                'title' => $request->egtitle,
                'description' => $request->egdescription,
                'htmlPart' => $request->eghtmlpart,
                'category_id' => $request->egcategory,
                'cover' => $cover,
            ]);

            if ($updated) {
                if ($request->hasFile("ealbum")) {
                    projectAlbum::where("project_id", "like", $findProject->id)->delete();
                    foreach ($request->ealbum as $file) {
                        projectAlbum::create([
                            'project_id' => $findProject->id,
                            'picture' => ltrim(Storage::url($file->store("/public/image/project/albums")), '/')
                        ]);
                    }
                }
                return redirect()->back()->withSuccess(["project" => $updated]);
            } else {
                return redirect()->back()->withErrors(["custom" => "ups , error"]);
            }
        } else {
            return redirect()->back()->withErrors(["custom" => "Error , project not found , maybe it's deleted"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProject(Request $request)
    {
        $request->validate([
            'dpid' => 'required|integer'
        ]);

        $project = project::find($request->dpid);

        if ($project->count() > 0) {
            $deleted = $project->delete();
            if ($deleted) {
                return redirect()->back()->withSuccess(["custom" => "Project deleted successfully"]);
            } else {
                return redirect()->back()->withErrors(["custom" => "Somethings went wrong"]);
            }
        } else {
            return redirect()->back()->withErrors(["custom" => "Error , project not found , maybe it's already deleted"]);
        }
    }
}
