<?php
namespace PHPConverter\Converter {

	use PHPConverter\Core\Configuration as Configuration;

	/**
	* 
	*/
	class Length extends Converter {
		
		protected $_constants = array();

		public function __construct() {

			$this->_constants = Configuration::get('length');
		}

		protected function lengthConversion($toUnit) {

			if (array_key_exists($this->_fromUnit, $this->_constants)) {
				$fromUnit = $this->_constants[$this->_fromUnit];
				$toUnit = $this->_constants[$toUnit];
				return ($this->_value * $fromUnit) / $toUnit;
			} else {
				throw new \Exception("{toUnit} is not a supported unit", 1);
				
			}

		}

		public function __call($toUnit, $parameters){

			return call_user_func(array($this, 'lengthConversion'), $toUnit);
		}

	}
}