<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * @package LavaLust
 * @author  Ronald M. Marasigan
 * @link    https://lavalust.pinoywap.org
 * @license https://opensource.org/licenses/MIT MIT License
 */

if ( ! function_exists('load_class'))
{
	function &load_class($class, $directory = '', $params = NULL, $object_name = NULL)
	{
		$LAVA = Registry::instance();
		$class_name = ucfirst(strtolower($class));
		$object_name = $object_name !== NULL ? strtolower($object_name) : strtolower($class);

		if ($LAVA->get_object($object_name) !== NULL) {
			$object = $LAVA->get_object($object_name);
			return $object;
		}

		foreach ([APP_DIR, SYSTEM_DIR] as $base_path) {
			$dir_path = rtrim($base_path . $directory, '/\\') . DIRECTORY_SEPARATOR;

			if (is_dir($dir_path)) {
				foreach (scandir($dir_path) as $file) {
					if (strcasecmp($file, $class . '.php') === 0) {
						require_once $dir_path . $file;

						$declared = get_declared_classes();
						$match = NULL;
						foreach ($declared as $declared_class) {
							if (strcasecmp($declared_class, $class) === 0) {
								$match = $declared_class;
								break;
							}
						}

						if ($match === NULL) {
							throw new RuntimeException("Class '{$class}' not found in file.");
						}

						loaded_class($class, $object_name);
						$instance = isset($params) ? new $match($params) : new $match();
						$LAVA->store_object($object_name, $instance);

						$object = $LAVA->get_object($object_name);
						return $object;
					}
				}
			}
		}

		throw new RuntimeException("Unable to locate the {$class} class in {$directory}.");
	}
}

if ( ! function_exists('loaded_class'))
{
	function &loaded_class($class = '', $object_name = '')
	{
		static $_is_loaded = array();

		if ($class !== '') {
			$_is_loaded[$object_name] = ucfirst(strtolower($class));
		}

		return $_is_loaded;
	}
}

if ( ! function_exists('show_404'))
{
	function show_404($heading = '', $message = '', $template = '')
	{
		$errors =& load_class('Errors', 'kernel');
		return $errors->show_404($heading, $message, $template);
	}
}

if ( ! function_exists('show_error'))
{
	function show_error($heading = '', $message = '', $template = 'error_general', $code = 500)
	{
	  	$errors =& load_class('Errors', 'kernel');
	  	return $errors->show_error($heading, $message, $template, $code);
	}
}

if ( ! function_exists('_shutdown_handler'))
{
	function _shutdown_handler()
	{
		$last_error = error_get_last();
		if (isset($last_error) &&
			($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING)))
		{
			_error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
		}
	}
}

if ( ! function_exists('_exception_handler'))
{
	function _exception_handler($e)
	{
		if(config_item('log_threshold') == 1 || config_item('log_threshold') == 3) {
			$logger =& load_class('logger', 'kernel');
			$logger->log('error', get_class($e), $e->getMessage(), $e->getFile(), $e->getLine());
		}
		if(strtolower(config_item('ENVIRONMENT') == 'development')) {
			$exception =& load_class('Errors', 'kernel');
			$exception->show_exception($e);
		}
	}
}

if ( ! function_exists('_error_handler'))
{
	function _error_handler($severity, $errstr, $errfile, $errline)
	{
		$error_levels = [
			E_ERROR => "E_ERROR",
			E_WARNING => "E_WARNING",
			E_PARSE => "E_PARSE",
			E_NOTICE => "E_NOTICE",
			E_CORE_ERROR => "E_CORE_ERROR",
			E_CORE_WARNING => "E_CORE_WARNING",
			E_COMPILE_ERROR => "E_COMPILE_ERROR",
			E_COMPILE_WARNING => "E_COMPILE_WARNING",
			E_USER_ERROR => "E_USER_ERROR",
			E_USER_WARNING => "E_USER_WARNING",
			E_USER_NOTICE => "E_USER_NOTICE",
			E_RECOVERABLE_ERROR => "E_RECOVERABLE_ERROR",
			E_DEPRECATED => "E_DEPRECATED",
			E_USER_DEPRECATED => "E_USER_DEPRECATED",
		];

		// Add E_STRICT only if it exists (PHP < 8)
		if (defined('E_STRICT')) {
			$error_levels[E_STRICT] = "E_STRICT";
		}

		$severity_name = $error_levels[$severity] ?? "UNKNOWN_ERROR";

		if (config_item('log_threshold') == 1 || config_item('log_threshold') == 3) {
			$logger =& load_class('logger', 'kernel');
			$logger->log('error', $severity_name, $errstr, $errfile, $errline);
		}

		if (strtolower(config_item('ENVIRONMENT')) == 'development') { 
			$error =& load_class('Errors', 'kernel');
			$error->show_php_error($severity_name, $errstr, $errfile, $errline);
		}
	}
}

if ( ! function_exists('get_config'))
{
	function &get_config()
	{
		static $config;

		if ( file_exists(APP_DIR . 'config/config.php') )
		{
			require_once APP_DIR . 'config/config.php';

			if ( isset($config) OR is_array($config) )
			{
				foreach( $config as $key => $val ) {
					$config[$key] = $val;
				}

				return $config;
			}
		} else {
			show_404('404 Not Found', 'The configuration file does not exist');
		}
	}
}

if ( ! function_exists('config_item'))
{
	function config_item($item)
	{
		static $_config;

		if (empty($_config)) {
			$_config[0] =& get_config();
		}

		return $_config[0][$item] ?? NULL;
	}
}

if ( ! function_exists('autoload_config'))
{
	function &autoload_config()
	{
		static $autoload;

		if ( file_exists(APP_DIR . 'config/autoload.php') )
		{
			require_once APP_DIR . 'config/autoload.php';

			if ( isset($autoload)  OR is_array($autoload) )
			{
				foreach( $autoload as $key => $val ) {
					$autoload[$key] = $val;
				}

				return $autoload;
			}
		} else {
			show_404('404 Not Found', 'The configuration file does not exist');
		}
	}
}

if ( ! function_exists('database_config'))
{
	function &database_config()
	{
		static $database;

		if ( file_exists(APP_DIR . 'config/database.php') )
		{
			require_once APP_DIR . 'config/database.php';

			if ( isset($database)  OR is_array($database) )
			{
				foreach( $database as $key => $val ) {
					$database[$key] = $val;
				}

				return $database;
			}
		} else {
			show_404('404 Not Found', 'The configuration file does not exist');
		}
	}
}

if ( ! function_exists('route_config'))
{
	function &route_config()
	{
		static $route;

		if ( file_exists(APP_DIR . 'config/routes.php') )
		{
			require_once APP_DIR . 'config/routes.php';

			if ( isset($route)  OR is_array($route) )
			{
				foreach( $route as $key => $val ) {
					$route[$key] = $val;
				}

				return $route;
			}
		} else {
			show_404('404 Not Found', 'The configuration file does not exist');
		}
	}
}

if ( ! function_exists('html_escape'))
{
	function html_escape($var, $double_encode = TRUE)
	{
		if (empty($var)) {
			return $var;
		}

		if (is_array($var)) {
			foreach (array_keys($var) as $key) {
				$var[$key] = html_escape($var[$key], $double_encode);
			}
			return $var;
		}

		return htmlspecialchars($var, ENT_QUOTES, config_item('charset'), $double_encode);
	}
}

if ( ! function_exists('is_php'))
{
	function is_php($version)
	{
		static $_is_php;
		$version = (string) $version;

		if ( ! isset($_is_php[$version])) {
			$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
		}

		return $_is_php[$version];
	}
}

if ( ! function_exists('is_https'))
{
	function is_https()
	{
		if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return TRUE;
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
			return TRUE;
		}
		elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return TRUE;
		}

		return FALSE;
	}
}
