<?php
    /*
        Main config options for ICE
    */
    return array(
        'defaults_path' => 'layouts/defaults/',
        'partials_path' => 'layouts/partials/',
        'pages_path' => 'content/pages/',
		'data_path' => 'content/data/',
		
		'commonmark' => array(
			'html_input' => 'strip',
			'allow_unsafe_links' => false,
		),
    );