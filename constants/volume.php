<?php

/*
|--------------------------------------------------------------------------
| Volume
|--------------------------------------------------------------------------
|
| Conversion factors between units of volume and the native unit of
| cubic meter. New units of volume can be add by appending them to this 
| array or by calling the 'newUnit' method to add them 
| temporarily at run time
|
*/

return array(

	"units" => array(
		// Metric units - SI
		"pm^3"	=> 1e-36,
		"nm^3"	=> 1e-27,
		"μm^3"	=> 1e-18,
		"mm^3"	=> 1e-9,
		"cm^3"	=> 1e-6,
		"dm^3"	=> 1e-3,
		"m^3"	=> 1,
		"dam^3"	=> 1e3,
		"hm^3"	=> 1e6,	
		"km^3"	=> 1e9,
		"Mm^3"	=> 1e18,
		"Gm^3"	=> 1e27,
		"Tm^3"	=> 1e36,
		// other SI units
		"pl"	=> 1e-15,
		"nl"	=> 1e-12,
		"μl"	=> 1e-9,
		"ml"	=> 1e-6,
		"cl"	=> 1e-5,
		"dl"	=> 1e-4,
		"l"		=> 1e-3,
		"dal"	=> 1e-2,
		"hl"	=> 1e-1,
		"kl"	=> 1,
		"Ml"	=> 1e3,
		"Gl"	=> 1e6,
		"Tl"	=> 1e9,
		// Imperial
		"in^3"	=> 0.000016387064,
		"ft^3"	=> 0.028316846592,
		"yd^3"	=> 0.764554857984,
		"mi^3" 	=> 4168181825.440579584,
		"fl oz"	=> 28.4130625e-6,
		"pt"	=> 568.26125e-6,
		"qt"	=> 1.1365225e-3,
		"gal"	=> 4.54609e-3
	),

	"aliases" => array(
		"pm^3"	=> array(
			"cubic picometer",
			"cubic picometre",
			"cubic picometers",
			"cubic picometres",
		),
		"nm^3"	=> array(
			"cubic nanometer",
			"cubic nanometre",
			"cubic nanometers",
			"cubic nanometres"
		),
		"μm^3"	=> array(
			"cubic micrometer",
			"cubic micrometre",
			"cubic micrometers",
			"cubic micrometres"
		),
		"mm^3"	=> array(
			"cubic millimeter",
			"cubic millimetre",
			"cubic millimeters",
			"cubic millimetres"
		),
		"cm^3"	=> array(
			"cubic centimeter",
			"cubic centimetre",
			"cubic centimeters",
			"cubic centimetres"
		),
		"dm^3"	=> array(
			"cubic decimeter",
			"cubic decimetre",
			"cubic decimeters",
			"cubic decimetres"
		),
		"m^3"	=> array(
			"cubic meter",
			"cubic metre",
			"cubic meters",
			"cubic metres"
		),
		"dam^3"	=> array(
			"cubic decameter",
			"cubic decametre",
			"cubic decameters",
			"cubic decametres"
		),
		"hm^3"	=> array(
			"cubic hectometer",
			"cubic hectometre",
			"cubic hectometers",
			"cubic hectometres"
		),
		"km^3"	=> array(
			"cubic kilometer",
			"cubic kilometre",
			"cubic kilometers",
			"cubic kilometres"
		),
		"Mm^3"	=> array(
			"cubic megameter",
			"cubic megametre",
			"cubic megameters",
			"cubic megametres"
		),
		"Gm^3"	=> array(
			"cubic gigameter",
			"cubic gigametre",
			"cubic gigameters",
			"cubic gigametres"
		),
		"Tm^3"	=> array(
			"cubic terameter",
			"cubic terametre",
			"cubic terameters",
			"cubic terametres"
		),
		"pl^3"	=> array(
			"cubic picoliter",
			"cubic picolitre",
			"cubic picoliters",
			"cubic picolitres",
		),
		"nl^3"	=> array(
			"cubic nanoliter",
			"cubic nanolitre",
			"cubic nanoliters",
			"cubic nanolitres"
		),
		"μl^3"	=> array(
			"cubic microliter",
			"cubic microlitre",
			"cubic microliters",
			"cubic microlitres"
		),
		"ml^3"	=> array(
			"cubic milliliter",
			"cubic millilitre",
			"cubic milliliters",
			"cubic millilitres"
		),
		"cl^3"	=> array(
			"cubic centiliter",
			"cubic centilitre",
			"cubic centiliters",
			"cubic centilitres"
		),
		"dl^3"	=> array(
			"cubic deciliter",
			"cubic decilitre",
			"cubic deciliters",
			"cubic decilitres"
		),
		"l^3"	=> array(
			"cubic liter",
			"cubic litre",
			"cubic liters",
			"cubic litres"
		),
		"dal^3"	=> array(
			"cubic decaliter",
			"cubic decalitre",
			"cubic decaliters",
			"cubic decalitres"
		),
		"hl^3"	=> array(
			"cubic hectoliter",
			"cubic hectolitre",
			"cubic hectoliters",
			"cubic hectolitres"
		),
		"kl^3"	=> array(
			"cubic kiloliter",
			"cubic kilolitre",
			"cubic kiloliters",
			"cubic kilolitres"
		),
		"Ml^3"	=> array(
			"cubic megaliter",
			"cubic megalitre",
			"cubic megaliters",
			"cubic megalitres"
		),
		"Gl^3"	=> array(
			"cubic gigaliter",
			"cubic gigalitre",
			"cubic gigaliters",
			"cubic gigalitres"
		),
		"Tl^3"	=> array(
			"cubic teraliter",
			"cubic teralitre",
			"cubic teraliters",
			"cubic teralitres"
		),
		"in^3"	=> array(
			"cubic inch",
			"cubic inches"
		),
		"ft^3"	=> array(
			"cubic feet",
			"cubic foot"
		),
		"yd^3"	=> array(
			"cubic yard",
			"cubic yards"
		),
		"mi^3"	=> array(
			"cubic mile",
			"cubic miles"
		),
		"fl oz"	=> array(
			"fluid ounce",
			"fluid ounces"
		),
		"pt"	=> array(
			"pint",
			"pints"
		),
		"qt"	=> array(
			"quart",
			"quarts"
		),
		"gal"	=> array(
			"gallons",
			"gallon"
		)
	)
);