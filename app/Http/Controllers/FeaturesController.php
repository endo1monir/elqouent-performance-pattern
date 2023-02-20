<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index()
    {
        $statuses = Feature::toBase()
            ->selectRaw("count(case when status='Requested' then 1 end) as requested")
            ->selectRaw("count(case when status='Planned' then 1 end) as planned")
            ->selectRaw("count(case when status='Completed' then 1 end) as completed")
            ->first();
        $features = Feature::withCount('comments')->paginate();
        return view('features', get_defined_vars());
    }

    public function show(Feature $feature)
    {
        $feature->load('comments.user');
//        $feature->load('comments.user', 'comments.feature.comments');
        $feature->comments->each->setRelation('feature',$feature);

        return view('feature', get_defined_vars());
    }
}
