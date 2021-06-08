<?php

class Controller_Main extends Controller
{
	public function before(){
	    
		/*
	    	$this->auth = new \Delight\Auth\Auth(new PDO(\Config::get('db')["default"]["connection"]["dsn"], \Config::get('db')["default"]["connection"]["username"], 
			\Config::get('db')["default"]["connection"]["password"]));
		*/

		
	}
	public function after($response){
		// Each page gets its own bundle.

		
	}
}