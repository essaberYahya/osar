<?php

namespace App\Http\Controllers;

use App\Models\contactUs;
use App\Models\intro;
use App\Models\navItems;
use App\Models\newsletter;
use App\Models\ourCustomers;
use App\Models\ourServices;
use App\Models\project;
use App\Models\projectCategory;
use App\Models\rowSecData;
use App\Models\sellObject;
use App\Models\settings;
use App\Models\softLicence;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PDO;

class frontEndDataController extends Controller
{
    public function laodWelcomeData()
    {

        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $intro = intro::orderBy("created_at", "desc")->get();
        $service = ourServices::orderBy("created_at", "desc")->take(6)->get();
        $rowSectionData = rowSecData::orderBy("created_at", "desc")->take(6)->get();
        $ourCustomer = ourCustomers::orderBy("created_at", "desc")->take(12)->get();
        $projects = project::orderBy("created_at", "desc")->take(6)->get();
        $elearnings = sellObject::orderBy("created_at", "desc")->take(8)->get();
        $categories = projectCategory::all();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'settings' => $settings,
            'navItems' => $navItems,
            'intros' => $intro,
            'service' => $service,
            'rowSectionData' => $rowSectionData,
            'ourCustomer' => $ourCustomer,
            'oprojects' => $projects,
            'asset' => asset(''),
            'elearnings' => $elearnings,
            'categories' => $categories
        ]);
    }

    public function dashboard()
    {
        $softlicence = softLicence::where("modelRoute", 'like', Route::currentRouteName())->orderBy("created_at")->first();
        $settings = settings::orderBy("created_at", "desc")->first();
        return Inertia::render('Dashboard', [
            'asset' => asset(''),
            'licence' => $softlicence,
            'settings' => $settings,
        ]);
    }


    public function renderIntroManagement()
    {
        $softlicence = softLicence::where("modelRoute", 'like', Route::currentRouteName())->orderBy("created_at")->first();
        $settings = settings::orderBy("created_at", "desc")->first();
        return Inertia::render('introManagement', [
            'intros' => intro::all(),
            'asset' => asset(''),
            'licence' => $softlicence,
            'settings' => $settings,
        ]);
    }

    public function saveintro(REQUEST $request)
    {


        $request->validate([
            'gtitle' => 'required',
            'gdescription' => 'required',
            'ghtmlpart' => 'required',
            'intropicture' => 'required|image'
        ]);


        $intro = intro::create([
            'title' => $request->gtitle,
            'description' => $request->gdescription,
            'htmlPart' => $request->ghtmlpart,
            'backgroundimg' => ltrim(Storage::url($request->intropicture->store("/public/images/intro/")), "/"),
        ]);

        if ($intro) {
            return redirect()->back()->withSuccess(["intro" => $intro]);
        } else {
            return redirect()->back()->withErrors(["custom" => "ups , error"]);
        }
    }

    public function updateIntro(REQUEST $request)
    {

        $request->validate([
            'eid' => 'required',
            'egtitle' => 'required',
            'egdescription' => 'required',
            'eghtmlpart' => 'required',
        ]);

        $intro = intro::find($request->eid);
        if ($intro->count() == 0) {
            return Response()->back()->withErros(["error" => "Intro with id : " . $request->eid . " dosen't exists !"]);
        } else {

            if ($request->hasFile("eintropicture")) {
                $eintro = $intro->update([
                    'title' => $request->egtitle,
                    'description' => $request->egdescription,
                    'htmlPart' => $request->eghtmlpart,
                    'backgroundimg' => ltrim(Storage::url($request->eintropicture->store("/public/images/intro/")), "/"),
                ]);
            } else {
                $eintro = $intro->update([
                    'title' => $request->egtitle,
                    'description' => $request->egdescription,
                    'htmlPart' => $request->eghtmlpart,
                ]);
            }

            if ($eintro) {
                return redirect()->back()->withSuccess(["intro" => $eintro]);
            } else {
                return redirect()->back()->withErrors(["custom" => "ups , error"]);
            }
        }
    }

    public function deleteIntro(REQUEST $request)
    {
        $intro = intro::find($request->did);
        if ($intro->count() > 0) {
            $deleted = $intro->delete();
            return redirect()->back()->withSuccess(["msg" => "intro deleted successfully"]);
        } else {
            return redirect()->back()->withErrors(["msg" => "intro dosen't exists"]);
        }
    }

    public function singleproject($id, $title)
    {

        $project = project::find($id);
        $myinteresting = null;
        if ($project->count() > 0) {
            $myinteresting = project::where("category_id", "like", $project->category_id)
                ->where("id", "not like", $project->id)->get();
        }
        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $oprojects = project::orderBy("created_at", "desc")->take(6)->get();
        $categories = projectCategory::all();
        return Inertia::render("project", [
            'project' => $project,
            'settings' => $settings,
            'oprojects' => $oprojects,
            'navItems' => $navItems,
            'myinteresting' => $myinteresting,
            'asset' => asset(''),
            'categories' => $categories

        ]);
    }

    public function singleObjectSell($id, $title)
    {
        $object = sellObject::find($id);
        if ($object != null) {
            $productByCat = sellObject::where('category_id', 'like', $object->category_id)->paginate(12);
        } else {
            $productByCat = null;
        }
        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $oprojects = project::orderBy("created_at", "desc")->take(6)->get();
        $categories = projectCategory::all();

        return Inertia::render("singleObject", [
            'object' => $object,
            'settings' => $settings,
            'oprojects' => $oprojects,
            'navItems' => $navItems,
            'asset' => asset(''),
            'categories' => $categories,
            'productByCat' => $productByCat
        ]);
    }

    public function allSellObject()
    {
        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $products = sellObject::paginate(12);
        $cat = projectCategory::all();
        return Inertia::render("products", [
            'navItems' => $navItems,
            'settings' => $settings,
            'asset' => asset(''),
            'products' => $products,
            'categories' => $cat
        ]);
    }

    public function GetallElearnings()
    {
        $data = project::orderBy('created_at', 'desc')->paginate(6);
        return response()->json(['data' => $data]);
    }

    public function FilterByCategory($id)
    {
        if ($id == '*') {
            $data = project::orderBy('created_at', 'desc')->paginate(6);
        } else {
            $data = project::orderBy('created_at', 'desc')->where('category_id', 'like', $id)->paginate(6);
        }

        return response()->json(['data' => $data]);
    }

    public function contact()
    {
        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $cat = projectCategory::all();
        return Inertia::render('contact', [
            'settings' => $settings,
            'navItems' => $navItems,
            'asset' => asset(''),
            'categories' => $cat
        ]);
    }

    public function postcontact(REQUEST $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $saved = contactUs::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone,
        ]);

        if ($saved) {
            return redirect()->back()->withSuccess('Yous message submitted successfully');
        } else {
            return redirect()->back()->withErrors('Oops , something went wrong with us');
        }
    }

    public function productByCategory($id, $name)
    {
        $products = projectCategory::find($id)->sellsObject()->paginate(12);
        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $cat = projectCategory::find($id);
        $catr = projectCategory::all();
        return Inertia::render("productsByCategorie", [
            'navItems' => $navItems,
            'settings' => $settings,
            'asset' => asset(''),
            'products' => $products,
            'category' => $cat,
            'categories' => $catr
        ]);
    }

    public function requestQuotation()
    {

        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $oprojects = project::orderBy("created_at", "desc")->take(6)->get();
        $categories = projectCategory::all();

        return Inertia::render("quotatioRequest", [
            'settings' => $settings,
            'oprojects' => $oprojects,
            'navItems' => $navItems,
            'asset' => asset(''),
            'categories' => $categories,
        ]);
    }

    public function search()
    {

        $navItems = navItems::orderBy("created_at", "desc")->take(7)->get();
        $settings = settings::orderBy("created_at", "desc")->first();
        $oprojects = project::orderBy("created_at", "desc")->take(6)->get();
        $categories = projectCategory::all();
        $products = sellObject::orderBy("created_at", "desc")->paginate(12);

        return Inertia::render("search", [
            'settings' => $settings,
            'oprojects' => $oprojects,
            'navItems' => $navItems,
            'asset' => asset(''),
            'categories' => $categories,
            'products' => $products,
            'searchResult' => null
        ]);
    }

    public function lookForData($keyworld)
    {
        $data = sellObject::whereRaw('LOWER(title) like ? or LOWER(description) like ?', ['%' . $keyworld . '%', '%' . $keyworld . '%'])
            ->paginate(12);
        return response()->json(["code" => 200, "data" => $data]);
    }

    public function postnewsletter(REQUEST $request)
    {
        $request->validate(['email' => 'required|email']);
        $c = newsletter::where('email', 'like', $request->email)->count();
        if ($c > 0) {
            return redirect()->back()->withErrors(['exist' => '1', 'msg' => 'Email already exist']);
        } else {
            $saved = newsletter::create(['email' => $request->email]);
            if ($saved) {
                return redirect()->back()->withSuccess(['exist' => '0', 'msg' => 'Saved successfully']);
            } else {
                return redirect()->back()->withErrors(['exist' => '0', 'msg' => "Oops , Smethings went wrong"]);
            }
        }
    }
}
