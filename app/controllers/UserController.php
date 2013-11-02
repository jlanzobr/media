<?php

use Illuminate\Support\MessageBag;

class UserController extends BaseController {

	public function loginHandler()
	{
		$input = Input::all();

		$validator = Validator::make($input, array(
			"username" => "required",
			"password" => "required"
		));

		if($validator->passes())
		{
			return Redirect::to('/');
		}
		
		$data["errors"] = $validator->messages();
		
		return View::make("login", $data);
	}
	
	public function showLoginPage()
	{
		return View::make('login');
	}
	
}