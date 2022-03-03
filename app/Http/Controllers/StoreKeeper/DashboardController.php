<?php

namespace App\Http\Controllers\StoreKeeper;

use App\Models\Sales;
use App\Models\Products;
use App\Models\SoldProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $alert = toast('Welcome back','success')->autoClose(5000);
        return view('storekeeper.dashboard');
    }

    //function to register new stock of a product
    public function newStock($id)
    {
        $product = Products::find($id);
        return view('storekeeper.products.stock')->with('product', $product);
    }

    public function storeStock(Request $request, $id)
    {
        $this->validate($request, [
            'stock' => 'required'
        ]);
        $newStock = $request->input('stock');
        
        //retrieve old stocks and add new stock in it
        $oldStock = DB::table('products')->where('id', $id)->value('stock');
        $stock = $oldStock + $newStock;

        //update stock value in the database
        $update = DB::update('update products set stock = ? where id = ?', [$stock, $id]);

        $message = toast('Product new stock added successfully', 'info');
        return redirect('/storekeeper/products')->with('message', $message);
        // return $stock;
    }

    public function addproduct(Request $request, $id)
    {
        $qty = $request->input('qty');
        $product_id = $request->input('product');
        $checkqty = DB::table('products')->where('id', $product_id)->value('stock');
        if($checkqty >= $qty)
        {
            $price = $request->input('price');
            $total = $price * $qty;

            $sold = new SoldProduct();
            $sold->sales_id = $request->input('sale_id');
            $sold->product_id = $product_id;
            $sold->quantity = $qty;
            $sold->price = $price;
            $sold->total_amount = $total;
            $sold->save();

            //update product stock
            $remStock = $checkqty - $qty;
            $update = DB::update('update products set stock = ? where id = ?', [$remStock, $product_id]);

            $message = toast('Product added to sale order successfully', 'info');
            return redirect()->back()->with('message', $message);
        }
        else
        {
            $message = toast('Quantity of products needed exceed the stock in store. Plz Re-stock product first', 'warning')->autoClose(5000);
            return redirect()->back()->with('message', $message);
        }

    }

    public function finalize($id)
    {
        $date = Carbon::now();
        $update = DB::update('update sales set finalized_at = ? where id = ?', [$date, $id]);

        $message = toast('Sale order finalized successfully', 'success')->autoClose(3000);
        return redirect('/storekeeper/sales')->with('message', $message);
    }

    public function removeprod($id)
    {
        //Return products removed from order to product stocks
        $quantity = DB::table('sold_products')->where('id', $id)->value('quantity');
        $prod_id = DB::table('sold_products')->where('id', $id)->value('product_id');
        $checkStock = DB::table('products')->where('id', $prod_id)->value('stock');
        $remStock = $checkStock + $quantity;
        $update = DB::update('update products set stock = ? where id = ?', [$remStock, $prod_id]);

        //delete operation
        $soldproduct = SoldProduct::find($id);
        $soldproduct->delete();
        $message = toast('Product removed successfully', 'info')->autoClose(3000);
        return redirect()->back()->with('message', $message);
    }

    public function editprod($id)
    {
        $product = SoldProduct::find($id);
        return view('storekeeper.sales.editprod')->with('product', $product);
    }
    
    public function updateprod(Request $request, $id)
    {
        $this->validate($request, [
            'qty' => 'required',
            'price' => 'required'
        ]);

        // $sold_id = $request->input('order_id');
        $qty = $request->input('qty');
        $price = $request->input('price');
        $total = $qty * $price;
        $update = DB::update('update sold_products set quantity = ?, price = ?, total_amount = ?
         where id = ?', [$qty, $price, $total, $id]);
        
        $message = toast('Product order successfully updated', 'info')->autoClose('3000');
        return redirect()->back()->with('message', $message);
    }
}
