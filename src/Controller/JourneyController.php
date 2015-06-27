<?php

namespace SimpleUX\Challenge\Controller;

use SimpleUX\Challenge\Models\Journeys as Journeys;
use SimpleUX\Challenge\Models\Journey as Journey;
use SimpleUX\Challenge\Models\Company as Company;
use SimpleUX\Challenge\Models\Hacker as Hacker;
use SimpleUX\Challenge\Models\MeetupPromotion as MeetupPromotion;
use SimpleUX\Challenge\Models\MeetupJourneyPlanner as MeetupJourneyPlanner;
use SimpleUX\Challenge\Models\CityStops as CityStops;
use SimpleUX\Challenge\Models\LunchBreaks as LunchBreaks;
use SimpleUX\Challenge\Models\HackingThreats as HackingThreats;

class JourneyController {

	protected $journeys;


	public function __construct()
	{
		$this->journeys = new Journeys;
	}


	public function organizePeshwarMeetup()
	{
		$meetupMembers = Company::getInstance()->getMemberByNames('Junaid Anwar', 'Shuja\'at Butt', 'Ahmed Shehzad',
			'Naimat Khan', 'Zainab Gul', 'Vishwas Kumar');
		foreach ($meetupMembers as $member)
		{
			$this->journeys->add(new MeetupPromotion($member));
		}
	}


	public function exchangeBalances()
	{
		$this->journeys->find('Ahmed Shehzad')->charge(140, "Lend Money to Shuja'at Butt", true);
		$this->journeys->find('Zainab Gul')->charge(60, "Lend Money to Shuja'at Butt on Ahmed Shehzad request", true);
		$this->journeys->find("Shuja'at Butt")->addBalance(200);
	}


	public function planHackerJourney()
	{
		$rootHacker = new Hacker();
		$rootHacker->setFirstName('Root')->setLastName('Anonymous');

		//Plan Traveling Plan for Hacker from Manshera to Peshawar
		$journey     = new Journey($rootHacker);
		$southTravel = array_reverse(CityStops::getCitiesNorth());
		$southTravel = array_merge($southTravel, array( 'Peshawar' ));

		$journey->setPlan($southTravel);
		$journey->addBalance(2000);

		$this->journeys->add($journey);
	}


	public function planTeamJourney()
	{
		MeetupJourneyPlanner::plan($this->journeys);
	}


	public function startTraveling()
	{
		while ($this->journeys->isPeopleTraveling()):
			$this->journeys->nextStop();

			//Are we in Abottabad for Lunch Break
			LunchBreaks::breaks($this->journeys);

			//Is there Any threat for Hacking
			HackingThreats::check($this->journeys);

		endwhile;
	}


	public function displayTable()
	{
		$team_members_journey = array();

		foreach ($this->journeys->all() as $index => $journey)
		{
			if ( ! $journey instanceof MeetupPromotion )
			{
				continue;
			}

			$team_members_journey[] = $journey;
		}

		require_once realpath(__DIR__ . '/../View/') . '/team-travel-table.php';
	}
}