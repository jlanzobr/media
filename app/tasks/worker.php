<?php

require 'bootstrap/autoload.php';
require_once 'bootstrap/start.php';
require_once 'app/libraries/item.php';
require_once 'app/libraries/imdb.php';
require_once 'app/libraries/worker.php';

set_time_limit(0);

class FilmsWorker extends Worker
{
	/**
	* Path to the media directory
	* @var string
	*/
	protected static $directory = '/home/user/Films';
	
	/**
	* Database Model to use
	* @var string
	*/
	protected static $model = 'Film';
	
	public function __construct()
	{
		parent::__construct();
	}
	
}

class TelevisionWorker extends Worker
{
	/**
	* Path to the media directory
	* @var string
	*/
	protected static $directory = '/home/user/Television';
	
	/**
	* Database Model to use
	* @var string
	*/
	protected static $model = 'Television';
	
	public function __construct()
	{
		parent::__construct();
	}
	
}

$films_worker = new FilmsWorker();
$television = new TelevisionWorker();

