<?php

namespace App\Http\Controllers\StoreKeeper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Sales;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $storeID = DB::table('employees')->where('user_id', $user_id)->value('storeID');
        $sales = Sales::where('store_id', '=', [$storeID])->get();
        return view('storekeeper.sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storekeeper.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phonenumber' => 'required'
        ]);

        //catch store_id and seller id
        $user_id = Auth()->user()->id;
        $storeID = DB::table('employees')->where('user_id', $user_id)->value('storeID');
        $seller = DB::table('employees')->where('user_id', $user_id)->value('id');

        $sale = new Sales();
        $sale->store_id = $storeID;
        $sale->seller = $seller;
        $sale->client = $request->input('name');
        $sale->phonenumber = $request->input('phonenumber');
        $sale->save();

        $message = toast('Sale order created successfully', 'success')->autoClose(2500);
        // return redirect('/storekeeper/sales/order', $sale)->with('message', $message)->with('sale', $sale);
        return redirect()->route('sales.show', ['sale' => $sale->id])->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sale)
    {
        $products = Products::all();
        return view('storekeeper.sales.order', ['sale' => $sale])->with('products', $products);
        // return $sale;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sales::find($id);
        $products = Products::all();
        return view('storekeeper.sales.order')->with('sale', $sale)->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'qty1' => 'required',
            'price1' => 'required'
        ]);
        
        $qty = $request->input('qty1');
        $price = $request->input('price1');
        $total = $qty * $price;
        $update = DB::update('update sold_products set quantity = ?, price = ?, total_amount = ?
         where id = ?', [$qty, $price, $total, $id]);
        
        $message = toast('Product order successfully updated', 'info')->autoClose('3000');
        return redirect()->back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sales::find($id);
        $sale->delete();
        $message = toast('Sale order deleted successfully', 'success')->autoClose(2500);
        return redirect('/storekeeper/sales')->with('message', $message);
    }
    
    
}
