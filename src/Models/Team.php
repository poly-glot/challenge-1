<?php

namespace SimpleUX\Challenge\Models;

use SimpleUX\Challenge\Interfaces\Team as TeamInterface;

class Team extends Person implements TeamInterface {

	CONST PROVINCE_KPK = 'KPK';
	CONST PROVINCE_PUN = 'Punjab';

	private $device = null;

	private $likes = '';

	private $residence = '';

	private $relatives = array();

	private $balance = null;

	private $is_remote = true;


	public static function instance($first_name = '', $last_name = '', $residence = '', $likes = '', $device = '', $relatives = array())
	{
		$team_member = new Team;
		$team_member->setFirstName($first_name);
		$team_member->setLastName($last_name);
		$team_member->setResidence($residence);
		$team_member->setLikes($likes);
		$team_member->setRelatives($relatives);

		if(empty($device))
			$team_member->device->setOS(Device::OS_LINUX);
		else
			$team_member->device->setOS($device);

		return $team_member;
	}

	public function __construct()
	{
		$this->device = new Device;
	}


	public function getDevice()
	{
		return $this->device;
	}


	public function setLikes($likes)
	{
		$this->likes = $likes;

		return $this;
	}


	public function setResidence($residence)
	{
		$this->residence = $residence;

		return $this;
	}


	public function setRelatives(array $relatives)
	{
		$this->relatives = $relatives;

		return $this;
	}


	public function getLikes()
	{
		return $this->likes;
	}


	public function getResidence()
	{
		return $this->residence;
	}


	public function getRelatives()
	{
		return $this->relatives;
	}


	public function setInHouse()
	{
		$this->is_remote = false;

		return $this;
	}


	public function isRemote()
	{
		return ($this->is_remote === true);
	}

	/* FIXME: Use Device isSecure() method instead */
	public function hasSecureDevice()
	{
		return ($this->getDevice()->isSecure() !== Device::OS_WINDOWS_XP);
	}
}