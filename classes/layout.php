<?php

namespace ice;
class Layout{
	public static function get_schema(){
		$social = Layout::get_social_array();
		return '
			<script type="application/ld+json">
				{
					"@context": "https://schema.org",
					"@type": "Corporation",
					"name": "Blazed Labs LLC",
					"url": "https://blazedlabs.com/",
					"logo": "https://nstrobor.sirv.com/logo/Beaker-Red.png",
					"sameAs": [
						"https://www.facebook.com/' . $social['facebook'] . '/",
						"https://twitter.com/' . $social['twitter'] . '",
						"https://instagram.com/' . $social['instagram'] . '",
						"https://www.linkedin.com/company/' . $social['linkedin'] . '",
						"https://github.com/' . $social['github'] . '",
					]
				}
				}
			</script>
		';
	}
	/*
		get_social_array()
		Returns a list of social media profiles
	*/
	public static function get_social_array(){
		return array(
			'twitter' 			=> 	'BlazedLabs',	// https://twitter.com/BlazedLabs
			'facebook' 			=> 	'blazedlabs', 	// https://www.facebook.com/blazedlabs/
			'linkedin' 			=> 	'blazed-labs',  // https://www.linkedin.com/company/blazed-labs
			'instagram' 		=> 	'blazed_labs', 	// https://www.instagram.com/Blazed_labs/
			'github' 			=> 	'blazed-labs', 	// https://github.com/blazed-space/
			'keybase' 			=> 	'blazedlabs', 	// https://keybase.io/blazedlabs
			'opencollective' 	=> 	'blazedlabs', 	// https://opencollective.com/blazedlabs/
		);
	}
	/*
		get_footer_list()
		Standard Blazed Labs footer list.
	*/
	public static function get_footer_list(){
		return array(
			'main' => array(
				array('Company', 'https://blazedlabs.com/'),
				array('Explore', 'https://blazed.space/'),
				array('Learn More', 'https://blazed.info/'),
			),
			'services' => array(
				array('Development', 'https://blazed.city/'),
				array('Publishing', 'https://blazed.xyz/'),
				array('All Services', 'https://blazed.city/services/'),
			),
			'products' => array(
				array('Blazed Corn', 'https://blazedcorn.com/'),
				array('One Solution', 'https://blz.one/'),
				array('All Products', 'https://blazed.space/products/'),
			),
			'contact' => array(
				array('hello@blazed.space', 'mailto:hello@blazed.space'),
			),
		);
	}
	public static function get_actual_url(){
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
    public static function create_bundle($page){
		$bundle_name = Util_Url::base64url_encode($page);
		$css_filter = new \DotsUnited\BundleFu\Filter\CallbackFilter(function($content) {
				return Util_Mini::css($content);
			}
		);
		$options = array(
			'name' => 'bundle_' . $bundle_name,
			'doc_root' => DOCROOT,
			'css_cache_path' => 'assets/css/cache',
			'css_cache_url' => Uri::base() . 'assets/css/cache',
			'css_filter' => $css_filter,
			'js_cache_path' => 'assets/js/cache',
			'js_cache_url' => Uri::base() . 'assets/js/cache',
		);
		return new \DotsUnited\BundleFu\Bundle($options);
	}

}