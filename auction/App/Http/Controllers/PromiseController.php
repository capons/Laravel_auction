<?php

namespace App\Http\Controllers;


use App\Library\UpBid;  //class to sort update winners bid data
use App\Library\AuctionEnd;
use App\model\DB\Category;
use App\model\DB\File;
use App\model\DB\Location;
use App\model\DB\Promise;
use App\model\DB\Requeste;
use App\model\DB\Winner;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Input;
use Session;
use DB;

class PromiseController extends Controller {
	use AuctionEnd;

	protected $redirectTo = '/promise/sell';

	public function __construct(){
		$this->auctionOver();
	}

	public function validation(array $data){
		$messages = [          //validation message
			'prom_category.required' => 'Category is required',
			'prom_location.required' => 'Location is required',
			'prom_title.required' => 'Title is required',
			'prom_title.max:50' => 'Title length max 50',
			'prom_available_time.required' => 'Promise amount is required',
			'prom_available_time.max:20' => 'Promise length-no more than 20 characters',
			'prom_desc.required' => 'Promise description is required',
			'prom_desc.max:150' => 'Promise description max 150 character',
			'prom_terms.required' => 'Promise terms is required',
			'prom_terms.max:150' => 'Promise terms max 150 character',
			'prom_price.required' => 'Promise price is required',
			'prom_auction_number.required' => 'Promise auction amount is required',
			'prom_upload.required' => 'Promise image is required',
			'prom_auction_end.required' => 'Auction expired required',
			'prom_auction_end.numeric' => 'Insert auction active days '
		];
		return Validator::make($data, [   //validation registration form
			'sell_promise_type' => 'numeric',
			'prom_category' => 'required',
			'prom_location' => 'required',
			'prom_title' => 'required|string|max:50',
			'prom_available_time' => 'required|numeric|max:20',
			'prom_desc' => 'required|max:150',
			'prom_terms' => 'required|max:150',
			'prom_auction_number' => 'required|numeric',
			'shows' => '',
			'prom_price' => 'required|numeric',
			'prom_upload' => 'required',
			'prom_auction_end' => 'required|numeric',
		],$messages);
	}


	public function pageSell(){ //sell promise view
		$category = Category::all();
		$location = Location::all();
		return view('promise.sell',['category' => $category,'location' => $location]);
	}

	public function add(Request $request){ //add promise for sale and auction
		$error = array();
		if(Input::get('sell_promise_type') == 0) { //if check promise to sell
			if (!$request->input('select_image_from_our_database')) { // input to upload file from our database
				$validator = $this->validation($request->all());
				if ($validator->fails()) {
					return redirect('promise/sell')
						->withInput()
						->withErrors($validator);
				} else {
					$v = Validator::make($request->all(), [
						'file' => 'mimes:jpeg,bmp,png',
					]);
					if ($v->fails()) {
						return $v->errors();
					} else {
						$file = \Request::file('prom_upload');
						$path = \Config::get('app.setting.upload') . '\\' . \Auth::user()->id;
						$name = time() . '.' . $file->getClientOriginalExtension();
						if ($file->move($path, $name)) {
							$file = File::create(['name' => $name, 'path' => $path, 'users_id' => \Auth::user()->id, 'url' => \Config::get('app.setting.url_upload') . '/' . \Auth::user()->id]);
						}
					}
				}
			} else {
				$file = File::find($request->input('select_image_from_our_database')); //input containes id of our image in database
			}
				$promise_value = Input::get('prom_available_time');

				$data = array( 
					'title' => Input::get('prom_title'),
					'description' => Input::get('prom_desc'),
					'price' => round((float)Input::get('prom_price'), 2), //round for 2 decimel
					'terms' => Input::get('prom_terms'),
					'type' => Input::get('sell_promise_type'),       //if type 0 => (for sale) if type 1 => (auction)
					'winners' => Input::get('prom_auction_number'),
					'file_id' => $file->id,                         //image upload id
					'category_id' => Input::get('prom_category'),
					'location_id' => Input::get('prom_location'),
				);

				$promise = Promise::create($data);
				if (!$promise) {
					$error[] = \Lang::get('message.error.save_db');
				} else {
					$request_data = array(
						'promise_id' => $promise->id, //last save promise id
						'amount' => $promise_value,
						'users_id' => \Auth::user()->id,
					);

					$p_request = Requeste::create($request_data);
					if (!$p_request) {
						$error[] = \Lang::get('message.error.save_db');
					} else {
						/*
						$winners_data = array (
							'promise_id' => $promise->id
						);
						$w_request = Winner::create($winners_data);
						if (!$w_request) {
							$error[] = \Lang::get('message.error.save_db');
						}
						*/
						Session::flash('user-info', 'Promise added successfully'); //send message to user via flash data
						return redirect($this->redirectTo);
						die();
					}

				}
		} elseif (Input::get('sell_promise_type') == 1){ //if check promise auction
			$error = array();
			if (!$request->input('select_image_from_our_database')) { // input to upload file from our database
				$validator = $this->validation($request->all());
				if ($validator->fails()) {
					/*
                    $this->throwValidationException(
                        $request, $validator
                    );
                    */
					return redirect('promise/sell')
						->withInput()
						->withErrors($validator);
				} else {
					$v = Validator::make($request->all(), [
						'file' => 'mimes:jpeg,bmp,png',
					]);
					if ($v->fails()) {
						return $v->errors();
					} else {
						$file = \Request::file('prom_upload');
						$path = \Config::get('app.setting.upload') . '\\' . \Auth::user()->id;
						$name = time() . '.' . $file->getClientOriginalExtension();
						if ($file->move($path, $name)) {
							$file = File::create(['name' => $name, 'path' => $path, 'users_id' => \Auth::user()->id, 'url' => \Config::get('app.setting.url_upload') . '/' . \Auth::user()->id]);
						}
					}
				}
			} else {
				$file = File::find($request->input('select_image_from_our_database')); //input containes id of our image in database
			}
			$promise_value = Input::get('prom_available_time'); //number of Promises for sale
			$auction_days = Input::get('prom_auction_end'); //days auction end
			$to_change = '+ '.$auction_days.' day';
			$date = date("Y-m-d H:i:s");
			$date = strtotime($date);
			$date = strtotime($to_change, $date); //date in future when auction is expired
			$number_of_winners = Input::get('prom_auction_number');
			$winners_array = array();


			$data = array(
				'title' => Input::get('prom_title'),
				'description' => Input::get('prom_desc'),
				'price' => Input::get('prom_price'),
				'terms' => Input::get('prom_terms'),
				'type' => Input::get('sell_promise_type'),       //if type 0 => (for sale) if type 1 => (auction)
				'winners' => Input::get('prom_auction_number'),
				'file_id' => $file->id,                         //image upload id
				'auction_end' => date("Y-m-d H:i:s",$date),     //date auction expire
				'category_id' => Input::get('prom_category'),
				'location_id' => Input::get('prom_location'),
			);
			$promise = Promise::create($data);
			if (!$promise) {
				$error[] = \Lang::get('message.error.save_db');
			} else {
				$request_data = array(
					'promise_id' => $promise->id, //last save promise id
					'amount' => $promise_value,
					'users_id' => \Auth::user()->id,
				);
				$p_request = Requeste::create($request_data);
				if (!$p_request) {
					$error[] = \Lang::get('message.error.save_db');
				} else {
					/*
					$str = '';
					for($i = 0; $i < $number_of_winners; $i++) {
						$str .= '('.$promise->id.')'.',';
					}
					$str = substr($str, 0, -1); // remove last character from string
					$w_request = DB::insert('insert into winners (promise_id) values '.$str.' ');
					if (!$w_request) {
						$error[] = \Lang::get('message.error.save_db');
					}
					*/
					Session::flash('user-info', 'Promise added successfully'); //send message to user via flash data
					return redirect($this->redirectTo);
				}

			}
		}
	}

	/* query to display category promise
	public function getData(Request $request){
		$value = $request->input('value');
		if($request->input('type') == 1){
			$req = Promise::where('active','=', 1);
			if($value){
				$req = $req->where('category_id','=',$value);
			}
			$req = $req->join('file', 'file_id', '=', 'file.id')->select('file.url','file.name','title','price','desc','promise.id')->get();
			return ['data' => $req];
		}
	}
	*/
	/*
	public function addRequest(Request $request){
		$error = '';
		$this->validation($request);
		$data = array_merge($request->all(),['type' => 2]);
		$promise = Promise::create($data);
		if(!$promise){
			$error = \Lang::get('message.error.save_db');
		}
		return ['error' => $error];
	}
	*/
	//promise buy view
	public function promiseBuy(){

		$category = Category::all();
		/*
		$promise = DB::table('promise')
			->join('category','promise.category_id', '=', 'category.id')
			->join('file','promise.file_id', '=', 'file.id')
			->join('request', 'promise.id', '=', 'request.promise_id')
			->join('users', 'users.id', '=', 'request.users_id')
			->select('promise.id','promise.title','promise.description','promise.price','promise.type','promise.auction_end','promise.active','category.name as category_name','file.path as file_path','file.url','file.name as file_name','request.amount', 'users.f_name')
    		->get();
		*/

		$promise = \DataSet::source(
			DB::table('promise')
			->join('category','promise.category_id', '=', 'category.id')
			->join('file','promise.file_id', '=', 'file.id')
			->join('request', 'promise.id', '=', 'request.promise_id')
			->join('users', 'users.id', '=', 'request.users_id')
			->select('promise.id','promise.title','promise.description','promise.price','promise.type','promise.auction_end','promise.active','category.name as category_name','file.path as file_path','file.url','file.name as file_name','request.amount', 'users.f_name')
			->where('promise.active','=',1)
			->where('request.amount','<>',0) //not equal 0
		);
		//$promise->addOrderBy(['title','id']);
		$promise->paginate(2);
		//$promise->build();
		$promise->build();



		return view('promise.buy',['category' => $category],compact('promise'));

	}
	//Promise buy
	public function buy(Request $request){
		Validator::make($request->all(), [
			'promise_id' => 'numeric',
			'promise_amount' => 'numeric',
			'promise_price' => 'numeric'
		]);
		$promise_id = $request->input('promise_id');
		$amount = $request->input('promise_amount');
		$price = $request->input('promise_price');
		$promise = DB::table('promise')
			->join('request', 'promise.id', '=', 'request.promise_id')
			->select('promise.id','promise.price','promise.type','promise.active','request.amount')
			->where('promise.id','=',$request->input('promise_id'))
			->where('promise.active','=',1)
			->where('promise.type','=',0)
			->first();
		if($promise->amount >= $amount){  //change amount of promise and create winner data
			DB::beginTransaction();
			try {
				DB::table('request')   //change amount
					->where('promise_id', $promise_id)
					->update(['amount' => $promise->amount - $amount]);
			} catch (ValidationException $e) {
				DB::rollback();
				return Redirect::to('promise/buy')
					->withErrors( $e->getErrors() )
					->withInput();
			} catch (\Exception $e) {
				DB::rollback();
				throw $e;
			}
			try {
				$winner = DB::table('winners')->insertGetId( //save buyer information
					['promise_id' => $promise_id, 'bid' => $price, 'winner_id' => \Auth::user()->id]
				);
			} catch (ValidationException $e) {
				DB::rollback();
				return Redirect::to('promise/buy')
					->withErrors( $e->getErrors() )
					->withInput();
			} catch (\Exception $e) {
				DB::rollback();
				throw $e;
			}
			DB::commit();

			Session::flash('user-info', 'Thank you for your purchase, your order number'.' '.$winner); //send message to user via flash data
			return redirect('promise/buy');
		} else {
			Session::flash('user-info', 'Not enough product'); //send message to user via flash data
			return redirect('promise/buy');
		}
	}
	//promise auction buy
	public function buyAuction(Request $request){
		$messages = [ //validation message
			'au_promise_bid.required' => 'Bid is required',
			'au_promise_bid.numeric' => 'Bid is numeric'
		];
		//$validator = Validator::make(Input::all(), $rules,$messages);
		$validator = Validator::make($request->all(), [
			'au_promise_id' => 'numeric',
			'au_promise_bid' => 'numeric|required'
		], $messages);
		if ($validator->fails()) { //if true display error
			return redirect('/promise/details/'.$request->au_promise_id)
				->withInput()
				->withErrors($validator); //set validation error name to display in error layout  views/common/errors.blade.php
		} else {
			$promise_id = Input::get('au_promise_id');
			$promise_bid = round((float)Input::get('au_promise_bid'), 2); //promise price
			if($this->auctionCheckTime($promise_id) == false){            //check auction end time
				Session::flash('user-info', \Lang::get('message.error.auction_end_time')); //send message to user via flash data
				return redirect('promise/buy');
				die();
			}
			$winner = DB::table('winners')
				->where('promise_id','=',$promise_id)
				->get();
			if(count($winner) == 0){ //check first auction bid or no -> true if first bid
				$promise = DB::table('promise')
					->join('request', 'promise.id', '=', 'request.promise_id')
					->select('promise.id','promise.price','promise.auction_end')
					->where ('promise.id', '=' , $promise_id)
					->first();
				$promis_min_bid = $promise->price; //auction min price
				if($promise_bid <= $promis_min_bid ){ // if auction bit < price die()
					Session::flash('user-info', \Lang::get('message.error.auction_min_bid').' '.$promise->price); //send message to user via flash data
					return redirect('promise/details/'.$promise_id);
					die();
				}
				$new_winner = DB::table('winners')->insert(
					['promise_id' => $promise_id, 'bid' => $promise_bid,'winner_id' => \Auth::user()->id]
				);
				if($new_winner){ //true if mysql return true
					Session::flash('user-info', \Lang::get('message.promise.true_bid')); //send message to user via flash data
					return redirect('promise/buy');
				} else {
					Session::flash('user-info', \Lang::get('message.error.error')); //send message to user via flash data
					return redirect('promise/details/'.$promise_id);
				}
			} else {             //true if auction already have bids
				if($this->auctionCheckTime($promise_id) == false){ //check auction end time
					Session::flash('user-info', \Lang::get('message.error.auction_end_time')); //send message to user via flash data
					return redirect('promise/buy');
					die();
				}
				$promise = Promise::find($promise_id);
				if($promise->winners == count($winner)) { //if auction winner count full
					$winners_data = json_decode(json_encode($winner), true); //winners array
					$update_bid = new UpBid();
					$up_bid = $update_bid->changeBid($winners_data);


					if ($promise_bid <= $up_bid['check_data']['user_old_bid']) { //if current bid < old_bid => true | $promise_bid 350 line
						Session::flash('user-info', \Lang::get('message.error.auction_min_bid') . ' ' . $up_bid['check_data']['user_old_bid']); //send message to user via flash data
						return redirect('promise/details/' . $promise_id);
						die();
					}

					$update_auction = DB::table('winners')
						//->where('winner_id', \Auth::user()->id)
						->where('promise_id', $promise_id)
						->where('bid', $up_bid['update_data']['user_old_bid'])
						->update(['bid' => $promise_bid,'winner_id' => \Auth::user()->id]);
					if ($update_auction) {
						Session::flash('user-info', \Lang::get('message.promise.true_bid')); //send message to user via flash data
						return redirect('promise/buy');
					} else {
						Session::flash('user-info', \Lang::get('message.error.error')); //send message to user via flash data
						return redirect('promise/buy');
					}
				} else {                             //if auction winner count not full
					$winners_data = json_decode(json_encode($winner), true); //winners array
					$update_bid = new UpBid();
					$next_winner_bid = $update_bid->changeBid($winners_data);

					if ($promise_bid <= $next_winner_bid['check_data']['user_old_bid']) { //if current bid < $next_winner_bid => true | $promise_bid -> 350 line
						Session::flash('user-info', \Lang::get('message.error.auction_min_bid') . ' ' . $next_winner_bid['check_data']['user_old_bid']); //send message to user via flash data
						return redirect('promise/details/' . $promise_id);
						die();
					}

					$new_winner = DB::table('winners')->insert(
						['promise_id' => $promise_id, 'bid' => $promise_bid,'winner_id' => \Auth::user()->id]
					);
					if($new_winner){ //true if mysql return true
						Session::flash('user-info', \Lang::get('message.promise.true_bid'));
						return redirect('promise/buy');
					} else {
						Session::flash('user-info', \Lang::get('message.error.error'));
						return redirect('promise/details/'.$promise_id);
					}
				}
			}
		}
	}
	protected function auctionCheckTime($promise_id){
		$promise = DB::table('promise')
			->join('request', 'promise.id', '=', 'request.promise_id')
			->select('promise.id','promise.price','promise.auction_end')
			->where ('promise.id', '=' , $promise_id)
			->first();
		$end_time = strtotime($promise->auction_end); //auction end time
		if (time() > $end_time) { //check auction time end or no
			return false; //if auction end -> return false
		} else {
			return true;
		}
	}
	/*
	public function check()
	{
		$msg = [];
		$id = \Request::input('id');
		//return ['check' => \App\model\DB\Promise::find($id)->request()->orderBy('amount', 'desc')->first()->users_id];
		$promise = \App\model\DB\Promise::find($id);
		if ($promise->request->isEmpty()) {
			$msg['check'] = false;
		} else {
			if ($promise->request()->orderBy('amount', 'desc')->first()->users_id == \Auth::user()->id) {
				$msg['check'] = true;
			} else {
				$msg['check'] = false;
			}
		}
		return $msg;
	}
	*/

	public function getPromiseByCategory(){
		$cat = \Request::input('category');
		$promise = Promise::select('file.name','file.url','promise.*');
		if($cat != 0){
			$promise = $promise->where('category_id',$cat);
		}
		$promise = $promise->join('file','promise.file_id','=','file.id')->get();
		return $promise->toArray();
	}



	public function pageRequest(){
		$category = Category::all();
		return view('promise.request', ['category' => $category]);
	}

	public function pageBuy(){

		return view('promise.buy', [
			'category' => Category::all()
		]);
	}

	public function pageProfile($id){
		$promise = Promise::find($id);
		$req = $promise->request()->orderBy('amount', 'desc')->first();
		return view('promise.profile', ['promise' => $promise, 'request' => $req]);
	}

	public function pageBuypromise(){
		$promise = Promise::where('active',1)->get();
		$cat = Category::all();
		return view('promise.buypromise', ['promise' => $promise,'category' => $cat]);
	}

}