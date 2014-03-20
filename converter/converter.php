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

		/**
		 * Retrieve the required conversion factor for the required unit
		 * @param string $unit The unit to be retrieved
		 * @return float 	   The conversion factor for the given unit
		 * @throws \Exception  The required unit is not registered
		 */
		protected function fetchUnit($unit) {

			foreach ($this->_units as $key => $value) {
				if ($unit === $key || $this->isAlias($unit, $key)) {
					return $value;
				}
			}

			throw new \Exception("{$unit} is not a supported unit", 1);
		}

		/**
		 * Check if the required unit is an alias of a registered unit
		 * @param string $unit The required unit to be tested
		 * @param string $key  The array of the registered unit to be tested
		 * @return boolean
		 */
		protected function isAlias($unit, $key) {

			return in_array($unit, $this->_aliases[$key]);
		}

		/**
		 * Add units to measurement type at runtime
		 * @param string    $name    Identifier of unit to be added
		 * @param int|float $value   The conversion factor of the unit being added
		 * @param array     $aliases Optional aliases for the new unit
		 * @throws \Exception        Unit name not suitable
		 * @throws \Exception        Unit not a valid number
		 * @return object
		 */
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
					$this->addAlias($name, $value);
				}
			}
			return $this;
		}

		/**
		 * Add an alias to a registered unit at runtime
		 * @param string $name Identifier of unit to be aliased
		 * @param string $alias Alias to be applied
		 */
		public function addAlias($name, $alias) {

			if (array_key_exists($name, $this->_units)) {
				$this->_aliases[$name][] = $alias;
			} else {
				throw new \Exception("{$name} is not a registered unit", 1);
			}
		}



		public function __toString() {
			# code...
		}

	}
}