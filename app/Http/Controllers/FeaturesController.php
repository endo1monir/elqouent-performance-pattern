<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index(){
        $features=Feature::withCount('comments')->paginate();
        return view('features',get_defined_vars());
    }
}
