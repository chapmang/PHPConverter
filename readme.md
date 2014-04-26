# PHPConverter

PHPConverter is simple name-spaced library for converting between different units of measure.

The library come pre-loaded with a basic set of units of measurement for length, area, mass and volume along with common aliases for each of the units.

## How to use

Make sure that you have the library loaded via your autoloader or by simply including the the factory PHPConverter class (PHPConveter.php).

To do a simple conversion between existing units within a measure.
	
	// PHPConverter\PHPConverter::convert(measure, value, fromUnit);
	$example = PHPConverter\PHPConverter::convert('length', 65, 'ft');
	echo $example->toUnit('m');


You can add a new unit of measurement at runtime, simply be registering the unit and it's conversion to the base SI unit.
	
	// $example->addUnit(name, constant to SI unit, aliases = array());
	$example->addUnit("smoot", 1.70180, array("oliver"));
	echo $example->toUnit('smoot');

To add a new alias to a unit in the measurement type at runtime
	
	// $example->addAlias(name, alias);
	$example->addAlias("smoot", "oliver");
