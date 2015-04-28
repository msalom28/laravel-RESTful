<?php 

class ApiTester extends TestCase
{

	public function getJson($uri, $method = 'GET', $parameters = [])
	{
		return json_decode($this->call($method, $uri, $parameters)->getContent());
	}
	
}