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
		 * Magic method allowing any unit names to be used to call conversion
		 * @param string $toUnit The desired unit of measure
		 * @return float 		 Converted measurement from callback
		 */
		public function __call($toUnit, $parameters){

			return call_user_func(array($this, 'lengthConversion'), $toUnit);
		}

	}
}