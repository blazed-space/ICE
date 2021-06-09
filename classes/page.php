<?php
namespace ice;
class Page{
    private $page;
    private $bundle;

    private $layout;

    function __construct($page)
    {
        $this->page = $page;

        $bundle_name = Util_Url::base64url_encode($this->page);
		//Define filters to minify CSS files when bundled
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
		$this->bundle = new \DotsUnited\BundleFu\Bundle($options);
        
    }
    function set_layout($layout){
        $this->layout = $layout;
        if(is_numeric($this->page)){
            $this->layout->page = $this->page;
        }
    }
    function add_content($content, $delete_old = false){
        if($delete_old === true){
            $this->layout->content = $content;
        } else {
            $this->layout->content .= $content;
        }
    }
    function get_page(){
        return $this->page;
    }
    function to_string(){
        return Response::forge(Util_Mini::html($this->layout));
    }

}