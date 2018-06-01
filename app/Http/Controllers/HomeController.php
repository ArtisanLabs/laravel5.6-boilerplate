<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('home');
	}

	/**
	 * Show the password update page. Allow the user to change their password from within the system
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getPasswordPage() {
		return view('user.password');
	}
}
