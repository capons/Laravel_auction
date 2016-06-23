<?php

namespace App\model\DB;


use Illuminate\Database\Eloquent\Model;

class Requeste extends Model {

	//public $timestamps = false;
	public $table = 'request';
	protected $fillable = array('promise_id','amount','users_id');
	
	function category(){
		$this->belongsTo('App\model\DB\Promise');
	}
	function user(){
		$this->belongsTo('App\User');
	}

	/*
	function promise(){
		$this->belongsTo('App\Promise');
	}
	*/

}