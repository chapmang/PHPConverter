<?php

/*
|--------------------------------------------------------------------------
| Area
|--------------------------------------------------------------------------
|
| Conversion factors between units of area and the native unit of
| squared meters. New units of area can be add by appending them to this 
| array or by calling the 'addUnit' method to add them 
| temporarily at run time
|
*/

return array(

	"units" => array(
		// Metric units - SI
		"fm^2"	=> 1e-30,
		"pm^2"	=> 1e-24,
		"nm^2"	=> 1e-18,
		"μm^2"	=> 1e-12,
		"mm^2"	=> 1e-6,
		"cm^2" 	=> 1e-4,
		"dm^2"	=> 1e-2,
		"m^2" 	=> 1,
		"dam^2" => 1e2,
		"hm^2"	=> 1e4,
		"km^2" 	=> 1e6,
		"Mm^2"	=> 1e12,
		"Gm^2"	=> 1e18,
		"Tm^2"	=> 1e24,
		"Pm^2"	=> 1e30,
		// Metric units - Non SI
		"Å^2"	=> 1e-20,
		"mil^2"	=> 10e8,
		"xu^2"	=> 100.21e-30,
		// Imperial units
		"th^2"	=> 6.4516e-10,
		"in^2" 	=> 6.4516e-4,
		"ft^2" 	=> 9.290304e-2,
		"rd^2"	=> 25.29285264,
		"yd^2" 	=> 0.83612736,
		"ch^2"	=> 404.68564224,
		"fur^2"	=> 40468.564224,
		"mi^2" 	=> 2.589988110336e6,
		"nmi^2" => 3.429903995e6,
		"lea^2" => 2.3309892993024e7,
		"ac" 	=> 4046.856422,
		// Maritime units
		"ftm^2"	=> 3.43429094,
		"cable^2"	=> 34342.9094,
		"nmi^2" 	=> 3429904
	),

	"aliases" => array(
		"fm^2" => array(
			"square femtometer",
			"square femtometre",
			"square femtometers",
			"square femtometres",
			"square fermi"
		),
		"pm^2" => array(
			"square picometer",
			"square picometre",
			"square picometers",
			"square picometres"
		),
		"nm^2" => array(
			"square nanometer",
			"square nanometre",
			"square nanometers",
			"square nanometres"
		),
		"μm^2" => array(
			"square micrometer",
			"square micrometre",
			"square micrometers",
			"square micrometres",
			"square micron",
			"square microns"
		),
		"mm^2" => array(
			"square millimeter",
			"square millimetre",
			"square millimeters",
			"square millimetres"
		),
		"cm^2" => array(
			"square centimeter",
			"square centimetre",
			"square centimeters",
			"square centimetres"
		),
		"dm^2" => array(
			"square decimeter",
			"square decimetre",
			"square decimeters",
			"square decimetres"
		),
		"m^2" => array(
			"square meter",
			"square metre",
			"square meters",
			"square metres",
			"centiare"
		),
		"dam^2" => array(
			"square decameter",
			"square decametre",
			"square dekameter",
			"square dekametre",
			"square decameters",
			"square decametres",
			"square dekameters",
			"square dekametres",
			"are"
		),
		"hm^2" => array(
			"square hectometer",
			"square hectometre",
			"square hectomters",
			"square hectometres",
			"hectare"
		),
		"km^2" => array(
			"square kilometer",
			"square kilometre",
			"square kilometers",
			"square kilometres"
		),
		"Mm^2" => array(
			"square megameter",
			"square megametre",
			"square megameters",
			"square megametres"
		),
		"Gm^2" => array(
			"square gigameter",
			"square gigametre",
			"square gigameters",
			"square gigametres"
		),
		"Tm^2" => array(
			"square terameter",
			"square terametre",
			"square terameters",
			"square terametres"
		),
		"Pm^2" => array(
			"square petameter",
			"square petametre",
			"square petameters",
			"square petametres"
		),
		"Å^2"  => array(
			"square angstrom",
			"square ångström"
		),
		"mil^2" => array(
			"square myriametre",
			"square myriameter"
		),
		"xu^2" => array(
			"square x unit"
		),
		"th^2" => array(
			"square thou",
			"square thousandth",
			"sq thou",
			"sq thousandth"
		),
		"in^2" => array(
			"square inch",
			"square inches",
			"sq inch",
			"sq inches"
		),
		"ft^2" => array(
			"square foot",
			"square feet",
			"sq foot",
			"sq feet",
		),
		"yds^2" => array(
			"square yard",
			"square yards",
			"sq yard",
			"sq yards"
		),
		"rd^2" => array(
			"square rod",
			"square rods",
			"perch",
			"perches",
			"pole",
			"poles"
		),
		"ch^2" => array(
			"square chain",
			"square chains",
			"sq chain",
			"sq chains"
		),
		"fur^2" => array(
			"square furlong",
			"square furlongs",
			"sq furlong",
			"sq furlongs"
		),
		"mi^2" => array(
			"square mile",
			"square miles",
			"square statute mile",
			"square statute miles",
			"sq mile",
			"sq miles",
			"sq statute mile",
			"sq statute miles"
		),
		"lea^2" => array(
			"square league",
			"square leagues",
			"sq league",
			"sq leagues"
		),
		"ac" => array(
			"acre",
			"acres"
		),
		"ftm^2" => array(
			"square fathom",
			"square fathoms",
			"sq fathom",
			"sq fathoms"
		),
		"nmi^2" => array(
			"square nautical mile",
			"square nautical miles",
			"sq nautical mile",
			"sq nautical miles"
		)
	)
);