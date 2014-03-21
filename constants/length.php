<?php

/*
|--------------------------------------------------------------------------
| Length
|--------------------------------------------------------------------------
|
| Conversion factors between units of length and the native unit of
| meters. New units of length can be add by appending them to this 
| array or by calling the 'addUnit' method to add them 
| temporarily at run time
|
*/

return array(

	"units" => array(
		// Metric units - SI
		"fm"	=> 1e-15,
		"pm"	=> 1e-12,
		"nm"	=> 1e-9,
		"μm"	=> 1e-6,
		"mm" 	=> 1e-3,
		"cm" 	=> 1e-2,
		"dm"	=> 1e-1,
		"m"	 	=> 1,
		"dam"	=> 1e1,
		"hm"	=> 1e2,
		"km" 	=> 1e3,
		"Mm"	=> 1e6,
		"Gm"	=> 1e9,
		"Tm"	=> 1e12,
		"Pm"	=> 1e15,
		// Metric units - Non SI
		"Å"		=> 1e-10,
		"mil"	=> 10e4,
		"xu"	=> 100.21e-15,
		// Imperial units
		"th"	=> 0.0000254,
		"in" 	=> 0.0254,
		"ft" 	=> 0.3048,
		"rd"	=> 0.30480061,
		"yds" 	=> 0.9144,
		"ch"	=> 20.1168,
		"fur"	=> 201.168,
		"mi" 	=> 1609.344,
		"lea"	=> 4828.032,
		// Maritime units
		"ftm"	=> 1.853184,
		"cable"	=> 185.3184,
		"nmi" 	=> 1852,
		// Astronomy
		"au"	=> 1.4960e11,
		"ly" 	=> 9.4607e15,
		"pc"	=> 3.0857e16
	),

	"aliases" => array(
		"fm" => array(
			"femtometer",
			"femtometre",
			"femtometers",
			"femtometres",
			"fermi"
		),
		"pm" => array(
			"picometer",
			"picometre",
			"picometers",
			"picometres"
		),
		"nm" => array(
			"nanometer",
			"nanometre",
			"nanometers",
			"nanometres"
		),
		"μm" => array(
			"micrometer",
			"micrometre",
			"micrometers",
			"micrometres",
			"micron"
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
		"dm" => array(
			"decimeter",
			"decimetre",
			"decimeters",
			"decimetres"
		),
		"m" => array(
			"meter",
			"metre",
			"meters",
			"metres"
		),
		"dam" => array(
			"decameter",
			"decametre",
			"dekameter",
			"dekametre",
			"decameters",
			"decametres",
			"dekameters",
			"dekametres"
		),
		"hm" => array(
			"hectometer",
			"hectometre",
			"hectomters",
			"hectometres"
		),
		"km" => array(
			"kilometer",
			"kilometre",
			"kilometers",
			"kilometres"
		),
		"Mm" => array(
			"megameter",
			"megametre",
			"megameters",
			"megametres"
		),
		"Gm" => array(
			"gigameter",
			"gigametre",
			"gigameters",
			"gigametres"
		),
		"Tm" => array(
			"terameter",
			"terametre",
			"terameters",
			"terametres"
		),
		"Pm" => array(
			"petameter",
			"petametre",
			"petameters",
			"petametres"
		),
		"Å"  => array(
			"angstrom",
			"ångström"
		),
		"mil" => array(
			"myriametre",
			"myriameter"
		),
		"xu" => array(
			"x unit"
		),
		"th" => array(
			"thou",
			"thousandth"
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
		"rd" => array(
			"rod",
			"rods",
			"perch",
			"perches",
			"pole",
			"poles"
		),
		"ch" => array(
			"chain",
			"chains"
		),
		"fur" => array(
			"furlong",
			"furlongs"
		),
		"mi" => array(
			"mile",
			"miles",
			"statute mile",
			"statute miles"
		),
		"lea" => array(
			"league",
			"leagues"
		),
		"ftm" => array(
			"fathom",
			"fathoms"
		),
		"nmi" => array(
			"nautical mile",
			"nautical miles"
		),
		"au" => array(
			"astronomical unit"
		),
		"ly" => array(
			"light-year",
			"light-years",
			"light year",
			"light years",
		),
		"pc" => array(
			"parsec"
		)
	)
);