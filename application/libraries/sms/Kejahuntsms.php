<?php 

require_once 'AfricasTalkingGateway.php';

class Kejahuntsms
{
	public function __construct(){}

	public function get_messenger($username, $api_key)
	{
		return new AfricasTalkingGateway($username, $api_key);
	}
}