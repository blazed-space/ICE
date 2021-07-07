<?php
	/* 
			ice::Util_String
			/classes/util/string.php

			The ICE SSG
			Created by: Blazed Labs LLC [ https://blazedlabs.com/ ]
			(c)2021 https://github.com/blazed-space/ICE
			
	*/
	class Util_String{
		/*
			Util_String::KEYSPACE
			@desc Defines the acceptable characters
			@type [string]
		*/
		const KEYSPACE = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		/*
			Util_String::randomString($length)
			@desc Generate a random string of length $length.
				** Warning: Predicatbly Random **
			@param $length (int)
			@return [string]
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
			Util_String::randomStringSecure($length)
			@desc Generate a secure random string of length $length.
			@param $length (int)
			@return [string]
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
	}