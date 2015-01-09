<?php

Class Client extends Eloquent{
	
	public function scopeEmpPerClient($query, $employee){
		return $query->join('employees as e','e.id', '=', 'clients.employee_id')
			->select('clients.id','clients.lastname','clients.firstname','e.firstname as emp_name')
			->where('e.firstname','=',$employee);
	}

	public function scopeEmpPerClientAdmin($query){
		return $query->join('employees as e','e.id', '=', 'clients.employee_id')
			->select('clients.id','clients.lastname','clients.firstname','e.firstname as emp_name');
	}

	public function scopeGetFullname($query){
		return $query->select(DB::raw('concat(clients.lastname, ", ", clients.firstname) as fullname, clients.id'));
	}

}