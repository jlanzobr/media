<?php

use Illuminate\Support\MessageBag;

class MediaController extends BaseController {

	public function displayMedia($model)
	{
		$title = ucfirst($model);
		
		
		$Model = new $model();
		
		$media = $Model::all();
		if(count($media) === 1)
		{
			$media = array($media);
		}
		
		return View::make('media')
			->with('title', $title)
			->with('media', $media);
	}
	
	public function searchMedia()
	{
		
	}
	
}
