<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class settingsController extends Controller
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
        return Inertia::render("settings", [
            "settings" => $settings,
            "asset" => asset(''),
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
    public function updateSettings(Request $request)
    {
        $request->validate([
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'twitter' => 'required|url',
            'whatsapp' => 'required',
            'phone' => 'required',
            'fix' => 'required',
            'email' => 'required|email',
            'adress' => 'required',
            'content' => 'required',
        ]);

        if ($request->isnew) {
            $created = settings::create([
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'whatsapp' => $request->whatsapp,
                'phone' => $request->phone,
                'fix' => $request->fix,
                'email' => $request->email,
                'adress' => $request->adress,
                'content' => $request->content,
            ]);

            if ($created) {
                return redirect()->back()->withSuccess(["msg" => "Setting created successfully"]);
            } else {
                return redirect()->back()->withError(["msg" => "Somethings went wrong"]);
            }
        } else {
            $sett = settings::find($request->id);

            $updated = $sett->update([
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'whatsapp' => $request->whatsapp,
                'phone' => $request->phone,
                'fix' => $request->fix,
                'email' => $request->email,
                'adress' => $request->adress,
                'content' => $request->content,
            ]);

            if ($updated) {
                return redirect()->back()->withSuccess(["msg" => "Setting updated successfully"]);
            } else {
                return redirect()->back()->withError(["msg" => "Somethings went wrong"]);
            }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
