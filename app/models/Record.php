<?php

Class Record extends Eloquent{

	public function scopeGetRecord($query, $id){
		return $query->join('clients as c','c.id','=','records.client_id')
			->join('employees as e','e.id','=','records.employee_id')
			->select('records.id','c.id as client_id','records.date','c.lastname','c.firstname','records.remarks','records.due_date',
				'e.firstname as emp_name','records.notes','records.payments','records.balance')
			->where('c.id','=',$id);
	}

	public function scopeGetRecordAll($query){
		return $query->join('clients as c','c.id','=','records.client_id')
			->join('employees as e','e.id','=','records.employee_id')
			->select('records.id as records_id','c.id as client_id','records.date','c.lastname','c.firstname',
				'e.firstname as emp_name','records.payments');
	}

}