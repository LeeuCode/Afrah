<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Remainder;
use App\Models\Bill;
use DB;

class reportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function daily()
    {
        $data['items'] = DB::table('bill_items')
        ->join('items', 'bill_items.item_id', '=', 'items.id')
        ->select('items.name','items.price',DB::raw('SUM(bill_items.quantity) AS quantityItem ,item_id'))
        ->whereDate('bill_items.created_at','=',Carbon::today())
        ->groupBy('item_id')
        ->get();

        $data['remainders'] = Remainder::whereDate('created_at','=',Carbon::today())->get();

        $data['bills'] = Bill::whereDate('created_at','=',Carbon::today())->get();

        $data['total'] = 0;
        $data['billTotal'] = 0;
        $data['rmTotal'] = 0;

        // dd($data['remainders'][0]->bill->agentName);

        return view('theme.daily-report',$data);
    }

    public function custom()
    {
        $data['items'] = DB::table('items')->get();
        return view('theme.custom-report',$data);
    }

    public function showCustom(Request $request){
        $from = date($request->input('from'));
        $to = date($request->input('to'));

        $itemID = $request->input('item-name');

        $items =  DB::table('bill_items')
        ->join('items', 'bill_items.item_id', '=', 'items.id')
        // ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('items.name','items.price',DB::raw('SUM(bill_items.quantity) AS quantityItem ,item_id'));
        
        if(!empty($itemID)) {
            $items->where('bill_items.item_id',$itemID);
        }
        
        $allitems = $items->whereBetween('bill_items.created_at', [$from, $to]) //whereDate('bill_items.created_at','=',Carbon::today())
        ->groupBy('item_id')
        ->get();

        echo '  <div id="print">
                <h3 class="text-center visible-print" >تقرير مخصص</h3>
                <p class="text-center visible-print" >من تاريخ '.$from.' إلي تاريخ '.$to.'</p>
                <br>
                <table class="table table-bordered table-hover print">
                <thead>
                    <tr>
                        <th>الصنف</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الاجمالي</th>
                    </tr>
                </thead>
                <tbody class="table">';

                $total = 0;
                if(count($allitems) > 0 ) {
                    foreach ($allitems as $item) {

                        $amount = ($item->quantityItem * $item->price);
                        echo '<tr>';
                        echo '<td>'.$item->name.'</td>';
                        echo '<td>'.$item->price.'ج</td>';
                        echo '<td>'.$item->quantityItem.'</td>';
                        echo '<td>'.$amount.'ج</td>';
                        echo '</tr>';

                        $total += $amount;
                    }

                    echo '<tr>
                            <th colspan="3">إجمالي </th>
                            <th>'.$total.'</th>
                        </tr>';

                } else {
                    echo ' <tr>
                                <td class="text-center" colspan="5" >
                                    <i>لا توجد اي أصناف تم بيعها من تاريخ <b style="color:blue;">'.$from.'</b> الي تاريخ <b style="color:red;">'.$to.'</b>.</i>
                                </td>
                            </tr>
                    ';
                }


        echo '  </tbody>
            </table>
            </div>';

        if(count($allitems) > 0) {
            echo '<center>
                    <button type="button" class="btn btn-inverse btn-xs print-btn " >
                        <i class="fa fa-print"></i>
                        طباعة الفاتورة
                    </button>
                </center>';
        }
    }
}
