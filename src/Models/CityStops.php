<?php

namespace SimpleUX\Challenge\Models;

class CityStops {

	CONST COST_FROM_PESHAWAR_TO_ISLAMABAD = 300;
	CONST COST_CITY_STOP = 50;
	CONST COST_LUNCH = 100;

	private static $citiesNorth = array( 'Hassan Abdal', 'Haripur', 'Havelian', 'Abbottabad', 'Mansehra' );

	private static $citiesSouth = array( 'Islamabad' );


	public static function getCities()
	{
		return array_merge(self::$citiesNorth, self::$citiesSouth);
	}


	public static function getCitiesNorth()
	{
		return self::$citiesNorth;
	}


	public static function getCitiesSouth()
	{
		return self::$citiesSouth;
	}


	public static function calculateFare($stop_from, $stop_to)
	{
		if ( $stop_from === 'Peshawar' AND $stop_to === 'Islamabad' )
		{
			return self::COST_FROM_PESHAWAR_TO_ISLAMABAD;
		}

		return self::COST_CITY_STOP;
	}
}