<?php
 
class Worker
{
	/**
	* Path to the media directory
	* @var string
	*/
	protected static $directory = '';
	
	/**
	* Database Model to use
	* @var string
	*/
	protected static $model = '';
	
	/**
	* Items to work on
	* @var array
	*/
	protected $items = array();

	/**
	* Constructor automatically adds files from $directory to Database $model
	* @var array
	*/
	public function __construct()
	{
		$this->setItems();
		$this->work();
	}
	
	/**
	* For each item, check if it's already in the database
	* If it is, update its information from IMDB
	* If not, create a new entry
	*/
	private function work()
	{
		foreach($this->getItems() as $item)
		{
			$imdb = new IMDB($item);
			$media_object = $imdb->getMediaObject();
			if( ! $this->updateRow($media_object))
			{
				$DatabaseModel = static::$model;
				if( ! empty($media_object->extension))
				{
					$DatabaseModel::insert(array(
						'name' => $media_object->name,
						'year' => $media_object->year,
						'extension' => $media_object->extension,
						'description' => $media_object->description,
						'rating' => $media_object->rating,
						'imdb_id' => $media_object->imdb_id
					));
				}
				else
				{
					$DatabaseModel::insert(array(
						'name' => $media_object->name,
						'year' => $media_object->year,
						'description' => $media_object->description,
						'rating' => $media_object->rating,
						'imdb_id' => $media_object->imdb_id
					));
				}
			}
			
		}
	}

	/**
	* Update an existing database entry
	* @var array
	* @return bool
	*/
	private function updateRow($media_object)
	{	
		$DatabaseModel = static::$model;
		
		if( ! empty($media_object->imdb_id))
		{
			$query = $DatabaseModel::where('imdb_id', '=', $media_object->imdb_id);
			$row = $query->first();
		}
		else
		{
			$row = null;
		}
		
		if(empty($row))
		{
			$query = $DatabaseModel::where('name', '=', $media_object->name);
			if( ! empty($media_object->year))
			{
				$query = $query->where('year', '=', $media_object->year);
			}
			$row = $query->first();
		}
		
		if( ! empty($row))
		{
			$query->update(array(
				'description' => $media_object->description,
				'rating' => $media_object->rating
			));
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	* Return array of file/directory information arrays
	* @return array
	*/
	private function setItems()
	{
		$working_directory = static::$directory;
		$media = new Item($working_directory);
		$this->items = $media->getItems();
		unset($media);
		
		return $this;
	}
	
	/**
	* Return array of file/directory information arrays
	* @return array
	*/
	public function getItems()
	{
		return $this->items;
	}

}
