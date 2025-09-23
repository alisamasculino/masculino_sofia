<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * @package LavaLust
 * @author  Ronald M. Marasigan
 * @link    https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/**
 * Required to execute necessary functions
 */
require_once SYSTEM_DIR . 'kernel/Registry.php';
require_once SYSTEM_DIR . 'kernel/Routine.php';

/**
 * LavaLust BASE URL of your APPLICATION
 */
define('BASE_URL', config_item('base_url'));

/**
 * Composer (Autoload)
 */
if ($composer_autoload = config_item('composer_autoload'))
{
	if ($composer_autoload === TRUE)
	{
		file_exists(APP_DIR.'vendor/autoload.php')
			? require_once(APP_DIR.'vendor/autoload.php')
			: show_404('404 Not Found', 'Composer config file not found.');
	}
	elseif (file_exists($composer_autoload))
	{
		require_once($composer_autoload);
	}
	else
	{
		show_404('404 Not Found', 'Composer config file not found.');
	}
}

/**
 * Instantiate the Benchmark class
 */
$performance =& load_class('performance', 'kernel');
$performance->start('lavalust');

/**
 * Deployment Environment
 */
switch (strtolower(config_item('ENVIRONMENT')))
{
	case 'development':
		_handlers();
		// PHP 8+ no longer supports E_STRICT separately, use -1 to show all
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		error_reporting(0);
		_handlers();
	break;

	default:
		_handlers();
		error_reporting(-1);
		ini_set('display_errors', 1);
}

/**
 * Error Classes to show errors
 */
function _handlers()
{
	set_error_handler('_error_handler');
	set_exception_handler('_exception_handler');
	register_shutdown_function('_shutdown_handler');
}

/**
 * Instantiate the config class
 */
$config =& load_class('config', 'kernel');

/**
 * Instantiate the logger class
 */
$logger =& load_class('logger', 'kernel');

/**
 * Instantiate the security class for xss and csrf support
 */
$security =& load_class('security', 'kernel');

/**
 * Instantiate the Input/Output class
 */
$io =& load_class('io', 'kernel');

/**
 * Instantiate the Language class
 */
$lang =& load_class('lang', 'kernel');

/**
 * Load BaseController
 */
require_once SYSTEM_DIR . 'kernel/Controller.php';

/**
 * Instantiate the routing class and set the routing
 */
$router =& load_class('router', 'kernel', array(new Controller));
require_once APP_DIR . 'config/routes.php';

/**
 * Instantiate LavaLust Controller
 *
 * @return object
 */
function &lava_instance()
{
  	return Controller::instance();
}

$performance->stop('lavalust');

/**
 * Handle the request
 */
$url = $router->sanitize_url(
	str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF'])
);
$method = isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : '';
$router->initiate($url, $method);