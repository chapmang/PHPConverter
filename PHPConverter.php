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
	* PHPConverter
	* Factory class of library to allow for conversion
	* between unit of measure
	* @author Geoff Chapman <geoff.chapman@mac.com>
	* @version 1.0
	* @package PHPConverter
	*/
	class PHPConverter  {
		
		/**
		 * Results of conversion
		 * @var array
		 */
		protected static $_resultValues = array();

		/**
		 * Instatiate a conversion
		 * @param string $type Conversion type
		 * @param mixed $value The value(s) to be converted
		 * @param string $fromUnit The unit to be converted from
		 */
		public static function convert($type, $value, $fromUnit) {
		
			static::$_resultValues = static::converter($type)->convert($value, $fromUnit);
			return static::$_resultValues;
		}

		/**
		 * Detect call to specific converter type
		 * @param string $type Convertion type to be used
		 * @return object
		 */
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