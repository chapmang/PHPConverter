# PHPConverter

PHPConverter is simple name-spaced library for converting between different units of measure.

## How to use

Make sure that you have the library load via your autoloader or by simply including the the factory PHPConverter class (PHPConveter.php).

To do a simple conversion between existing units within a measure.

	$example = PHPConverter\PHPConverter::convert('length', 65, ft);
	echo $example->toUnit('m');
