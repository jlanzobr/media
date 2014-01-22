<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

require_once 'app/libraries/item.php';
require_once 'app/libraries/imdb.php';
require_once 'app/libraries/worker.php';

class WorkerRunCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'worker:run';

	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Run the IMDB worker.';

	/**
	* Create a new command instance.
	*
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Execute the console command.
	*
	* @return void
	*/
	public function fire()
	{
		set_time_limit(0);

		$films_worker = new Worker('/home/user/Films', 'Film');
		$television = new Worker('/home/user/Television', 'Television');
	}

	/**
	* Get the console command arguments.
	*
	* @return array
	*/
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	* Get the console command options.
	*
	* @return array
	*/
	protected function getOptions()
	{
		return array(
		);
	}

}

