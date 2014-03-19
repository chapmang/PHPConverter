<?php

/*
|--------------------------------------------------------------------------
| Length
|--------------------------------------------------------------------------
|
| Conversion factors between units of length and the native unit of
| meters. New units of length can be add by appending them to this 
| array or by calling the 'newUnit' method to add them 
| temporarily at run time
|
*/

return array(

	"units" => array(
		"m"	 	=> 1,
		"mm" 	=> 0.001,
		"cm" 	=> 0.01,
		"km" 	=> 1000,
		"in" 	=> 0.0254,
		"ft" 	=> 0.3048,
		"yds" 	=> 0.9144,
		"ftm" 	=> 1.8288,
		"mi" 	=> 1609.344,
		"nm" 	=> 1852,
		"ly" 	=> 9460000000000000
	),

	"aliases" => array(
		"m" => array(
			"meter",
			"metre",
			"meters",
			"metres",
		),
		"mm" => array(
			"millimeter",
			"millimetre",
			"millimeters",
			"millimetres"
		),
		"cm" => array(
			"centimeter",
			"centimetre",
			"centimeters",
			"centimetres"
		),
		"km" => array(
			"kilometer",
			"kilometre",
			"kilometers",
			"kilometres"
		),
		"in" => array(
			"inch",
			"inches"
		),
		"ft" => array(
			"foot",
			"feet",
		),
		"yds" => array(
			"yard",
			"yards"
		),
		"ftm" => array(
			"fathom",
			"fathoms"
		),
		"mi" => array(
			"mile",
			"miles",
			"statute mile",
			"statute miles"
		),
		"nm" => array(
			"nmi",
			"nautical mile",
			"nautical miles"
		),
		"ly" => array(
			"light-year",
			"light-years",
			"light year",
			"light years",
		)
	)
);