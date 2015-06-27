<?php

namespace SimpleUX\Challenge\Interfaces;

interface Person {

	public function setFirstName($firstname);


	public function setLastName($lastname);


	public function getFirstName();


	public function getLastName();


	public function getName();


	public function isHacker();


	public function isTeamMember();
}