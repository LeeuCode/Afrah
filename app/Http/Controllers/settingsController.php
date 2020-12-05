<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use DB;

class settingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('theme.settings');
    }

    public function save(Request $request)
    {
        $countSetting = Setting::count();
        $allSetting = DB::select('SELECT name FROM settings');
        $settings = array_column($allSetting,'name');

        foreach ($request->input() as $key => $input) {
            if ($key != '_token') {
                if ($countSetting == 0) {
                    DB::table('settings')->insert(
                        ['name' => $key, 'value' => $input]
                    );
                } else {
                    if( \in_array($key,$settings) ) {
                        DB::table('settings')
                            ->where('name', $key)
                            ->update(['value' => $input]);
                    } else {
                        DB::table('settings')->insert(
                            ['name' => $key, 'value' => $input]
                        );
                    }
                }
            }
        }

        \Session::flash('status', 'تم تحديث اعدادات النظام بنجاح');
        return back();
    }
}
