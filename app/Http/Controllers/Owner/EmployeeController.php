<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $employees = Employees::where('managedBy', '=', [$user_id])->get();
        return view('owner.employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth()->user()->id;
        $store = Stores::where('user_id', '=', [$user_id])->get();
        return view('owner.employees.create')->with('store', $store);
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
            'store' => 'required',
            'email' => 'required',
            // 'username' => 'required',
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
            return redirect('/owner/employees/create')->with('message', $message);
        }
        elseif($checkPhone)
        {
            $message = toast('Entered Phone Number already exist', 'error')->autoClose(3500);
            return redirect('/owner/employees/create')->with('message', $message);
        }
        else
        {
            $name = $request->input('name');
            $gender = $request->input('gender');
            $store = $request->input('store');
            $username = $name;
            $password = $request->input('password');
            $password1 = $request->input('password1');

            if ($password == $password1)
            {
                //create new user account
                $user = new User();
                $user->username = $username;
                $user->email = $email;
                $user->role = 'storekeeper';
                $user->password = Hash::make($password);
                $user->save();
                $user->attachRole('storekeeper');

                $emp = DB::table('users')->where('email', $email)->value('id');
                // return $emp;
                //add employee details
                $user_id = Auth()->user()->id;

                $employee = new Employees();
                $employee->name = $name;
                $employee->phonenumber = $phonenumber;
                $employee->gender = $gender;
                $employee->user_id = $emp;
                $employee->managedBy = $user_id;
                $employee->storeID = $store;
                $employee->save();

                $message = toast('Employee account details added successfully', 'success')->autoClose(3500);
                return redirect('/owner/employees')->with('message', $message);
            }
            else
            {
                $message = toast('Entered Password does not match', 'error')->autoClose(3500);
                return redirect('/owner/employees/create', 'error')->with('message', $message);
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
        $user_id = Auth()->user()->id;
        $employee = Employees::find($id);
        $store = Stores::where('user_id', '=', $user_id)->get();
        return view('owner.employees.edit')->with('employee', $employee)->with('store', $store);
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
            'store' => 'required'
        ]);

        $store = $request->input('store');

        //update data into a table employee
        $update = DB::update('update employees set storeID = ? where id = ?', [$store, $id]);

        $message = toast('Employee Details updated successfully', 'success')->autoClose(3500);
        return redirect('/owner/employees')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //catch user_id of an employee so as to delete his/her records from users and employees table
        $emp = Employees::where('id', '=', $id)->value('user_id');
        $user = User::find($emp);
        // $user = DB::delete('delete from users where id = ?', [$emp]);
        $user->delete();
        $message = toast('Employee Record Deleted Successfully', 'success');
        return redirect('/owner/employees')->with('message', $message);
    }
}
