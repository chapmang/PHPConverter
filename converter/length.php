<?php
namespace PHPConverter\Converter {
	require_once 'converter\converter.php';

	/**
	* 
	*/
	class Length extends Converter {
		
		

		public function feet(){
			return $this->value * 2;
		}
	}
}