<?php
 
class Worker
{
	/**
	* Path to the media directory
	* @var string
	*/
	protected $start_time = null;
	
	/**
	* Current item being processed
	* @var string
	*/
	protected $current_item = null;
	
	/**
	* Number of items to be processed
	* @var string
	*/
	protected $total_items = null;
	
	/**
	* Path to the media directory
	* @var string
	*/
	protected $directory = '';
	
	/**
	* Database model to use
	* @var string
	*/
	protected $model = '';
	
	/**
	* Items to work on
	* @var array
	*/
	protected $items = array();

	/**
	* Constructor automatically adds files from $directory to Database $model
	* @var array
	*/
	public function __construct($directory, $model)
	{
		$this->setDirectory($directory);
		$this->setModel($model);
		$this->setItems();
		$this->initializeStatistics();
		
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
				$DatabaseModel = new $this->model;
				if( ! empty($media_object->extension))
				{
					$DatabaseModel->name = $media_object->name;
					$DatabaseModel->year = $media_object->year;
					$DatabaseModel->extension = $media_object->extension;
					$DatabaseModel->description = $media_object->description;
					$DatabaseModel->rating = $media_object->rating;
					$DatabaseModel->imdb_id = $media_object->imdb_id;
					$DatabaseModel->save();
				}
				else
				{
					$DatabaseModel->name = $media_object->name;
					$DatabaseModel->year = $media_object->year;
					$DatabaseModel->description = $media_object->description;
					$DatabaseModel->rating = $media_object->rating;
					$DatabaseModel->imdb_id = $media_object->imdb_id;
					$DatabaseModel->save();
				}
			}
			
			$this->updateProgress();
		}
	}

	/**
	* Update an existing database entry
	* @var array
	* @return bool
	*/
	private function updateRow($media_object)
	{	
		$DatabaseModel = new $this->model;
		
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
	* Scan the media directory and populate $items with its contents
	* @return array
	*/
	private function setItems()
	{
		$working_directory = $this->directory;
		$media = new Item($working_directory);
		$this->items = $media->getItems();
		unset($media);
		
		return $this;
	}
	
	/**
	* Set the path to the media directory
	* @return array
	*/
	private function setDirectory($directory)
	{
		$this->directory = $directory;
		
		return $this;
	}
	
	/**
	* Set the database model to use
	* @return array
	*/
	private function setModel($model)
	{
		$this->model = $model;
		
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
	
	/**
	* Write the progress of the worker to the console
	* @return void
	*/
	public function initializeStatistics()
	{
		$this->start_time = microtime(true);
		$this->current_item = 0;
		$this->total_items = count($this->items);
		
		return $this;
	}
	
	/**
	* Write the progress of the worker to the console
	* @return void
	*/
	public function updateProgress()
	{
		$this->current_item = $this->current_item + 1;
		$time_elapsed = microtime(true) - $this->start_time;
		$progress_percent = round(($this->current_item / $this->total_items) * 100, 3);
		$progress = $progress_percent."% Complete    Time Elapsed: ".round($time_elapsed, 3)." seconds \r";
		fputs(STDOUT, $progress);
		
		return $this;
	}

}
