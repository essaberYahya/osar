<?php

namespace App\Http\Controllers;

use App\Models\rowSecData;
use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class rowSectionController extends Controller
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
        $rowSections = rowSecData::all();
        return Inertia::render("rowsectionsmanagement", [
            'rowssections' => $rowSections,
            'asset' => asset(''),
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
        /**
         *  $table->text("title");
            $table->text("description");
            $table->text("picture");
            $table->text("htmlPart");
            $table->boolean("leftToRight")->default(0);
         */
        $request->validate([
            'gtitle' => 'required',
            'gdescription' => 'required',
            'picture' => 'required|image',
            'ghtmlpart' => 'required',
        ]);

        $created = rowSecData::create([

            'title' => $request->gtitle,
            'description' => $request->gdescription,
            'picture' => ltrim(Storage::url($request->picture->store("/public/images/rowsection/")), '/'),
            'htmlPart' => $request->ghtmlpart,
            'leftToRight' => $request->leftToRight
        ]);

        if ($created) {
            return redirect()->back()->withSuccess(["intro" => $created]);
        } else {
            return redirect()->back()->withErrors(["msg" => "Oops , somethings went wrong during process"]);
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
    public function update(Request $request)
    {
        $request->validate([
            'egtitle' => 'required',
            'egdescription' => 'required',
            'eghtmlpart' => 'required',
            'eleftToRight' => 'required',
            'rsid' => 'required|integer'
        ]);

        $rowsection = rowSecData::find($request->rsid);

        if ($rowsection->count() > 0) {
            if ($request->hasFile('epicture')) {
                $picture = ltrim(Storage::url($request->epicture->store("/public/images/rowsection/")), "/");
            } else {
                $picture = $rowsection->picture;
            }

            $updated = $rowsection->update([
                'title' => $request->egtitle,
                'description' => $request->egdescription,
                'htmlPart' => $request->eghtmlpart,
                'leftToRight' => $request->eleftToRight,
                'picture' => $picture
            ]);

            if ($updated) {
                return redirect()->back()->withSuccess(["rowsection" => $updated]);
            } else {
                return redirect()->back()->withErrors(["custom" => "ups , error"]);
            }
        } else {
            return redirect()->back()->withErrors(["custom" => "Oops , row section not found maybe it's deleted"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRowService(REQUEST $request)
    {
        $request->validate([
            'drsid' => 'required|integer'
        ]);

        $rowsection = rowSecData::find($request->drsid);

        if ($rowsection->count() > 0) {
            $deleted = $rowsection->delete();
            if ($deleted) {
                return redirect()->back()->withSuccess(["custom" => "Row section deleted successfully"]);
            } else {
                return redirect()->back()->withErrors(["custom" => "Somethings went wrong"]);
            }
        } else {
            return redirect()->back()->withErrors(["custom" => "Error , Row section not found , maybe it's already deleted"]);
        }
    }
}
