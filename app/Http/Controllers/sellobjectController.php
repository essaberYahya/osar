<?php

namespace App\Http\Controllers;

use App\Models\projectAlbum;
use App\Models\projectCategory;
use App\Models\sellObject;
use App\Models\sellObjectAlbum;
use App\Models\sellObjectPricing;
use App\Models\settings;
use App\Models\softLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class sellobjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softlicence = softLicence::where("modelRoute", 'like', Route::currentRouteName())->orderBy("created_at")->first();
        $sells = sellObject::paginate(20);
        $categories = projectCategory::all();
        $settings = settings::orderBy("created_at", "desc")->first();
        return Inertia::render("sellObject", [
            'asset' => asset(''),
            'licence' => $softlicence,
            'sells' => $sells,
            'categories' => $categories,
            "settings" => $settings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newsellobject(Request $request)
    {
        /**
         *  $table->text("title");
            $table->text("description");
            $table->text("htmlPart");
            $table->text("pictureCover");
            $table->integer("category_id")->unsigned();
            $table->date("startAt");
            $table->date("EndDate");
         */

        $request->validate([
            'gtitle' => 'required',
            'gdescription' => 'required',
            'cover' => 'required|image',
            'category' => 'required',

        ]);

        $created = sellObject::create([
            'title' => $request->gtitle,
            'description' => $request->gdescription,
            'htmlPart' => $request->ghtmlpart,
            'pictureCover' => ltrim(Storage::url($request->cover->store("public/images/sellobject")), '/'),
            'category_id' => $request->category,
            'startAt' => $request->startat,
            'EndDate' => $request->endat,
        ]);

        if ($request->hasFile('album')) {
            foreach ($request->album as $alb) {
                sellObjectAlbum::create([
                    'objectSellId' => $created->id,
                    'path' => ltrim(Storage::url($alb->store('public/images/sellobject/albums')), '/')
                ]);
            }
        }

        if ($created) {
            return redirect()->back()->withSuccess(["msg" => "Sell object e-learning saved successfully"]);
        } else {
            return redirect()->back()->withErrors(["msg" => "Somethings went wrong"]);
        }
    }


    public function newpps(REQUEST $request)
    {

        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'price' => 'required|integer',
            'objectid' => 'required|integer',
            'description' => 'required'
        ]);

        $saved = sellObjectPricing::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
            'price' => $request->price,
            'object_id' => $request->objectid,
        ]);


        if ($saved) {
            return  redirect()->back()->withSuccess($saved);
        } else {
            return redirect()->back()->withErrors(["msg" => "Oops , Somethings went wrong ... "]);
        }
    }

    public function deletepp(REQUEST $request)
    {
        $request->validate(['objectid' => 'required|integer']);
        $object = sellObjectPricing::find($request->objectid);
        if ($object->count() > 0) {
            $deleted = $object->delete();
            if ($deleted) {
                return redirect()->back()->withSuccess('Deleted successfully');
            } else {
                return redirect()->back()->withErrors('Oops , Somethings went wrong');
            }
        } else {
            return redirect()->back()->withErrors('Oops , Object to delete not found');
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
    public function updateellobject(Request $request)
    {
        $request->validate([
            'egtitle' => 'required',
            'egdescription' => 'required',
            'ecategory' => 'required',
            'eid' => 'required'
        ]);

        $object = sellObject::find($request->eid);
        if ($object->count() > 0) {
            $cover = $object->pictureCover;
            if ($request->hasFile('ecover')) {
                $cover = ltrim(Storage::url($request->ecover->store('/public/images/sellobject')), '/');
            }

            $updated = $object->update([
                'title' => $request->egtitle,
                'description' => $request->egdescription,
                'htmlPart' => $request->eghtmlpart,
                'pictureCover' => $cover,
                'category_id' => $request->ecategory,
                'startAt' => $request->estartat,
                'EndDate' => $request->eendat,
            ]);

            if ($request->hasFile('ealbum')) {
                foreach ($request->ealbum as $alb) {
                    sellObjectAlbum::create([
                        'objectSellId' => $request->eid,
                        'path' => ltrim(Storage::url($alb->store('public/images/sellobject/albums')), '/')
                    ]);
                }
            }

            if ($updated) {
                return redirect()->back()->withSuccess(["msg" => "Object sell updated successfully"]);
            } else {
                return redirect()->back()->withErrors(["msg" => "Oops , somethings went wrong"]);
            }
        } else {
            return redirect()->back()->withErrors(["msg" => "Oops , Object sell not found , maybe it's already deleted"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteObj(REQUEST $request)
    {
        $request->validate(['did' => 'required|integer']);
        $obj = sellObject::find($request->did);
        if ($obj->count() > 0) {
            $deleted = $obj->delete();
            if ($deleted) {
                sellObjectAlbum::where("objectSellId", "like", $request->did)->delete();
                sellObjectPricing::where("object_id", "like", $request->did)->delete();
                return redirect()->back()->withSuccess(["msg" => "Objecl sell deleted successfully"]);
            } else {
                return redirect()->back()->withSuccess(["msg" => "Opps , somethings went wrong"]);
            }
        } else {
            return redirect()->back()->withSuccess(["msg" => "Opps , object sell dosen't exist . maybe it's already deleted"]);
        }
    }

    public function updateplan(REQUEST $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'icon' => 'required',
                'description' => 'required',
                'price' => 'required',
                'eid' => 'required'
            ]
        );
        $obj = sellObjectPricing::find($request->eid);
        if ($obj->count() > 0) {
            $saved = $obj->update([
                'price' => $request->price,
                'description' => $request->description,
                'htmlPart' => $request->htmlPart,
                'name' => $request->name,
            ]);
            if ($saved) {
                return redirect()->back()->withSuccess(["msg" => "Object pricing plan updated successfully"]);
            } else {
                return redirect()->back()->withErrors(["msg" => "Oops , somethings went wrong ..."]);
            }
        } else {
            return redirect()->back()->withErrors(["msg" => "Oops , Pricing plan not found !"]);
        }
    }
}
