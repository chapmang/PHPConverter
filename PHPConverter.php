<?php
namespace PHPConverter {
	require_once 'core/base.php';
	require_once 'core/inspector.php';
	require_once 'converter\length.php';

	error_reporting(-1);
	/**
	* 
	*/
	class PHPConverter extends Core\Base {
		
		/**
		 * @readwrite
		 */
		protected static $_resultValues = array();


		public static function convert($type, $value, $fromUnit) {
			
			static::$_resultValues = static::converter($type)->convert($value, $fromUnit);
			return static::$_resultValues;
		}

		protected static function converter($type) {
			
			switch ($type) {
				case 'area':
					return new Converter\Area;
					break;
				case 'coordinates':
					return new Converter\Coordinates;
					break;
				case 'length':
					return new Converter\Length;
					break;
				case 'mass':
					return new Converter\Mass;
					break;
				case 'volume':
					return new Converter\Volume;
					break;
				default:
					throw new \Exception("Converter {$type} is not supported", 1);
					break;
			}
		}
	}
}