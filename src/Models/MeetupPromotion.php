<?php

namespace SimpleUX\Challenge\Models;

use Rhumsaa\Uuid\Console\Exception;

class MeetupPromotion extends Journey {

	protected $startingBalance = 700;

	protected $charges = array();

	protected $balance = 700;

	protected $initialCity = '';

	public function getStartingBalance()
	{
		return $this->startingBalance;
	}

	public function getBalance()
	{
		return $this->balance;
	}


	public function charge($amount, $description = null, $is_lend = false)
	{
		if ( ! is_int($amount) )
		{
			throw new Exception('Invalid argument provided', 202);
		}

		if ( ! empty( $description ) )
		{
			$this->charges[$description] = $amount;
		}
		else
		{
			$this->charges[] = $amount;
		}

		if($is_lend)
			$this->startingBalance -= $amount;

		$this->balance -= $amount;

		return $this;
	}

	public function setPlan(array $plan)
	{
		$plan = array_merge(array('Peshawar'), $plan);
		return parent::setPlan($plan);
	}

	public function getInitialCity()
	{
		return $this->initialCity;
	}

	public function setInitialCity($initialCity)
	{
		$this->initialCity = $initialCity;
		return $this;
	}

	protected function recordStopOnCity()
	{
		//Wait till user hit their first assigned stop & ensure it is unique
		if(!empty($this->stops))
		{
			if(!in_array($this->last_stop, $this->stops))
				$this->stops[] = $this->last_stop;

			return;
		}

		//Team member reached their assigned stop
		if($this->last_stop === $this->initialCity)
			$this->stops[] = $this->last_stop;
	}
}