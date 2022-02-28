<?php

namespace App\Http\Controllers\StoreKeeper;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $employeeID = DB::table('employees')->where('user_id', $user_id)->value('id');
        $categories = ProductCategory::where('managedBy', '=', [$employeeID])->get();
        return view('storekeeper.categories.index')->with('categories', $categories);
        // return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storekeeper.categories.create');
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
            'name' => 'required'
        ]);

        $user_id = Auth()->user()->id;
        $employeeID = DB::table('employees')->where('user_id', $user_id)->value('id');
        $categoryName = $request->input('name');
        $checkCategory = DB::select('select name from product_categories where managedBy = ? and name = ?', [$employeeID, $categoryName]);

        if($checkCategory)
        {
            $message = toast('Product category already exist', 'info');
            return redirect('/storekeeper/categories/create')->with('message', $message);       
        }
        else
        {            
            $category = new ProductCategory();
            $category->name = $categoryName;
            $category->managedBy = $employeeID;
            $category->save();

            $message = toast('Product category successfully registered', 'success');
            return redirect('/storekeeper/categories')->with('message', $message);     
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $products = DB::table('products')->where('product_category_id', $id)->get();
        // $products = Products::find($id);
        $categoryName = DB::table('product_categories')->where('id', $id)->value('name');
        $products = Products::where('product_category_id', '=', [$id])->get();
        return view('storekeeper.categories.show')->with('products', $products)->with('categoryName', $categoryName);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ProductCategory::find($id);
        return view('storekeeper.categories.edit')->with('category', $category);
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
            'name' => 'required'
        ]);
        $categoryName = $request->input('name');

        //update category name into a table
        $update = DB::update('update product_categories set name = ? where id = ?', [$categoryName, $id]);

        $message = toast('Product Category name successfully changed', 'success');
        return redirect('/storekeeper/categories')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        $category->delete();
        $message = toast('Product Category successfully deleted', 'success');
        return redirect('/storekeeper/categories')->with('message', $message);
    }
}
