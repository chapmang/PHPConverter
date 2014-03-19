<?php
namespace PHPConverter\Converter {

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


		public function __toString() {
			# code...
		}

	}
}