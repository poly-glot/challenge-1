<?php

namespace SimpleUX\Challenge\Models;

class Journeys {

	private $journeys;

	private $plan;


	public function __construct()
	{

	}


	public function add(Journey $journey)
	{
		$name                  = $journey->getPerson()->getName();
		$this->journeys[$name] = $journey;

		return $this;
	}


	public function find($name)
	{
		if ( array_key_exists($name, $this->journeys) )
		{
			return $this->journeys[$name];
		}

		throw new \Exception("Unable to find $name in Today's Journey Plan.", 201);
	}


	public function all()
	{
		return $this->journeys;
	}

	public function isPeopleTraveling()
	{
		$is_traveling = false;

		foreach($this->journeys as $journey)
		{
			if($journey->isTraveling())
			{
				$is_traveling = true;
			}
		}

		return $is_traveling;
	}

	public function nextStop()
	{
		foreach($this->journeys as $journey)
		{
			if($journey->isTraveling())
			{
				$journey->nextStop();
			}
		}

		return $this;
	}
}