<?php

namespace ice;
use League\CommonMark\GithubFlavoredMarkdownConverter;
class Loader{
	public static function load_template($name, $config){
		$d = Presenter::forge(\Config::get('ice.defaults_path') . $name);
		$d->config = $config;
		return $d;
	}
	
	public static function load_partial($name, $config){
		$p = View::forge(\Config::get('ice.partials_path') . $name);
		$p->config = $config;
		return $p;
	}
	
	public static function load_page($name){
		$page = "";
		$pagePath = APPPATH . 'views/' . \Config::get('ice.pages_path') . $name . '.md';
		if(File::exists($pagePath)){
			$p = File::read($pagePath);
			$converter = new GithubFlavoredMarkdownConverter([\Config::get('ice.commonmark')]);
			$page = $converter->convertToHtml($p);
		}
		return $page;
	}
	
	public static function load_data($name, $config){
		$data = "";
		$dataPath = APPPATH . 'views/' . \Config::get('ice.data_path') . $name;
		if(File::exists($dataPath)){
			$data = File::read($dataPath);
		}
		return $data;
	}
	
}