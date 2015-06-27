<?php

require_once __DIR__ . '/autoloader.php';

use SimpleUX\Challenge\Controller\JourneyController as JourneyController;

$journeyController = new JourneyController;

//1. Arrange a Meetup
$journeyController->organizePeshwarMeetup();

//2. Exchange Balances
$journeyController->exchangeBalances();

//3. Add a Hacker
$journeyController->planHackerJourney();

//4. Plan a Journey
$journeyController->planTeamJourney();

//4. Get to Promotion Work
$journeyController->startTraveling();

//Display Table
$journeyController->displayTable();
