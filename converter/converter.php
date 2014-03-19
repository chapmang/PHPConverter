<?php
namespace PHPConverter\Converter {
	use PHPConverter\Core\Base as Base;
	/**
	* 
	*/
	class Converter {
		
		/**
		 * @readwrite
		 */
		protected $_value;

		/**
		 * @readwrite
		 */
		protected $_fromUnit;

		public function convert ($value, $fromUnit){
			$this->_value = $value;
			$this->_fromUnit = $fromUnit;
			
			return $this;
		}

		public function toUnit($toUnit) {
			
		
				return call_user_func(array($this, $toUnit), array());
			
		}

		// public function __toString() {
		// 	# code...
		// }

	}
}