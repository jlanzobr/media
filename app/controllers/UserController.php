<?php

class UserController extends BaseController {
	
	public function loginHandler()
	{
		// Process login here
	}
	
	public function showLoginPage()
	{
		return View::make('login');
	}
	
}