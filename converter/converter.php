<?php
namespace PHPConverter\Converter {

	use PHPConverter\Core\StringMethods as StringMethods;

	/**
	* Converter
	* Parent class for all measurement specific converters
	* allowing standard methods for all conversion type
	* @author Geoff Chapman <geoff.chapman@mac.com>
	* @version 1.0
	* @package PHPConverter\Converter
	*/
	class Converter {
		
		/**
		 * Value to be converted
		 * @var float
		 */
		protected $_fromValue;

		/**
		 * Unit to be converted from
		 * @var string
		 */
		protected $_fromUnit;

		/**
		 * Units within a given measurement
		 * @var array
		 */
		protected $_units = array();

		/**
		 * Aliases used to refer to units within a given measurement
		 * @var array 
		 */ 
		protected $_aliases = array();

		/**
		 * Set the start values and return object
		 * @param float  $value 	The value to be converted
		 * @param string $fromUnit  The original unit of the value
		 * @return object
		 */
		public function convert ($value, $fromUnit) {

			$this->_fromValue = $value;
			$this->_fromUnit = $fromUnit;
			
			return $this;
		}

		/**
		 * Retrieve the value in the given unit
		 * @param string $toUnit Unit to be converted to
		 * @return mixed 		 The value in the required unit
		 */
		public function toUnit($toUnit) {
		
			return call_user_func(array($this, $toUnit), array());	
		}



		public function addUnit($name, $value, $aliases = array()) {

			if (!StringMethods::match($name, "#^([a-zA-Z]+)$#")) {
				throw new \Exception("The unit's key must be letters only", 1);
			}

			if (!is_numeric($value)) {
				throw new \Exception("{$name}'s value must be either an integer or a float value", 1);
			}
			
			$this->_units[$name] = $value; 

			if (!empty($aliases)) {
				foreach ($aliases as $key => $value) {
					$this->_aliases[$name][] = $value;
				}
			}
			return $this;
		}

		public function addAlias($name, $alias) {
			$this->_aliases[$name][] = $alias;
		}

		public function __toString() {
			# code...
		}

	}
}