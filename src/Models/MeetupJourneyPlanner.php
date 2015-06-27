<?php

namespace SimpleUX\Challenge\Models;

class MeetupJourneyPlanner {

	public static function plan(Journeys $journeys)
	{
		$citiesAll       = $citiesUnique = CityStops::getCities();
		$last_stop_index = count($citiesAll) - 1;
		$north           = CityStops::getCitiesNorth();

		$north_inverse	 = array_reverse($north); //For downwards travelling
		array_shift($north_inverse); //Remove Manshera as you are already there.

		$south           = CityStops::getCitiesSouth();


		foreach ($journeys->all() as $index => $journey)
		{
			if ( ! $journey instanceof MeetupPromotion )
			{
				continue;
			}

			$plan = array();

			$city_index = array_rand($citiesUnique, 1);
			$city_start = $citiesUnique[$city_index];

			unset( $citiesUnique[$city_index] );

			$journey->setInitialCity($city_start);

			//Special Condition for South (Islamabad)
			if ( in_array($city_start, $south) )
			{
				$travel_north 	= array_merge(array( $city_start ), $north);
				$travel_south 	= array_merge($north_inverse, $south);
				$plan 			= array_merge($travel_north, $travel_south);

				$journey->setPlan($plan);
				continue;
			}

			$starting_city_index 		= array_search($city_start, $north);
			$travel_north_to_starting	= array_slice($north, 0, $starting_city_index);
			$travel_north 		 		= array_slice($north, $starting_city_index);
			$travel_south 		 		= array_merge($north_inverse, $south);

			$plan 			  	 = array_merge($travel_north_to_starting, $travel_north, $travel_south);
			$journey->setPlan($plan);
		}
	}
}