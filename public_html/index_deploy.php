<?php
error_reporting(-1); ini_set('display_errors', 1);define('VERSION', '3.3.0'); 
define('DOCROOT', __DIR__);
define('APPPATH', realpath(__DIR__.'/../app').DIRECTORY_SEPARATOR);
define('PKGPATH', '/var/www/common/fuel/packages'.DIRECTORY_SEPARATOR);
define('COREPATH', '/var/www/common/fuel/core'.DIRECTORY_SEPARATOR);
define('VENDORPATH', '/var/www/common/fuel/vendor'.DIRECTORY_SEPARATOR);

defined('FUEL_START_TIME') or define('FUEL_START_TIME', microtime(true));
defined('FUEL_START_MEM') or define('FUEL_START_MEM', memory_get_usage());

if ( ! file_exists(COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php'))
{
	die('No composer autoloader found. Please run composer to install the FuelPHP framework dependencies first!');
}

require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';

class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

$routerequest = function($request = null, $e = false)
{
	Request::reset_request(true);

	$route = array_key_exists($request, Router::$routes) ? Router::$routes[$request]->translation : Config::get('routes.'.$request);

	if ($route instanceof Closure)
	{
		$response = $route();

		if( ! $response instanceof Response)
		{
			$response = Response::forge($response);
		}
	}
	elseif ($e === false)
	{
		$response = Request::forge()->execute()->response();
	}
	elseif ($route)
	{
		$response = Request::forge($route, false)->execute(array($e))->response();
	}
	elseif ($request)
	{
		$response = Request::forge($request)->execute(array($e))->response();
	}
	else
	{
		throw $e;
	}

	return $response;
};

try
{
	// Boot the app...
	require APPPATH.'bootstrap.php';

	// ... and execute the main request
	$response = $routerequest();
}
catch (HttpBadRequestException $e)
{
	$response = $routerequest('_400_', $e);
}
catch (HttpNoAccessException $e)
{
	$response = $routerequest('_403_', $e);
}
catch (HttpNotFoundException $e)
{
	$response = $routerequest('_404_', $e);
}
catch (HttpServerErrorException $e)
{
	$response = $routerequest('_500_', $e);
}

$response->body((string) $response);

$response->send(true);
