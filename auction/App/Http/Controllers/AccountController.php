<?php

namespace App\Http\Controllers;

use App\model\DB\Promise;
use App\model\DB\Request;

class AccountController extends Controller {
	
	function getIndex(){ //account index page
		return view('account.index');
	}

	function pageBroughtpromise(){

		return view('account.broughtpromise');
	}
	function pageOtherpromise(){

		return view('account.otherpromise');
	}
	function pageSellpromise(){

		return view('account.sellpromise');
	}
	function pageYourpromise(){
		$request = Promise::where('winner_id', \Auth::user()->id)->get();
		return view('account.yourpromise', ['request' => $request]);
	}
	function requestePromise(){
		
		return view('account.requestedpromises');
	}
}