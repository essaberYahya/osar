<?php

namespace App\Http\Controllers;

use App\Models\projectCategory;
use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class categoriesController extends Controller
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
        $categories = projectCategory::all();
        return Inertia::render("categoriesManagement", [
            "categories" => $categories,
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
    public function newCategory(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'description' => 'required',
            'color' => 'required'
        ]);

        $saved = projectCategory::create([
            'name' => strtoupper($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
            'color' => $request->color
        ]);

        if ($saved) {
            return redirect()->back()->withSuccess(["msg" => "Category added successfully"]);
        } else {
            return redirect()->back()->withErrors(["err" => "Somethings wen wrong"]);
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
    public function updateCategory(Request $request)
    {
        $request->validate([
            'eicon' => 'required',
            'ename' => 'required',
            'edescription' => 'required',
            'ecolor' => 'required',
            'eid' => 'required'
        ]);


        $category = projectCategory::find($request->eid);
        if ($category->count() > 0) {
            $updated = $category->update([
                'name' => strtoupper($request->ename),
                'description' => $request->edescription,
                'icon' => $request->eicon,
                'color' => $request->ecolor
            ]);

            if ($updated) {
                return redirect()->back()->withSuccess(["msg" => "Category updated successfully"]);
            } else {
                return redirect()->back()->withErrors(["err" => "Category wen wrong"]);
            }
        } else {
            return redirect()->back()->withErrors(["err" => "Category not found , maybe it's already deleted"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletCategory(REQUEST $request)
    {
        $request->validate(["did" => "required|integer"]);
        $category = projectCategory::find($request->did);
        if ($category->count() > 0) {
            $deleted = $category->delete();
            return redirect()->back()->withSuccess(["msg" => "category deleted successfully"]);
        } else {
            return redirect()->back()->withErrors(["msg" => "category dosen't exists"]);
        }
    }
}
