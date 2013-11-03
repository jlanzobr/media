<?php 

class Item
{
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

	public function __construct($path = '')
	{
		$this->getDirectoryContents($path);
		$this->processItems();
	}

	function getDirectoryContents($path)
	{
		$raw_directory_contents = scandir($path);
		$this->directory_contents = array_diff($raw_directory_contents, array('..', '.'));
		
		return $this;
	}

	public function processItems()
	{
		foreach($this->directory_contents as $name)
		{
			$this->items[] = $this->getProperties($name);
		}
		
		return $this;
	}

	function getProperties($name)
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
	
}