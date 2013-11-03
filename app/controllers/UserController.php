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
			$credentials = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			);

			if(Auth::attempt($credentials))
			{
				return Redirect::to('/');
			}
			else
			{
				$data['errors'] = new MessageBag(array(
					'invalid_login' => 'Username and/or password invalid.'
				));
			}
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
	
	public function logoutHandler()
	{
		Auth::logout();
		return Redirect::route('login');
	}

}
