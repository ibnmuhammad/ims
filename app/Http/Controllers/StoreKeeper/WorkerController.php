<?php

namespace App\Http\Controllers\StoreKeeper;

use App\Models\User;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $workers = Employees::where('managedBy', '=', [$user_id])->get();
        return view('storekeeper.workers.index')->with('workers', $workers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storekeeper.workers.create');
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
            'phonenumber' => 'required',
            'gender' => 'required',
            // 'store' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password1' => 'required'
        ]);

        $email = $request->input('email');
        $phonenumber = $request->input('phonenumber');
        
        $checkEmail = DB::select('select * from users where email = ?', [$email]);
        $checkPhone = DB::select('select * from employees where phonenumber = ?', [$phonenumber]);
        // return $checkEmail;
        if($checkEmail)
        {
            $message = toast('Entered e-Mail already exist', 'error')->autoClose(3500);
            return redirect('/storekeeper/workers/create')->with('message', $message);
        }
        elseif($checkPhone)
        {
            $message = toast('Entered Phone Number already exist', 'error')->autoClose(3500);
            return redirect('/storekeeper/workers/create')->with('message', $message);
        }
        else
        {
            $user_id = Auth()->user()->id;
            $storeID = DB::table('employees')->where('user_id', $user_id)->value('storeID');
            $name = $request->input('name');
            $gender = $request->input('gender');
            $store = $storeID;
            $username = $name;
            $password = $request->input('password');
            $password1 = $request->input('password1');

            if ($password == $password1)
            {
                //create new user account
                $user = new User();
                $user->username = $username;
                $user->email = $email;
                $user->role = 'worker';
                $user->password = Hash::make($password);
                $user->save();
                $user->attachRole('worker');

                $emp = DB::table('users')->where('email', $email)->value('id');
                // return $emp;
                //add worker details
                $user_id = Auth()->user()->id;

                $employee = new Employees();
                $employee->name = $name;
                $employee->phonenumber = $phonenumber;
                $employee->gender = $gender;
                $employee->user_id = $emp;
                $employee->managedBy = $user_id;
                $employee->storeID = $store;
                $employee->save();

                $message = toast('Worker account details added successfully', 'success')->autoClose(3500);
                return redirect('/storekeeper/workers')->with('message', $message);
            }
            else
            {
                $message = toast('Entered Password does not match', 'error')->autoClose(3500);
                return redirect('/storekeeper/workers/create', 'error')->with('message', $message);
            }
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
        // $worker = Employees::find($id);
        // return view('storekeeper.workers.edit')->with('worker', $worker);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //catch user_id of a worker so as to delete his/her records from users and employees table
        $emp = Employees::where('id', '=', $id)->value('user_id');
        $user = User::find($emp);
        $user->delete();
        $message = toast('Worker Record Deleted Successfully', 'success');
        return redirect('/storekeeper/workers')->with('message', $message);
    }
}
