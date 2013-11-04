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
		
		$results = array($media);
		
		return View::make('media')
			->with('title', $title)
			->with('results', $results);
	}
	
	public function searchMedia()
	{
		$title = 'Search';
		$query = Input::get('query');
		$query = '%'.$query.'%';
		
		$results = array();

		$matching_films = Film::where('name', 'like', $query)
			->orWhere('year', 'like', $query)
			->orWhere('description', 'like', $query)
			->get();
			
		$matching_television = Television::where('name', 'like', $query)
			->orWhere('year', 'like', $query)
			->orWhere('description', 'like', $query)
			->get();
		
		$results = array($matching_films, $matching_television);
		
		return View::make('media')
			->with('title', $title)
			->with('results', $results);
	}
	
	public function editMediaItem($model, $id)
	{
		$title = 'Edit '.ucfirst($model);
		
		$Model = new $model();
		
		$item = $Model::find($id);
		
		return View::make('edit')
			->with('title', $title)
			->with('item', $item);
	}
	
	public function saveMediaItem()
	{
		$imdb_id = Input::get('imdb_id');
		$id = Input::get('id');
		$model = Input::get('model');
		
		$Model = new $model;
		$item = $Model::find($id);
		$item->imdb_id = $imdb_id;
		$item->save();
		
		return Redirect::back();
	}
	
}
