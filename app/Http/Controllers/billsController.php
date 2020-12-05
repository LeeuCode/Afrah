<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\Bill;
use App\Models\Bill_items;
use DB;


class billsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        if(Auth::user()->role == 3) {
            return redirect('/copying/search');
        }

        $data['items'] = Item::where('state','=','1')->get();
        $data['dayCounter'] = Bill::whereDate('created_at','=',Carbon::today())->count();
        $data['lastID'] = (isset(Bill::orderBy('id','desc')->get()[0])) ? (Bill::orderBy('id','desc')->get()[0]->id + 1) : 1 ;
        return view('theme.index',$data);
    }//index()

    public function bills()
    {
        $data['bills'] = Bill::paginate(15);
        return view('theme.bills',$data);
    }//bills()

    public function getBillsJson()
    {
        return Bill::select('id','agentName','paid','turnover','created_at')->get()->toJson();
    }

    public function view($id)
    {
        $data['bill'] = Bill::find($id);
        // dd($data['bill']->bill_items()->get());
        return view('theme.bill-view', $data);
    }//view()
    
    public function getBillItem($id)
    {
        $billItems = Bill_items::where('bill_id',$id)->get();
            echo '<option value="">إختار</option>';
        foreach ($billItems as $billItem) {
            echo '<option value="'.$billItem->item->id.'" >'.$billItem->item->name.'</option>';
        }
    }//getBillItem()

    public function saveBill(Request $request)
    {
        $paid = $request->input('paid');
        $turnover = $request->input('turnover');
        $balance = $request->input('balance');
        // Save bills from input form data.
        $bill = new Bill(); // create new instance Obj.
        $bill->agentName = $request->input('agentName');
        $bill->agentPhone = $request->input('agentPhone');
        $bill->deliveryDate = $request->input('deliveryDate');
        $bill->turnover = $turnover;
        $bill->paid = $paid;
        $bill->balance = $balance;

        if($paid < $turnover) {
            $bill->remainder = 0;
        } else {
            $bill->remainder = 1;
        }

        $bill->save();

        $items = [];
        // Prepare an input data to save it into database.
        $itemName = $request->input('itemName');
        $itemBillName = $request->input('itemBillName');
        $itemPrice = $request->input('itemPrice');
        $itemQuantity = $request->input('itemQuantity');
        $itemAmount = $request->input('itemAmount');

        // Loop bill item inputs value to save in bill_items table.
        foreach ($itemName as $id => $itemID) {
            $billItem = new Bill_items(); // create new instance of Obj.
            $billItem->bill_id = $bill->id;
            $billItem->item_id = $itemID;
            $billItem->price = $itemPrice[$id];
            $billItem->quantity = $itemQuantity[$id] ;
            $billItem->amount = $itemAmount[$id];
            $billItem->save();

            $items[$id] = array(
                'itemName'      => $itemBillName[$id],
                'itemPrice'     => $itemPrice[$id],
                'itemQuantity'  => $itemQuantity[$id],
                'itemAmount'   => $itemAmount[$id]
            );
        }//foreach

        // Get bills created in this today.
        $billDayCounter = Bill::whereDate('created_at','=',Carbon::today())->count();

        $this->storagePath(public_path(),$bill->id);

        $this->storagePath(get_option('archive_path'),$bill->id);

        return array(
            'id'                =>($bill->id+1),
            'bill_id'           => $bill->id,
            'billDayCounter'    => $billDayCounter,
            'message'           => 'تم حفظ الفاتوره رقم ('.$bill->id.') بنجاح',
            'items'             => $items,
            'paid'              => $paid,
            'turnover'          => $turnover,
            'balance'           => $balance,
            'date'              => date('H:i:s Y-m-d'),
            'deliveryDate'      => $request->input('deliveryDate')
        );

    }//saveBill()

    // Create a storage path. 
    protected function storagePath($path , $id)
    {
        // Definition constant DS as directory separator.
        $DS = \DIRECTORY_SEPARATOR;

        /* @var $archivesPublicPath /public/archives */
        $archivesPublicPath =  $path.$DS.get_option('archive_folder');
        /* @var $yearPublicPath /public/archives/year */
        $yearPublicPath = $archivesPublicPath.$DS.date('Y');

        /* @var $monthPublicPath /public/archives/year/month */
        $monthPublicPath = $yearPublicPath.$DS.date('m').'-'.date('Y');

        /* @var $dayPublicPath /public/archives/year/month/day */
        $dayPublicPath = $monthPublicPath.$DS.date('d').'-'.date('m').'-'.date('Y');

        /* @var $billPublicPath /public/archives/year/month/day/bill_id */
        $billPublicPath = $dayPublicPath.$DS.$id;

        if(!file_exists($archivesPublicPath)){
            mkdir($archivesPublicPath);
        }// if

        if(!file_exists($yearPublicPath)){
            mkdir($yearPublicPath);
        }// if 
        
        if(!file_exists($monthPublicPath)) {
            mkdir($monthPublicPath);
        }// if
        
        if(!file_exists($dayPublicPath)) {
            mkdir($dayPublicPath);
        }// if
        
        if(!file_exists($billPublicPath)) {
            mkdir($billPublicPath);
        }// if
    }//storagePath()

    public function getTurnover($id)
    {
        $bill = Bill::find($id);

        return $bill;
    }//getTurnover()
}//billsController
