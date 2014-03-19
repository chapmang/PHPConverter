<?php
namespace PHPConverter\Core {

	use PHPConverter\Core\ArrayMethods as ArrayMethods;

	/**
	 * Configuration
	 * Convert a standard ini configuration file into
	 * an object for use in the framework/application
	 * @version 2.0
	 * @author Geoff Chapman <geoff.chapman@mac.com>
	 * @package Framework
	 */
	class Configuration {


		/**
	 	 * A cache of the parsed configuration items.
	 	 * @var array
	 	 */
		public static $cache = array();


		/**
		 * Determine if a configuration item or file exists.
		 * @param  string  $key
		 * @return bool
		 */
		public static function has($key) {
			return ! is_null(static::get($key));
		}

		/**
		 * Get a configuration item.
		 * If no item is requested, the entire configuration array will be returned.
		 * @param  string  $key
		 * @param  mixed   $default
		 * @return array
		 */
		public static function get($key, $default = null) {
			if (empty($key)) {
				throw new \Exception("\$key argument is not valid", 500);				
			}

			list($file, $item) = static::_parse($key);
			if (file_exists("constants/{$file}.php")) {
				$items = include "constants/{$file}.php";
			} else {
				throw new \Exception("$file configuration file is missing", 500);
			}

			if (is_null($item)) {
				return $items;
			} else {
				return ArrayMethods::array_get($items, $item);
			}
		}



		/**
		 * Parse the requested setting file and return as an object
		 * Check the keyed cache of configuration items, as this will
		 * be the fastest method of retrieving the configuration option. After an
		 * item is parsed, it is always stored in the cache by its key.
		 * @param  string $path Setting file location
		 * @return object       Settings
		 */
		protected static function _parse($key) {
			if (array_key_exists($key, static::$cache)) {
				return static::$cache[$key];
			}

			$segments = explode(".", $key);

			if (count($segments) >= 2) {
				$parsed = array($segments[0], implode('.', array_slice($segments, 1)));
			} else {
				$parsed = array($segments[0], null);
			}
			return static::$cache[$key] = $parsed;
		}

		protected function _getExceptionForImplementation($method) {
			return new \Exception("{$method} method not implemented", 500);
		}
	}
}