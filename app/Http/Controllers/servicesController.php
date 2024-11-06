<?php

namespace App\Http\Controllers;

use App\Models\ourServices;
use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class servicesController extends Controller
{
    public function index()
    {
        $softlicence = softLicence::where("modelRoute", 'like', Route::currentRouteName())->orderBy("created_at")->first();
        $settings = settings::orderBy("created_at", "desc")->first();
        return Inertia::render("servicesmanagement", [
            "services" => ourServices::all(),
            "asset" => asset(''),
            'licence' => $softlicence,
            "settings" => $settings
        ]);
    }

    public function store(REQUEST $request)
    {
        // dd($request);

        $request->validate([
            'icon' => 'required|image',
            'title' => 'required',
            'description' => 'required',
        ]);

        $saved = ourServices::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => ltrim(Storage::url($request->icon->store("public/images/services")), '/'),
            'color' => $request->color
        ]);

        if ($saved) {
            return redirect()->back()->withSuccess(["msg" => "service added successfully"]);
        } else {
            return redirect()->back()->withErrors(["err" => "Somethings wen wrong"]);
        }
    }

    public function updateservice(REQUEST $request)
    {

        $request->validate([
            'eicon' => 'required|image',
            'etitle' => 'required',
            'edescription' => 'required',
            'ecolor' => 'required',
            'eid' => 'required'
        ]);


        $service = ourServices::find($request->eid);
        if ($service->count() > 0) {
            $updated = $service->update([
                'title' => strtoupper($request->etitle),
                'description' => $request->edescription,
                'icon' => ltrim(Storage::url($request->eicon->store("public/images/services")), '/'),
                'color' => $request->ecolor
            ]);

            if ($updated) {
                return redirect()->back()->withSuccess(["msg" => "service updated successfully"]);
            } else {
                return redirect()->back()->withErrors(["err" => "Somethings wen wrong"]);
            }
        } else {
            return redirect()->back()->withErrors(["err" => "Service not found , maybe it's already deleted"]);
        }
    }

    public function deleteervice(REQUEST $request)
    {
        $service = ourServices::find($request->dsid);
        if ($service->count() > 0) {
            $deleted = $service->delete();
            return redirect()->back()->withSuccess(["msg" => "service deleted successfully"]);
        } else {
            return redirect()->back()->withErrors(["msg" => "service dosen't exists"]);
        }
    }
}
