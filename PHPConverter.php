<?php
namespace PHPConverter {

	// Core Files
	include 'core/arraymethods.php';
	include 'core/configuration.php';

	// Converters
	include 'converter/converter.php';
	include 'converter/area.php';
	include 'converter/coordinates.php';
	include 'converter/length.php';
	include 'converter/mass.php';
	include 'converter/volume.php';


	error_reporting(-1);
	/**
	* 
	*/
	class PHPConverter  {
		
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