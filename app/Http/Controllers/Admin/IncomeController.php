<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\IncomeRange;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $data['income'] = IncomeRange::whereIn('id', [2, 3, 4])->get();
        dd($data['income']);
        return view('admin.income_range.index', $data);
    }

    public function store()
    {
        return view('admin.income_range.store');
    }

    public function create(Request $request)
    {
       $validate = Validator::make($request->all(), [
          'label' => 'required|string|unique:income_ranges',
            'min_income' => 'required|numeric|min:0',
            'max_income' => 'required|numeric|gt:min_income',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

        IncomeRange::create([
        'label' => $request->label,
        'min_income' => $request->min_income,
        'max_income' => $request->max_income
       ]);

       flash()->success('Income Range Added Successfully');
       return redirect()->route('income');
    }

    public function edit($id)
    {
        $data['income'] = IncomeRange::find($id);
        return view('admin.income_range.edit', $data);
    }

    public function update(Request $request, $id)
    {
         $validate = Validator::make($request->all(), [
          'label' => 'required|string|unique:income_ranges,label,' .$id,
            'min_income' => 'required|numeric|min:0',
            'max_income' => 'required|numeric|gt:min_income',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

       $incomerange = IncomeRange::where('id', $id)->first();
       $incomerange->update([
        'label' => $request->label,
        'min_income' => $request->min_income,
        'max_income'=> $request->max_income,
        'status' => $request->status
       ]);

       flash()->success('income Range Updated Successfully');
       return redirect()->route('income');
    }

    public function delete($id)
    {
       $incomerange = IncomeRange::where('id', $id)->first();
       $incomerange->delete();
       
       flash()->success('Income Range Deleted Successfully.');
       return redirect()->back();
    }
}
