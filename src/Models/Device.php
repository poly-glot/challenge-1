<?php

namespace SimpleUX\Challenge\Models;

use SimpleUX\Challenge\Interfaces\Device as DeviceInterface;

/* TODO: Finish Implementation of Interfaces */
class Device implements DeviceInterface {

	CONST OS_LINUX = 'Centos';
	CONST OS_WINDOWS_10 = 'Windows 10';
	CONST OS_WINDOWS_XP = 'Windows XP';
	CONST OS_MAC = 'Mac OSX';

	private $name = '';

}