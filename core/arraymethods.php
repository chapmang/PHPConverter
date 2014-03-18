<?php
namespace PHPConverter\Core {

	/**
 	* ArrayMethods
 	* Utility class for working with basic array data
 	* @version  1.0
 	* @author Geoff Chapman <geoff.chapman@mac.com>
 	* @package Framework
 	*/
	class ArrayMethods {
		
		private function __construct() {}

		private function __clone() {}

		/**
		 * Remove all value considered empty
		 * @param  Array $array Array to be cleaned
		 * @return Array        Cleaned array
		 */
		public static function clean($array) {
			return array_filter($array, function($item) {
				return !empty($item);
			});
		}

		/**
		 * Remove all whitespace from array values
		 * @param  Array $array Array to be trimmed
		 * @return Array        Trimmed array
		 */
		public static function trim($array) {
			return array_map(function($item) {
				return trim($item);
			}, $array);
		}

		/**
		 * Get first item in an array
		 * @param  array $array Array to be searched
		 * @return array        First item in supplied array
		 */
		public static function first($array) {
            if (count($array) == 0) {
                return null;
            }
            $keys = array_keys($array);
            return $array[$keys[0]];
        }
        
        /**
         * Get last itlm in an array
         * @param  array $array Array to be searched
         * @return array        Last item in supplied array
         */
        public static function last($array) {
          if (count($array) == 0) {
                return null;
            }
            $keys = array_keys($array);
            return $array[$keys[count($keys) - 1]];
        }

		/**
		 * Convert an associative array to an object
		 * @param  Array $array Associative array for converting
		 * @return Object       Converted Object
		 */
		public static function toObject($array) {
			$result = new \stdClass();
			foreach ($array as $key => $value) {
				if (is_array($value)) {
					$result->{$key} = self::toObject($value);
				} else {
					$result->{$key} = $value;
				}
			}
			return $result;
		}

		/**
		 * Convert a multidimensional array into
		 * a unidimensional array
		 * @param  Array $array Array to be flatten
		 * @param  Array $value Optional array to append to 
		 * @return Array        Unidimentional array to return
		 */
		public function flatten ($array, $return = array()) {
			foreach ($array as $key => $value) {
				if (is_array($value) || is_object($value)) {
					$return = self::flatten($value, $return);
				} else {
					$return[] = $value;
				}
			}
		}

		/**
		 * Convert an array to a HTTP query string
		 * @param  array $array Paramaters to  converted
		 * @return string        HTTP query string
		 */
		public function toQueryString($array) {
            return http_build_query(
                self::clean(
                    $array
                )
            );
        }

        /**
		 * Get an item from an array using "dot" notation.
		 * @param  array   $array
		 * @param  string  $key
		 * @param  mixed   $default
		 * @return mixed
		 */
		public static function array_get($array, $key, $default = null) {

        	if (is_null($key)) return $array;
       
        	if (isset($array[$key])) return $array[$key];

        	foreach (explode('.', $key) as $segment) {

           		if ( ! is_array($array) or ! array_key_exists($segment, $array)) {
                 return $default;
            	}
 				$array = $array[$segment];
         	}
 			return $array;
    	}
	}
}