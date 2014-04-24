<?php

/*
|--------------------------------------------------------------------------
| Mass
|--------------------------------------------------------------------------
|
| Conversion factors between units of mass and the native unit of
| kilograms. New units of mass can be add by appending them to this 
| array or by calling the 'newUnit' method to add them 
| temporarily at run time
|
*/

return array(

	"units" => array(
		// Metric units - SI
		"fg"	=> 1e-18,
		"pg"	=> 1e-15,
		"ng"	=> 1e-12,
		"μg"	=> 1e-9,
		"mg"	=> 1e-6,
		"cg"	=> 1e-5,
		"dg"	=> 1e-4,
		"g"		=> 1e-3,
		"dag"	=> 1e-2,
		"hg"	=> 1e-1,
		"kg"	=> 1,
		"Mg"	=> 1e3,
		"Gg"	=> 1e6,
		"Tg"	=> 1e9,
		"Pg"	=> 1e12,
		// Imperial units - avoirdupois
		"gr"	=> 6.47989e-5,
		"dr"	=> 0.00177184519531250009,
		"oz"	=> 0.028349523125,
		"lb"	=> 0.45359237,
		"st"	=> 6.35029318,
		"qtr"	=> 12.70058636,
		"cwt"	=> 50.80234544,
		"ton"	=> 1016.0469088,
		// Imperial units - troy
		"pwt"	=> 0.00155517,
		"ozt" 	=> 0.03110347,
		"lbt"	=> 0.37324172,
		// other
		"u" 	=> 1.660538921e-27,
		"eV"	=> 1.783e-36,
		"sl"	=> 14.593903,
		"mp"	=> 2.17651e-8,
		"Mo"	=> 1.98855e30
	),

	"aliases" => array(
		"fg" => array(
			"femtogram"
		),
		"pg" => array(
			"picogram"
		),
		"ng" => array(
			"nanogram"
		),
		"μg" => array(
			"mcg",
			"microgram"
		),
		"mg" => array(
			"milligram"
		),
		"cg" => array(
			"centigram"
		),
		"dg" => array(
			"decigram"
		),
		"g" => array(
			"gram"
		),
		"dag" => array(
			"decagram"
		),
		"hg" => array(
			"hectogram"
		),
		"kg" => array(
			"kilogram",
			"kilo"
		),
		"Mg" => array(
			"megagram",
			"t",
			"tonne"
		),
		"Gg" => array(
			"gigagram"
		),
		"Tg" => array(
			"teragram"
		),
		"Pg" => array(
			"petagram"
		),
		"gr" => array(
			"grain"
		),
		"dr" => array(
			"drachm"
		),
		"oz" => array(
			"ounce"
		),
		"lb" => array(
			"pound"
		),
		"st" => array(
			"stone"
		),
		"qtr" => array(
			"quater"
		),
		"cwt" => array(
			"hundredweight"
		),
		"ton" => array(
		),
		"pwt" => array(
			"pennyweight"
		),
		"ozt" => array(
			"troy ounce"
		),
		"lbt" => array(
			"troy pound"
		),
		"u" => array(
			"atomic mass unit",
			"dalton",
			"Da"
		),
		"eV" => array(
			"electronvolt",
			"electron volt"
		),
		"sl" => array(
			"slug"
		),
		"mp" => array(
			"Plank mass"
		),
		"Mo" => array(
			"solar mass"
		)
	)
);