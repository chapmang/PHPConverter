# PHPConverter

PHPConverter is simple name-spaced library for converting between different units of measure.

## How to use

Make sure that you have the library load via your autoloader or by simply including the the factory PHPConverter class (PHPConveter.php).

To do a simple conversion between existing units within a measure.
	
	// PHPConverter\PHPConverter::convert(measure, value, fromUnit);
	$example = PHPConverter\PHPConverter::convert('length', 65, 'ft');
	echo $example->toUnit('m');


To add a new unit of measurement at runtime (Aliases optional)
	
	// $example->addUnit(name, constant to SI unit, aliases = array());
	$example->addUnit("smoot", 1.70180, array("oliver"));
	echo $example->toUnit('meters');

To add a new alias to a unit in the measurement type at runtime
	
	// $example->addAlias(name, alias);
	$example->addAlias("smoot", "oliver");
