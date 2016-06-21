<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class AdminPromiseController extends Controller {

    private $access = ''; //variable shows user access rights

    public function __construct()
    {
        $this->access = Auth::user()->access;
    }
    public function pagePromise(){

        if($this->access == 2) {
            return view('admin.promise');
        } else {
            Session::flash('user-info', 'Sorry you have no rights'); //send message to user via flash data
            return redirect('/');
        }
    }
}