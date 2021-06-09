<?php
	namespace ice;
	class Util_Url{
		/*
			Util_Url::base64url_encode($data)
			@desc Returns base 64 encoded version of param.
			@param $data (str)
			@return ... [string]
		*/
		public static function base64url_encode($data) {
			return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
		}
		
		/*
			Util_Url::base64url_decode($data)
			@desc Returns base 64 decoded version of param.
			@param $data (str)
			@return ... [string]
		*/
		public static function base64url_decode($data) {
		  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
		}
	}