<?php

namespace App\Http\Controllers;

use App\Models\ourCustomers;
use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class customerController extends Controller
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
        $customers = ourCustomers::all();
        return Inertia::render("customerManagement", [
            "customers" => $customers,
            "asset" => asset(''),
            'licence' =>
            $softlicence,
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
    public function newCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'logo' => 'required'
        ]);

        $created = ourCustomers::create([
            'name' => $request->name,
            'description' => $request->description,
            'picture' => ltrim(Storage::url($request->logo->store("/public/images/customer")), '/')
        ]);

        if ($created) {
            return redirect()->back()->withSuccess(["msg" => "Customer created successfully"]);
        } else {
            return redirect()->back()->withSuccess(["err" => "Somethings went wrong"]);
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
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCustomer(Request $request)
    {

        $request->validate([
            'ename' => 'required',
            'edescription' => 'required',
        ]);

        $etu = ourCustomers::find($request->eid);
        if ($etu->count() > 0) {
            $picture = $etu->picture;
            if ($request->hasFile('elogo')) {
                $picture = ltrim(Storage::url($request->elogo->store("/public/images/customer")), '/');
            }
            $updted = $etu->update([
                'name' => $request->ename,
                'description' => $request->edescription,
                'picture' => $picture
            ]);

            if ($updted) {
                return redirect()->back()->withSuccess(["msg" => "Customer updated successfully"]);
            } else {
                return redirect()->back()->withSuccess(["err" => "Somethings went wrong"]);
            }
        } else {
            return redirect()->back()->withSuccess(["err" => "Customer not found , maybe it's already deleted"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletCustomer(REQUEST $request)
    {

        $customer = ourCustomers::find($request->did);
        if ($customer->count() > 0) {
            $deleted = $customer->delete();
            if ($deleted) {
                return redirect()->back()->withSuccess(["msg" => "Customer deleted successfully"]);
            } else {
                return redirect()->back()->withSuccess(["msg" => "Customer already deleted"]);
            }
        } else {
            return redirect()->back()->withErrors(["msg" => "Customer dosen't exists"]);
        }
    }
}
