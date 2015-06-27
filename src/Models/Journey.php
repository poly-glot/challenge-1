<?php

namespace SimpleUX\Challenge\Models;

use SimpleUX\Challenge\Models\Person as Person;

class Journey {

	protected $person;

	protected $plan;

	protected $stops = array();

	protected $is_traveling = true;

	protected $last_stop = null;

	protected $charges = array();

	protected $balance = 0;

	protected $note = '';


	public function __construct(Person $person)
	{
		$this->person = $person;
	}


	public function setPlan(array $plan)
	{
		$this->plan            = $plan;
		return $this;
	}


	public function getPerson()
	{
		return $this->person;
	}


	public function addBalance($balance)
	{
		if ( ! is_int($balance) )
		{
			throw new Exception('Invalid argument provided', 202);
		}

		$this->startingBalance += $balance;

		$this->balance += $balance;

		return $this;
	}


	public function isTraveling()
	{
		return ( $this->is_traveling === true );
	}


	public function stop()
	{
		$this->is_traveling = false;

		return $this;
	}


	public function nextStop()
	{
		if ( $this->last_stop === null )
		{
			$this->last_stop = array_shift($this->plan);
		}

		if ( empty( $this->plan ) )
		{
			$this->is_traveling = false;

			return $this;
		}

		$next_stop          = array_shift($this->plan);
		$charge             = CityStops::calculateFare($this->last_stop, $next_stop);
		$charge_description = "Travel from $this->last_stop to $next_stop";

		if ( ( $this->balance - $charge ) <= 0 )
		{
			$this->setNote('No Money');
			$this->is_traveling = false;

			return $this;
		}

		$this->charge($charge, $charge_description);

		$this->last_stop = $next_stop;

		//Record User Stops
		$this->recordStopOnCity();

		return $this;
	}


	public function charge($amount, $description = null)
	{

	}


	public function setNote($note)
	{
		$this->note = $note;

		return $this;
	}


	public function getNote()
	{
		return $this->note;
	}


	public function getCurrentCityStop()
	{
		return $this->last_stop;
	}


	public function getPlannedJourney()
	{
		$stops = $this->stops;
		$stops = array_unique($stops);

		return $stops;
	}

	public function getCharges()
	{
		return $this->charges;
	}

	protected function recordStopOnCity()
	{

	}
}