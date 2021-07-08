<?php
	/* 
			ice::Util_Mini
			/classes/util/mini.php

			Based on `https://github.com/mecha-cms/mecha-cms/blob/master/system/kernel/converter.php`
			
			The ICE SSG
			Created by: Blazed Labs LLC [ https://blazedlabs.com/ ]
			(c)2021 https://github.com/blazed-space/ICE
			
	*/
	namespace ice;
	class Util_Mini{
		/*
			Util_Mini::html($input)
			@desc HTML Minifier
			@param $input (string)
			@return [string]
		*/
		public static function html($input) {
			if(trim($input) === "") return $input;
			
			$input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
				return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
			}, str_replace("\r", "", $input));
			
			if(strpos($input, ' style=') !== false) {
				$input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
					return '<' . $matches[1] . ' style=' . $matches[2] . Util_Mini::css($matches[3]) . $matches[2];
				}, $input);
			}
			
			if(strpos($input, '</style>') !== false) {
			$input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function($matches) {
				return '<style' . $matches[1] .'>'. Util_Mini::css($matches[2]) . '</style>';
			}, $input);
			}
			
			if(strpos($input, '</script>') !== false) {
			$input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function($matches) {
				return '<script' . $matches[1] .'>'. Util_Mini::js($matches[2]) . '</script>';
			}, $input);
			}

			return preg_replace(
				array(
					// t = text
					// o = tag open
					// c = tag close
					'#<(img|input)(>| .*?>)#s',
					'#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
					'#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
					'#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
					'#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
					'#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
					'#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
					'#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
					'#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
					// Remove HTML comment(s) except IE comment(s)
					'#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
				),
				array(
					'<$1$2</$1>',
					'$1$2$3',
					'$1$2$3',
					'$1$2$3$4$5',
					'$1$2$3$4$5$6$7',
					'$1$2$3',
					'<$1$2',
					'$1 ',
					'$1',
					""
				),
			$input);
		}
		
		
		/*
			Util_Mini::css($input)
			@desc CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
			@param $input (string)
			@return [string]
		*/
		public static function css($input) {
			if(trim($input) === "") return $input;
			return preg_replace(
				array(
					// Remove comment(s)
					'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
					// Remove unused white-space(s)
					'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
					// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
					'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
					// Replace `:0 0 0 0` with `:0`
					'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
					// Replace `background-position:0` with `background-position:0 0`
					'#(background-position):0(?=[;\}])#si',
					// Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
					'#(?<=[\s:,\-])0+\.(\d+)#s',
					// Minify string value
					'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
					'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
					// Minify HEX color code
					'#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
					// Replace `(border|outline):none` with `(border|outline):0`
					'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
					// Remove empty selector(s)
					'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
				),
				array(
					'$1',
					'$1$2$3$4$5$6$7',
					'$1',
					':0',
					'$1:0 0',
					'.$1',
					'$1$3',
					'$1$2$4$5',
					'$1$2$3',
					'$1:0',
					'$1$2'
				),
			$input);
		}

		
		/*
			Util_Mini::js($input)
			@desc JS Minifier
			@param $input (string)
			@return [string]
		*/
		public static function js($input) {
			if(trim($input) === "") return $input;
			return preg_replace(
				array(
					// Remove comment(s)
					'#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
					// Remove white-space(s) outside the string and regex
					'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
					// Remove the last semicolon
					'#;+\}#',
					// Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
					'#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
					// --ibid. From `foo['bar']` to `foo.bar`
					'#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
				),
				array(
					'$1',
					'$1$2',
					'}',
					'$1$3',
					'$1.$3'
				),
			$input);
		}
	}