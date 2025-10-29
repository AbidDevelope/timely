<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class paymentModeController extends Controller
{
    public function index()
    {
        $data['modes'] = PaymentMode::all();
        return view('admin.payment_mode.index', $data);
    }

    public function store()
    {
        return view('admin.payment_mode.store');
    }

    public function create(Request $request)
    {
         $validate = Validator::make($request->all(), rules: [
            'mode' => 'required|string',
            'status' => 'required',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

       PaymentMode::create([
        'mode' => $request->mode,
        'status' => $request->status
       ]);

       flash()->success('Payment Mode added Successfully');
       return redirect()->route('payment_mode');
    }

    public function edit($id)
    {
        $data['mode'] = PaymentMode::find($id);
        return view('admin.payment_mode.edit', $data);
    }

    public function update(Request $request, $id)
    {
       $validate = Validator::make($request->all(), rules: [
            'mode' => 'required|string',
            'status' => 'required',
       ]);

       if($validate->fails())
       {
         return redirect()->back()->withInput()->withErrors($validate);
       }

       $mode = PaymentMode::where('id', $id)->first();
       $mode->update(attributes: [
        'mode' => $request->mode,
        'status' => $request->status
       ]);

       flash()->success('Payment Mode Updated Successfully');
       return redirect()->route('payment_mode');
    }

    public function delete($id)
    {
        $mode = PaymentMode::where('id', $id)->first();
        $mode->delete();

        flash()->success('Payment Deleted Successfully');
        return redirect()->back();
    }
}
