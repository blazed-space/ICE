<?php
	/* 
			ice::Util_String
			/classes/util/string.php

			ICE
			Created by: Blazed Labs LLC [ https://blazedlabs.com/ ]
			(c)2021 https://github.com/blazed-space/ICE
			
	*/
	namespace ice;
	class Util_String{
		/*
		*	Util_String::KEYSPACE
		*	@desc Defines the acceptable characters
		*	@type [string]
		*/
		const KEYSPACE = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		/*
		*	Util_String::randomString($length)
		*	@desc Generate a random string of length $length.
		*		** Warning: Predicatbly Random **
		*	@param $length (int)
		*	@return [string]
		*/
		public static function randomString($length = 10) {
			if ($length < 1) {
		        throw new \RangeException("Length must be a positive integer");
		    }
		    $randomString = '';
		    $charactersLength = strlen(Util_String::KEYSPACE);
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= Util_String::KEYSPACE[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
		
		/*
		*	Util_String::randomStringSecure($length)
		*	@desc Generate a secure random string of length $length.
		*
		*	@param $length (int)
		*	@return [string]
		*/
		public static function randomStringSecure($length = 64){
		    if ($length < 1) {
		        throw new \RangeException("Length must be a positive integer");
		    }
		    $pieces = [];
		    $max = mb_strlen(Util_String::KEYSPACE, '8bit') - 1;
		    for ($i = 0; $i < $length; ++$i) {
		        $pieces []= Util_String::KEYSPACE[random_int(0, $max)];
		    }
		    return implode('', $pieces);
		}
		
		/**
		 * Generates human-readable string.
		 * @src https://gist.github.com/sepehr/3371339
		 * 
		 * @param string $length Desired length of random string.
		 * 
		 * return string Random string.
		 */ 
		public static function readableRandomString($length = 6)
		{  
			$string = '';
			$vowels = array("a","e","i","o","u");  
			$consonants = array(
				'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
				'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
			);  

			$max = $length / 2;
			for ($i = 1; $i <= $max; $i++)
			{
				$string .= $consonants[rand(0,19)];
				$string .= $vowels[rand(0,4)];
			}

			return $string;
		}
	}