<?php

class UserController extends BaseController {

	public function loginHandler()
	{
		$input = Input::all();
		dd($input);
	}
	
	public function showLoginPage()
	{
		return View::make('login');
	}
	
}