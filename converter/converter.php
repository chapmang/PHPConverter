<?php
namespace PHPConverter\Converter {
	use PHPConverter\Core\Base as Base;
	/**
	* 
	*/
	class Converter extends Base {
		
		/**
		 * @readwrite
		 */
		protected $_value;

		/**
		 * @readwrite
		 */
		protected $_fromUnit;

		public function convert ($value, $fromUnit){
			$this->value = $value;
			$this->fromUnit = $fromUnit;
			
			return $this;
		}

		public function toUnit($toUnit) {
			
			if (method_exists($this, $toUnit)) {
				return call_user_func_array(array($this, $toUnit), array());
			} else {
				throw new \Exception("Not a valid unit", 1);
				
			}
		}

		public function __toString() {
			# code...
		}

	}
}