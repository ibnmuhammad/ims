<?php

namespace App\Http\Controllers\StoreKeeper;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductController extends Controller
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
        $products = Products::where('storeID', '=', [$storeID])->get();
        return view('storekeeper.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth()->user()->id;
        $employeeID = DB::table('employees')->where('user_id', $user_id)->value('id');
        $category = ProductCategory::where('managedBy', '=', [$employeeID])->get();
        return view('storekeeper.products.create')->with('category', $category);
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
            'category' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        //catch storeID
        $user_id = Auth()->user()->id;
        $storeID = DB::table('employees')->where('user_id', $user_id)->value('storeID');

        $product = new Products();
        $product->name = $request->input('name');
        $product->description = $request->input('desc');
        $product->product_category_id = $request->input('category');
        $product->storeID = $storeID;
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->save();

        $message = toast('Product added successfully', 'success');
        return redirect('/storekeeper/products')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth()->user()->id;
        $employeeID = DB::table('employees')->where('user_id', $user_id)->value('id');
        $category = ProductCategory::where('managedBy', '=', [$employeeID])->get();
        $product = Products::find($id);
        return view('storekeeper.products.edit')->with('category', $category)->with('product', $product);
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
            'category' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $category = $request->input('category');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $price = $request->input('price');
        $stock = $request->input('stock');

        $update = DB::update('update products set name = ?, description = ?, categoryID = ?, price = ?,
        stock = ? where id = ?', [$name, $desc, $category, $price, $stock, $id]);

        $message = toast('Product details updated successfully', 'success');
        return redirect('/storekeeper/products')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        $message = toast('Product successfully removed', 'success');
        return redirect('/storekeeper/products')->with('message', $message);
    }
}
