<?php

class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$client = null;
		if(Auth::user()->user_level === 'Admin'){
			$client = Client::empPerClientAdmin()->get();
		}
		else{
			$client = Client::empPerClient(Auth::user()->firstname)->get();	
		}

        return View::make('client.index')
            ->with('client', $client);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('client.create');
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
            'employee_id'		=> 'required'	
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('client/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $client = new Client;
            $client->lastname		= Input::get('lastname');
            $client->firstname		= Input::get('firstname');
            $client->employee_id	= Input::get('employee_id');
            $client->save();

            // redirect
            Session::flash('message', 'Client Successfully Created!');
            return Redirect::to('client');
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
		//$client = Client::find($id);
		$client = Client::select('clients.id','clients.firstname','clients.lastname')->find($id);
		$record = Record::getRecord($id)->get();
        return View::make('client.show', array('client' => $client, 'record' => $record));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = Client::find($id);

        return View::make('client.edit')
            ->with('client', $client);
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
            return Redirect::to('client/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $client = Client::find($id);
            $client->lastname	= Input::get('lastname');
            $client->firstname	= Input::get('firstname');
            $client->save();

            // redirect
            Session::flash('message', 'Client Successfully Edited!');
            return Redirect::to('client');
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
        $client = Client::find($id);
        $client->delete();

        // redirect
        Session::flash('message', 'Client Deleted!');
        return Redirect::to('client');
	}

//Record Section
	public function addRecord($id){

		$client = Client::find($id);
		$fullname = Client::getFullname()->lists('fullname','id');
		return View::make('client.addRecord')
			->with('client', $client)
			->with('fullname', $fullname);

	}

	public function handleAddRecord($id){
		$rules = array(
            'date'      	=> 'required',
            'client_id'   	=> 'required',
            'remarks'     	=> 'required',
            'due_date'     	=> 'required',
            'employee_id' 	=> 'required',
            'notes'     	=> 'required',	
            'payments'     	=> 'required|numeric',		
            'balance'     	=> 'required|numeric',				
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('client/' . $id . '/addRecord')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
	            $record 				= new Record;
	            $record->date 			= Input::get('date');
	            $record->client_id 		= Input::get('client_id');
	            $record->remarks 		= Input::get('remarks');
	            $record->due_date 		= Input::get('due_date');
	            $record->employee_id 	= Input::get('employee_id');
	            $record->notes 			= Input::get('notes');
	            $record->payments 		= Input::get('payments');
	            $record->balance 		= Input::get('balance');
	            $record->save();

            // redirect
            Session::flash('message', 'Record Successfully Added!');
            return Redirect::to('client/'.Input::get('client_id'));
        }
	}

	public function updateRecord($id){
		$client = Client::find($id);
		//checking or verify client
		$record = Record::where('client_id','=',$client->id)->orderBy('id','desc')->get()->first();
		return View::make('client.updateRecord')
			->with('client', $client)
			->with('record', $record);
	}

	public function handleUpdateRecord(){
		$rules = array(
            'date'      	=> 'required',
            'record_id'   	=> 'required',
            'client_id'   	=> 'required',
            'remarks'     	=> 'required',
            'due_date'     	=> 'required',
            'employee_id' 	=> 'required',
            'notes'     	=> 'required',
            'payments'     	=> 'required|numeric',		
            'balance'     	=> 'required|numeric',				
        );
        $client = Client::find(Input::get('client_id'));
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('client/updateRecord/' . $client->id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            	$prev_record 			= Record::where('id','=',Input::get('record_id'))->orderBy('id','desc')->get()->first();
	            $record 				= new Record;
	            $record->client_id 		= Input::get('client_id');
	            $record->date 			= Input::get('date');
	            $record->remarks 		= Input::get('remarks');
	            $record->due_date 		= Input::get('due_date');
	            $record->employee_id 	= Input::get('employee_id');
	            $record->notes 			= Input::get('notes');
	            $record->payments 		= Input::get('payments');
	            $record->balance 		= $prev_record->balance - Input::get('payments');
	            $record->save();

            // redirect
            Session::flash('message', 'Record Successfully Updated!');
            return Redirect::to('client/' . $client->id);
        }
	}

	public function detailedReport(){
		$client = Client::select('clients.id','clients.firstname','clients.lastname')->get();
		$record = Record::getRecordAll()->get();
        return View::make('report.index', array('client' => $client, 'record' => $record));
	}

}
