<?php

namespace SimpleUX\Challenge\Models;

class Company {

	private static $instance = null;

	private $member = array();


	public static function getInstance()
	{
		if ( self::$instance === null )
		{
			self::$instance = new Company;
		}

		return self::$instance;
	}

	public function __construct()
	{
		$this->initMembers();
	}

	public function getMemberByName($name)
	{
		if(!array_key_exists($name, $this->member))
			throw new \Exception('$name does not exists in our team database', 301);

		return $this->member[$name];
	}

	public function getMemberByNames()
	{
		$members 		= array();
		$names 			= func_get_args();

		foreach($names as $name)
			$members[] = $this->getMemberByName($name);

		return $members;
	}

	private function initMembers()
	{
		$members 		= array();

		$members[] 		= Team::instance('Junaid', 		'Anwar', 	Team::PROVINCE_PUN, 'AngularJS', Device::OS_LINUX);
		$members[] 		= Team::instance("Shuja'at", 	'Butt', 	Team::PROVINCE_PUN, 'AngularJS', Device::OS_WINDOWS_XP);
		$members[] 		= Team::instance('Ahmed', 		'Shehzad', 	Team::PROVINCE_PUN, 'AngularJS', Device::OS_LINUX, array('Zainab Gul'));

		$members[] 		= Team::instance('Naimat', 		'Khan', 	Team::PROVINCE_KPK, 'AngularJS', Device::OS_LINUX);
		$members[] 		= Team::instance('Zainab', 		'Gul', 		Team::PROVINCE_KPK, 'AngularJS', Device::OS_WINDOWS_XP, array('Ahmed Shehzad'));
		$members[] 		= Team::instance('Vishwas', 	'Kumar', 	Team::PROVINCE_KPK, 'AngularJS', Device::OS_MAC);

		foreach($members as $member)
			$this->member[$member->getName()] = $member;
	}
}