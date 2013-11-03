<?php 

class Item
{
	/**
	* Contents of the directory
	* @var array
	*/
	protected $path = '';
	
	/**
	* Contents of the directory
	* @var array
	*/
	protected $directory_contents = array();
	
	/**
	* Contents of the directory
	* Each item is an array containing name, year, and extension (if exists)
	* @var array
	*/
	protected $items = array();

	/**
	* Constructor fills $directory_contents and $items
	*/
	public function __construct($path = '')
	{
		$this->setPath($path);
		$this->scanDirectory();
		$this->processItems();
	}

	/**
	* Set the path
	* @var string
	* @return Item
	*/
	private function setPath($path)
	{
		$this->path = $path;
		
		return $this;
	}
	
	/**
	* Gets the contents of the directory
	* @var string
	* @return Item
	*/
	private function scanDirectory()
	{
		$raw_directory_contents = scandir($this->path);
		$this->directory_contents = array_diff($raw_directory_contents, array('..', '.'));
		
		return $this;
	}

	/**
	* Use the contents of the directory classify file/directory information
	* @return Item
	*/
	private function processItems()
	{
		foreach($this->directory_contents as $name)
		{
			$this->items[] = $this->getProperties($name);
		}
		
		return $this;
	}

	/**
	* Classify file/directory information
	* @return Item
	*/
	private function getProperties($name)
	{
		 # Split $name on either side of year
		$year_pattern = '/ [(](\d{4})[)]/';
		$split_name = preg_split($year_pattern, $name);
		$split_name = array_filter($split_name);
		
		# Get name
		$properties['name'] = trim($split_name[0]);
		
		# Get extension
		if(count($split_name) > 1)
		{
			$extension = str_replace('.', '', $split_name[1]);
			$properties['extension'] = trim($extension);
		}
		
		# Get year
		preg_match($year_pattern, $name, $matches);
		if( ! empty($matches))
		{
			$year = preg_replace("/[^0-9,.]/", "", $matches[0]);
			$properties['year'] = trim($year);
		}
		
		return $properties;
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
	* Return array of files/directories in path
	* @return array
	*/
	public function getDirectoryContents()
	{
		return $this->directory_contents;
	}
	
}