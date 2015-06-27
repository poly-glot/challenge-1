<?php

namespace SimpleUX\Challenge\Interfaces;

interface Team {

	public function getDevice();


	public function getLikes();


	public function getResidence();


	public function setLikes($likes);


	public function setResidence($residence);


	public function setRelatives(array $relatives);

	public function setInHouse();

	public function isRemote();


	public function getRelatives();
}