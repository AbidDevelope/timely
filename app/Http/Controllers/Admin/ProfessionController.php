<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionController extends Controller
{
    public function index()
    {
        $data['professions'] = Profession::all();
        return view('admin.profession.index', $data);
    }

    public function store()
    {
        return view('admin.profession.store');
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|unique:professions,name',
            'status' => 'required',
        ]);
        
        if($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        Profession::create([
            'name' => $request->name,
            'status' => $request->status
        ]);
       
        flash()->success('Profession Added Successfully');
        return redirect()->route('profession');
    }

    public function edit($id)
    {
        $data['profession'] = Profession::find($id);
        return view('admin.profession.edit', $data);
    }

    public function update(Request $request, $id)
    {
       $validate = Validator::make($request->all(), [
        'name' => 'required|string|unique:professions,name',
        'status' => 'required'
       ]);

       if($validate->fails())
       {
        return redirect()->back()->withInput()->withErrors($validate);
       }

       $profession = Profession::where('id', $id)->first();

       $profession->update([
        'name' => $request->name,
        'status' => $request->status
       ]);

       flash()->success('Profession Updated Successfully');
       return redirect()->route('profession');
    }

    public function delete($id)
    {
        $profession = Profession::where('id', $id)->first();
        $profession->delete();

        flash()->success('Profession Deleted Sucessfully');
        return redirect()->back();
    }
}
