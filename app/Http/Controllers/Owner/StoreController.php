<?php

namespace App\Http\Controllers\Owner;

use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $stores = Stores::where('user_id', '=', [$user_id])->get();
        return view('owner.stores.index')->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.stores.create');
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
            'location' => 'required'
        ]);

        $user_id = Auth()->user()->id;
        
        $store = new Stores;
        $store->name = $request->input('name');
        $store->location = $request->input('location');
        $store->user_id = $user_id;
        $store->save();

        $message = toast('Store added successfully', 'success')->autoClose(5000);
        // return view('owner.stores.create')->with('message', $message);
        return redirect('/owner/stores')->with('message', $message);
        
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
        $store = Stores::find($id);
        return view('owner.stores.edit')->with('store', $store);
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
            'name' => 'required', 
            'location' => 'required'
        ]);
        //receive input from the form
        $name = $request->input('name');
        $location = $request->input('location');

        //update data into a database
        $update = DB::update('update stores set name = ?, location = ? where id = ?', [$name, $location, $id]);

        //success message and return
        $message = toast('Store Details Updated Successfully', 'success')->autoClose(3000);
        return redirect('/owner/stores')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Stores::find($id);
        $store->delete();
        $message = toast('Store Deleted Successfully', 'success')->autoClose(3000);
        return redirect('/owner/stores')->with('message', $message);
    }
}
