<?php

class IMDB
{
	/**
	* Open Movie Database IMDB API URL
	* @var string
	*/
	protected $omdb_url = 'http://www.omdbapi.com/';
	
	/**
	* Dean Clatworthy IMDB API URL
	* @var string
	*/
	protected $dean_clatworthy_url = 'http://deanclatworthy.com/imdb/';
	
	/**
	* Default IMDB API
	* Can be either 'omdb' or 'dean_clatworthy'
	* Note: Dean Clatworthy requests that no more than 30 requests be made to his API per hour,
	* so if his API is used, the program will wait 120 seconds between requests to it.
	* @var string
	*/
	protected $api = 'omdb';
	
	/**
	* IMDB Query URL
	* @var string
	*/
	protected $query_url = '';
	
	/**
	* File/directory information array
	* @var array
	*/
	protected $item = array();
	
	/**
	* Media information object
	* @var stdClass
	*/
	protected $media_object = false;
	
	/**
	* Constructor
	*/
	public function __construct($item = array(), $api = 'omdb')
	{
		$this->setItem($item);
		$this->setAPI($api);
		$this->setURL();
		$this->assembleObject();
	}
	
	/**
	* Set file/directory information
	* @var array
	* @return IMDB
	*/
	private function setItem($item)
	{
		$this->item = $item;
		
		return $this;
	}
	
	/**
	* Query IMDB
	* @return IMDB
	*/
	private function assembleObject()
	{
		$item = $this->item;
		
		$query_item = new stdClass;
		$query_item->name = $this->item['name'];
		if( ! empty($item['year']))
		{
			$query_item->year = $this->item['year'];
		}
		else
		{
			$query_item->year = null;
		}
		if( ! empty($item['extension']))
		{
			$query_item->extension = $this->item['extension'];
		}
		else
		{
			$query_item->extension = null;
		}
		
		$retries = 0;
		$data = false;
		while( ! $data and $retries < 10)
		{
			if($this->api === 'dean_clatworthy')
			{
				sleep(120);
			}
			
			$data = $this->executeQuery();
			$retries++;
		}
		
		if($data)
		{
			if($this->api === 'dean_clatworthy')
			{
				$query_item->description = $data['genres'];
				$query_item->rating = $data['rating'];
				$query_item->imdb_id = $data['imdbid'];
			}
			else
			{
				$query_item->description = $data['Plot'];
				$query_item->rating = $data['imdbRating'];
				$query_item->imdb_id = $data['imdbID'];
			}
		}
		else
		{
			$query_item->description = null;
			$query_item->rating = null;
			$query_item->imdb_id = null;
		}
		
		$this->media_object = $query_item;
		
		return $this;
	}
	
	/**
	* Generate the URL to query, based on API used
	* @var array
	* @return array, false
	*/
	private function executeQuery()
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->query_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$data = curl_exec($curl);
		curl_close($curl);
		
		if( ! empty($data))
		{
			$data = json_decode($data, true);
			
			if( ! empty($data['Response']) and $data['Response'] === 'False')
			{
				return false;
			}
			if( ! empty($data['error']) and $data['error'] === 'Film not found')
			{
				return false;
			}
			
			return $data;
		}
		
		return false;
	}
	
	/**
	* Generate the URL to query, based on API used
	* @var array
	* @return IMDB
	*/
	private function setURL($year = false)
	{
		$item = $this->item;
		
		if($this->api === 'dean_clatworthy')
		{
			$url = $this->dean_clatworthy_url;
		}
		else
		{
			$url = $this->omdb_url;
		}
		
		if( ! empty($item['imdb_id']))
		{
			if($this->api === 'dean_clatworthy')
			{
				$url .= '?id=';
			}
			else
			{
				$url .= '?i=';
			}
			
			$url .= urlencode($item['imdb_id']);
			$this->query_url = $url;
			
			return $this;
		}
		else
		{
			if( ! empty($item['name']))
			{
				if($this->api === 'dean_clatworthy')
				{
					$url .= '?q=';
				}
				else
				{
					$url .= '?t=';
				}
				
				$url .= urlencode($item['name']);
			}
			
			if($year and ! empty($item['year']))
			{
				if($this->api === 'dean_clatworthy')
				{
					$url .= '?year=';
				}
				else
				{
					$url .= '?y=';
				}
				
				$url .= urlencode($item['year']);
			}
			
			$this->query_url = $url;
			
			return $this;
		}
		
		throw new Exception('Unable to query item: '.implode(' ', $item));
	}
	
	/**
	* Get the URL to query
	* @var array
	* @return IMDB
	*/
	private function setAPI($api)
	{
		if($api === 'dean_clatworthy')
		{
			$this->api = 'dean_clatworthy';
			
			return $this;
		}
		if($api === 'omdb')
		{
			$this->api = 'omdb';
			
			return $this;
		}
		
		throw new Exception('Invalid API. Defaulting to OMDB.');
	}
	
	/**
	* Media information object
	* @return stdClass
	*/
	public function getMediaObject()
	{
		return $this->media_object;
	}
	
}
