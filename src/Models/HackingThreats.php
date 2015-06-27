<?php

namespace SimpleUX\Challenge\Models;

class HackingThreats {

	private static $hacker;

	public static function check(Journeys $journeys)
	{
		if(self::$hacker === null)
		{
			self::findHacker($journeys);
		}

		if(self::$hacker === null){
			return false;
		}

		foreach ($journeys->all() as $index => $journey)
		{
			if ( ! $journey instanceof MeetupPromotion )
			{
				continue;
			}

			if($journey->getPerson()->hasSecureDevice())
			{
				continue;
			}

			if($journey->getCurrentCityStop() === self::$hacker->getCurrentCityStop())
			{
				$journey->setNote('Hacked');
				$journey->stop();
			}
		}
	}

	private static function findHacker(Journeys $journeys)
	{
		foreach ($journeys->all() as $index => $journey)
		{
			if ($journey instanceof MeetupPromotion )
			{
				continue;
			}

			if(!($journey->getPerson() instanceof Hacker))
			{
				continue;
			}

			self::$hacker = $journey;
		}
	}
}