<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class itemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['items'] = Item::paginate(15);
        return view('theme.items', $data);
    }

    public function create()
    {
        return view('theme.item-create');
    }

    public function edit($id)
    {
        $data['item'] = Item::find($id);
        return view('theme.item-edit',$data);
    }

    public function update($id,Request $request)
    {
        $name = \str_ireplace( ['*','&','%'] ,'x',$request->input('name')); 
        $closeItem = $request->close_item;

        $item = Item::find($id);
        $item->name = $name;
        $item->price = $request->input('price');
        $item->delivery = $request->input('delivery');
        $item->state = ($closeItem == null) ? 1 : 0;
        $item->save();

        \Session::flash('status', 'تم تحديث الصنف بنجاح');

        return back();
    }

    public function store(Request $request)
    {
        $name = \str_ireplace( ['*','&','%'] ,'x',$request->input('name')); 
        $closeItem = $request->close_item;

        $item = new Item();
        $item->name = $name;
        $item->price = $request->price;
        $item->delivery = $request->delivery;
        $item->state = ($closeItem == null) ? 1 : 0;
        $item->save();

        \Session::flash('status', ' أضافة الصنف إلي النظام');

        return back();
    }

    public function getItem($id)
    {
        $item = Item::find($id);
        return $item;
    }
}
