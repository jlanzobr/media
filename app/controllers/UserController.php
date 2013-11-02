<?php

use Illuminate\Support\MessageBag;

class UserController extends BaseController {

	public function loginHandler()
	{
		$input = Input::all();
		$data = array();
		
		if($old = Input::old('errors'))
		{
			$data['errors'] = $old;
		}

		$validator = Validator::make($input, array(
			'username' => 'required',
			'password' => 'required'
		));

		if($validator->passes())
		{
			return Redirect::to('/');
		}
		else
		{
			$data['errors'] = $validator->messages();
		}
		
		return View::make('login', $data);
	}
	
	public function showLoginPage()
	{
		return View::make('login');
	}
	
}