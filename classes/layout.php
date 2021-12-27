<?php

namespace ice;
class Layout {
	/*
		\ice\Layout::get_social_array()
		Returns a list of social media profiles
	*/
	public static function get_social_array(){
		return array(
			'twitter' 			=> 	'BlazedLabs',	// https://twitter.com/BlazedLabs
			'facebook' 			=> 	'blazedlabs', 	// https://www.facebook.com/blazedlabs/
			'linkedin' 			=> 	'blazed-labs',  // https://www.linkedin.com/company/blazed-labs
			'instagram' 		=> 	'blazed_labs', 	// https://www.instagram.com/Blazed_labs/
			'github' 			=> 	'blazed-labs', 	// https://github.com/blazed-space/
			'opencollective' 	=> 	'blazedlabs', 	// https://opencollective.com/blazedlabs/
		);
	}
	/*
		\ice\Layout::get_actual_url()
		Returns the actual URL (according to $_SERVER); w/ HTTP/HTTPS
	*/
	public static function get_actual_url(){
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

}