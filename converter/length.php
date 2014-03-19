<?php
namespace PHPConverter\Converter {

	use PHPConverter\Core\Configuration as Configuration;

	/**
	 * Length
	 * Converter for converting between units of length
	 * @author Geoff Chapman <geoff.chapman@mc.com>
	 * @version 1.0
	 * @package PHPConverter\Converter 
	 */
	class Length extends Converter {
		
		/**
		 * Units within this measurement
		 * @var array
		 */
		protected $_units = array();

		/**
		 * Aliases used to refer to units within this measurement
		 * @var array 
		 */ 
		protected $_aliases = array();

		/**
		 * Retrieve the preregistered units and aliases for this measurement
		 * @return void
		 */
		public function __construct() {

			$this->_units = Configuration::get('length.units');
			$this->_aliases = Configuration::get('length.aliases');
		}

		/**
		 * Convert measurement to the given unit
		 * @param string $toUnit Unit to be converted to
		 * @return float 		 The measurement in the desired unit
		 */
		protected function lengthConversion($toUnit) {

				$fromUnit = $this->fetchUnit($this->_fromUnit);
				$toUnit = $this->fetchUnit($toUnit);
				$toValue = ($this->_fromValue * $fromUnit) / $toUnit;
				return $toValue;
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
		 * Magic method allowing any unit names to be used to call conversion
		 * @param string $toUnit The desired unit of measure
		 * @return float 		 Converted measurement from callback
		 */
		public function __call($toUnit, $parameters){

			return call_user_func(array($this, 'lengthConversion'), $toUnit);
		}

	}
}