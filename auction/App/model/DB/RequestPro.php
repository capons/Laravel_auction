<?php

namespace App\model\DB;


use Illuminate\Database\Eloquent\Model;

class RequestPro extends Model {

	//public $timestamps = false;
	public $table = 'request';
	protected $fillable = array('promise_id','amount','users_id');
	
	function category(){
		$this->belongsTo('App\model\DB\Promise');
	}
	function user(){
		$this->belongsTo('App\User');
	}
	
}