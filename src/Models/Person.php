<?php

namespace SimpleUX\Challenge\Models;

use SimpleUX\Challenge\Interfaces\Person as PersonInterface;

class Person implements PersonInterface {

	private $firstname = '';

	private $lastname = '';


	public function getFirstName()
	{
		return $this->firstname;
	}


	public function getLastName()
	{
		return $this->lastname;
	}


	public function setFirstName($name)
	{
		$this->firstname = $name;

		return $this;
	}


	public function setLastName($name)
	{
		$this->lastname = $name;

		return $this;
	}


	public function getName()
	{
		return "$this->firstname $this->lastname";
	}


	public function isHacker()
	{

	}


	public function isTeamMember()
	{

	}
}