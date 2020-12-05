<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Item;
use App\Models\Copying;
use App\Models\Bill_items;
use DB;

class copyingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['bills'] = Bill::where();
    }
    
    public function create()
    {
        $billIDs = [];

        if( Copying::count() == 0) {
            $allBills = DB::select('SELECT id FROM bills');
            $bills = array_column($allBills,'id');
        } else {

            $allBills = DB::select('SELECT id FROM bills');

            foreach ($allBills as $bill) {
                if (Copying::where('bill_id',$bill->id)->count() < Bill_items::where('bill_id',$bill->id)->count()) {
                    $billIDs[] = $bill->id;
                }
            }

            $bills = $billIDs;
        }

        $date = Carbon::today();
        $data['bills'] = $bills;
        return view('theme.copying',$data);
    }

    public function store(Request $request)
    {
        // Definition constant DS as directory separator.
        define('DS',\DIRECTORY_SEPARATOR);

        $itemID = $request->input('item_id');
        $bilID = $request->input('bill_id');
        $img = $request->file('image');

        $bill = Bill::find($bilID);
        $item = Item::find($itemID);
        $itemName = $item->name;

        /* @var $year year */
        $year = date('Y',\strtotime($bill->created_at));

        /* @var $month month-year */
        $month = date('m',\strtotime($bill->created_at)).'-'.$year;

        /* @var $day day-month */
        $day = date('d',\strtotime($bill->created_at)).'-'.$month;

        /* @var $datePath /public/archives/year/month/day */
        $datePath = $year.DS.$month.DS.$day;

        $imagPath = get_option('archive_folder').DS.$datePath.DS.$bilID.DS.$itemName.DS;

        $localDir = get_option('archive_path');

        $archPublic = public_path($imagPath);

        $archLocal = $localDir.$imagPath;

        if (!\file_exists($archLocal)) {
            mkdir($archLocal);
        }

        if (!\file_exists($archPublic)) {
            mkdir($archPublic);
        }


        if($request->hasfile('image'))
        {

            foreach($request->file('image') as $image)
            {
                $name = $image->getClientOriginalName();
                $uploader = $image->move($archPublic , $name);

                if(!empty(get_option('archive_path')) && file_exists($archLocal.$name) ) {
                    copy($uploader,$archLocal.$name);
                }

                $data[] = $imagPath.$name;  
            }
        }

        // `bill_id`, `item_id`, `image`
        $copying = New Copying();
        $copying->bill_id = $bilID;
        $copying->item_id =  $itemID;
        $copying->image = json_encode($data);

        $copying->save();

        \Session::flash('status', ' أضافة الصورة إلي المسار بنجاح');

        return back();
    }

    public function search()
    {
        $data['items'] = Item::all();
        return view('theme.search-archives',$data);
    }//search()

    public function searchResult(Request $request)
    {
    	define('DS',\DIRECTORY_SEPARATOR);

        $bill_id = $request->input('bill_id');
        $agent_name = $request->input('agent_name');
        $item_id = $request->input('item_id');
        $bill_date = $request->input('bill_date');

        $bill = DB::table('copying')
        ->join('bills', 'copying.bill_id', '=', 'bills.id')
        ->join('bill_items', 'bills.id', '=', 'bill_items.bill_id');

        if(!empty($item_id)) {
            $bill->where('bill_items.item_id',$item_id);
        }

        if(!empty($bill_id)) {
            $bill->where('bills.id',$bill_id);
        }

        if(!empty($agent_name)) {
            $bill->Where('bills.agentName','like','%'.$agent_name.'%');
        }

        if(!empty($bill_date)) {
            $date = date('Y-m-d',\strtotime($bill_date));//Carbon::createFromDate($year,$mo,$dy);
            $bill->whereDate('bills.created_at','=',$date);
        }

        $copys = $bill->paginate(2);

        if(count($copys) > 0) {
            foreach ($copys as $copy) {
                $image = json_decode($copy->image);
                echo '<tr>
                    <td style="width: 100px">
                        <img style="width: 100px" class="thumbnail" src="'.asset($image[0]).'" alt="">
                    </td>
                    <td class="text-center" >
                        <span class="badge badge-purple" >'.$copy->bill_id.'</span>
                    </td>
                    <td><h5>'.$copy->agentName.'</h5></td>
                    <td class="text-center" ><span class="badge badge-yellow">'.count($image).' صورة</span></td>
                    <td>
                        <button class="btn btn-white copy" data-clipboard-text="'.get_option('archive_path').dirname($image[0]).'">
                            <i class="fa fa-copy" ></i>
                            نسح مسار الصورة
                        </a>
                    </td>
                    <td class="text-center" ><span class="badge badge-danger" >'.$copy->balance.'ج</span></td>
                    <td><h5>'.date('Y-m-d',strtotime($copy->created_at)).'</h5></td>
                </tr>';
            }

            echo '<tr>
                    <td colspan="7" >';
            echo    $copys->links();
            echo '</td></tr>';

        } else {
            echo ' <tr>
                    <td class="text-center" colspan="7" ><i>لا توجد نتائج بحث مطابقة لما تبحث عنه.</i></td>
                </tr>';
        }
    }//searchResult()
}
