<?php

	/* 
		boostrap.php
		
		The ICE SSG
		Created by: Blazed Labs LLC [ https://blazedlabs.com/ ]
		(c)2021 https://github.com/blazed-space/ICE
		
	*/
	
	// Add namespace, necessary if you want the autoloader to be able to find classes
	Autoloader::add_namespace('ice', __DIR__.'/classes/');

	// Add as core namespace
	Autoloader::add_core_namespace('ice');

	// Add as core namespace (classes are aliased to global, thus useable without namespace prefix)
	// Set the second argument to true to prefix and be able to overwrite core classes
	//Autoloader::add_core_namespace('ice', true);