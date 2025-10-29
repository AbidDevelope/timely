<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AgeGroup;

class AgeController extends Controller
{
    public function index()
    {
        $data['ageGroup'] = AgeGroup::all();
        return view('admin.age.index', $data);
    }

    public function store()
    {
        return view('admin.age.store');
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'label' => 'required|string|unique:age_groups',
            'min_age' => 'required|string|min:0',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

       AgeGroup::create([
        'label' => $request->label,
        'min_age' => $request->min_age,
        'max_age' => $request->max_age,
        'status' => $request->status
       ]);

       flash()->success('Age Group Added Successfully');
       return redirect()->route('age');
    }

    public function edit($id)
    {
        $age = AgeGroup::find($id);
        return view('admin.age.edit', compact('age'));
    }

    public function update(Request $request, $id)
    {
       $validate = Validator::make($request->all(), [
            'label' => 'required|string|unique:age_groups,label,'. $id,
            'min_age' => 'required|string|min:0',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

       $agegroups = AgeGroup::where('id', $id)->first();
       $agegroups->update([
            'label' => $request->label,
            'min_age' => $request->min_age,
            'max_age' => $request->max_age,
            'status' => $request->status
       ]);

       flash()->success('Age Updated Successfully');
       return redirect()->route('age');
    }

    public function delete($id)
    {
        $age = AgeGroup::where('id', $id)->first();
        $age->delete();
        
        flash()->success('Age Deleted Successfully');
        return redirect()->back();
    }
}
