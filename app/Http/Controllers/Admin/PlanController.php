<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\AgeGroup;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $data['plans'] = Plan::with('ageGroup')->get();
        return view('admin.plan.index', $data);
    }

    public function store()
    {
        $data['age'] = AgeGroup::all();
        return view('admin.plan.store', $data);
    }

    public function create(Request $request)
    {
       $validate = Validator::make($request->all(), rules: [
            'age_group_id' => 'required',
            'plan' => 'required|string',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

       Plan::create([
        'age_group_id' => $request->age_group_id,
        'plan' => $request->plan
       ]);

       flash()->success('Plan Added Successfully');
       return redirect()->route('plan');
    }
}
