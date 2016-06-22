<?php

namespace App\model\DB;


use Illuminate\Database\Eloquent\Model;

class Promise extends Model {

	protected $fillable = array('title','description','price','file_id','category_id','type','time','featured','auction_end','winners','shows','location_id','winner_id');
	public $table = 'promise';
	
	function category(){
		$this->belongsTo('App\model\DB\Category');
	}
	function file(){
		return $this->belongsTo('App\model\DB\File');
	}
	function location(){
		return $this->belongsTo('App\model\DB\Location');
	}

	function requestPro(){
		return $this->hasMany('App\model\DB\RequestPro');
	}
	

}