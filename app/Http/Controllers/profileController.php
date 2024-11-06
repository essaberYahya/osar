<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class profileController extends Controller
{
    public function index(){
        $settings = settings::orderBy("created_at", "desc")->first();
       
        return Inertia::render('Profile/Show', [
            'settings' => $settings,
        ]);
    }
}
