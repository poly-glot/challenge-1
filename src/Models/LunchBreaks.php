<?php

namespace SimpleUX\Challenge\Models;

class LunchBreaks {

	private static $eaten = array();

	/* TODO: Charge Team Member 100PKR only once, whenever they reach Abottabad */
	public static function breaks(Journeys $journeys)
	{
		foreach ($journeys->all() as $index => $journey)
		{
			if ( ! $journey instanceof MeetupPromotion )
			{
				continue;
			}
		}
	}
}