<?php

class EmployeeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $employee = Employee::all();

        return View::make('employee.index')
            ->with('employee', $employee);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('employee.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
            'lastname'      	=> 'required',
            'firstname'     	=> 'required',
            'username'			=> 'required',
            'password'			=> 'required',
            'password_confirm'	=> 'required|same:password',	
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('employee/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $employee = new Employee;
            $employee->lastname		= Input::get('lastname');
            $employee->firstname	= Input::get('firstname');
            $employee->username 	= Input::get('username');
            $employee->password 	= Hash::make(Input::get('password'));
            $employee->user_level 	= Input::get('user_level');
            $employee->save();

            // redirect
            Session::flash('message', 'Employee Successfully Created!');
            return Redirect::to('employee');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		 $employee = Employee::find($id);
		 $clientList = Employee::clientList($id)->get();
        return View::make('employee.show')
            ->with('employee', $employee)
            ->with('clientList', $clientList);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $employee = Employee::find($id);

        return View::make('employee.edit')
            ->with('employee', $employee);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
            'lastname'      	=> 'required',
            'firstname'     	=> 'required',	
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('employee/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $employee = Employee::find($id);
            $employee->lastname		= Input::get('lastname');
            $employee->firstname	= Input::get('firstname');
            $employee->save();

            // redirect
            Session::flash('message', 'Employee Successfully Edited!');
            return Redirect::to('employee');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
        $employee = Employee::find($id);
        $employee->delete();

        // redirect
        Session::flash('message', 'Employee Deleted!');
        return Redirect::to('employee');
	}

	public function showLogin(){

		$employee = Employee::all();
		return View::make('login', compact('employee'));
	}

	public function doLogin(){

		$login = null;
		$username = Input::get('username');
		$password = Input::get('password');
		$rules = array(
			'username' => 'required',
			'password' => 'required|alphaNum|min:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our login back to the form with the errors from the validator
			return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
		}
		else{
			$login = array(
				'username' => $username,
				'password' => $password
			);
			if (Auth::attempt($login)) {
			    return Redirect::to('/')->with('message','You are now logged in');
			}

			else {
			    return Redirect::to('login')->with('message','Your username and password combination is incorrect');
			}
		}
	}

	public function doLogout(){
		Auth::logout(); // log the user out of our application
		return Redirect::to('login'); // redirect the user to the login screen
	}

}
