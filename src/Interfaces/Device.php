<?php

namespace SimpleUX\Challenge\Interfaces;

interface Device {

	public function setOS($operating_system);

	public function getOS();

	public function isSecure();
}