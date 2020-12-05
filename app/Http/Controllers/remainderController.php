<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Remainder;
use DB;

class remainderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['bills'] = Bill::where('remainder',0)->get();

        return view('theme.remainder', $data);
    }

    public function store(Request $request)
    {
        $bill_id = $request->input('bill_id');
        $remainder = new Remainder();
        $remainder->bill_id = $bill_id;
        $remainder->amount = $request->input('amount');
        $remainder->save();

        DB::table('bills')
                ->where('id', $bill_id)
                ->update(['remainder' => 1]);

        \Session::flash('status', 'دفع باقي الفاتورة.');

        return back();
    }
}
