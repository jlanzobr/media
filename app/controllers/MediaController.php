<?php

use Illuminate\Support\MessageBag;

class MediaController extends BaseController {

	public function displayMedia()
	{
		$title = 'Films';
		
		return View::make('media')->with('title', $title);
	}
	
	public function searchMedia()
	{
		
	}
	
}