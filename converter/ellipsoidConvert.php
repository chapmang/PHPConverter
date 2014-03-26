<?php
/**
 * 
 * EllipsoidConvert
 * 
 * A class for converting between ellipsoids.
 * 
 * @author Geoff Chapman <geoff.chapman@mac.com>
 * @version 2.0
 *
 */
		
class EllipsoidConvert {

	protected $lat;

	protected $lon;

	protected $fromDatum;

	// Source Ellipse parameters
	protected $fromEllipse = array();

	// Destination Ellipse parameters
	protected $toEllipse = array();

	// Source Helmert transform parameters
	protected $fromHelmert = array();
	
	// Destination Helmert transform parameters
	protected $toHelmert = array();

	/**
	 * @todo Is the transformation to / from WGS84 if not loop using WGS84 as mid point
	 * @todo fetch parameters from config file (build config file)
	 * @todo validate lat, lon and datum name
	 * @todo work out what the hell i'm doing with the datum in the objectS
	 */
	public function __construct($lat, $lon, $datum, $height = 0) {
		$this->lat = $lat;
		$this->lon = $lon;
		$this->fromDatum = $datum;
		$this->height = $hight;

		if(!$this->validate()) {
			throw new \Exception("Error Processing Request", 1);
		};
	}


	/**
	 * convert
	 * 
	 * 3D conversion a set of coordinates from ellipsoid to another
	 * 
	 * @access	private
	 * @param	object		A LatLon pair in decimal degrees
	 * @param	array		Source ellipsoid parameters
	 * @param	array		Helmert transformation parameters
	 * @param	array		Destination ellipsoid parameters
	 * @return	object		LatLon as decimal degrees
	 *  
	 */
	private function convert($toDatum) {

		$this->toDatum = $toDatum;

		list($x, $y, $z) = $this->toCartesian();
		list($x1, $y1, $z1) = $this->helmertTransform($x, $y, $z);
		list($x2, $y2, $z2) = $this->toPolar($x1, $y1, $z1);

		$this->lat = $x2;
		$this->lon = $y2;
		$this->height = $z2;

		return $this;

	}

	/**
	 * Converting latitude, longitude and ellipsoid height to
	 * 3-D Cartesian coordinates.
	 * @return array
	 */
	private function toCartesian() {

		// Convert from degrees to radians
	  	$radLat = deg2rad($this->lat);
	  	$radLon = deg2rad($this->lon);
	  	$height = $this->height; 
	
	  	$semiMajor = $this->fromDatum->ellipsoid["a"]; // semi-major axis length of ellipsoid
	  	$semiMinor = $this->fromDatum->ellipsoid["b"]; // semi-minor axis length of ellipsoid
		
	  	$sinLat = sin($radLat);
	  	$cosLat = cos($radLat);
	  	$sinLon = sin($radLon);
	  	$cosLon = cos($radLon);
	
		$eSq = (pow($semiMajor,2) - pow($semiMinor,2)) / pow($semiMajor,2); // eccentricity squared of ellipsoid
	  	$v = $semiMajor / sqrt(1 - $eSq * pow($sinLat,2)); // prime vertical radius of curvature @ $this->lat
	
	  	$x = ($v+$height) * $cosLat * $cosLon;
	  	$y = ($v+$height) * $cosLat * $sinLon;
	  	$z = ((1-$eSq)*$v + $height) * $sinLat;

	  	return array($x, $y, $z);
	}

	/**
	 * Transform 3-D Cartesian coordinates from one ellipsoidal datum to
	 * a second using the Helmert Transformation
	 * @param float $x 
	 * @param float $y
	 * @param float $z
	 * @return array
	 */
	private function helmertTransform($x, $y, $z) {
		
  		// Retrieve the translation vectors between the
  		// fromDatum and the toDatum
		$tx = $t["tx"]; // X-axis translation (metres)
		$ty = $t["ty"]; // Y-axis translation (metres)
		$tz = $t["tz"]; // Z-axis translation (metres)

		// Retrieve the rotations to be applied to the points vector
		// and normalise seconds to radians
		$rx = deg2rad($t["rx"]/3600); // X-axis rotation (radians)
		$ry = deg2rad($t["ry"]/3600); // Y-axis rotation (radians)
		$rz = deg2rad($t["rz"]/3600); // Z-axis rotation (radians)

		// Retrieve the scale correction while normalising from ppm
		$s = $t["s"]/1e6; // Scale factor (unit less)
		
		// Apply Helmert 7-parameter transform
		$x1 = $tx + $x*(1+$s) - $y*$rz + $z*$ry;
		$y1 = $ty + $x*$rz + $y*(1+$s) - $z*$rx;
		$z1 = $tz - $x*$ry + $y*$rx + $z*(1+$s);

		return array($x1, $y1, $z1);

	}

	/**
	 * Converting 3-D Cartesian coordinates to latitude, longitude
	 * and ellipsoid hight
	 * @param float $x1 
	 * @param float $y1
	 * @param float $z1 
	 * @return array
	 */
	private function toPolar($x1, $y1, $z1) {

	  	$semiMajor = $this->toDatum->ellipsoid["a"]; // semi-major axis length of fromDatum
	  	$semiMinor = $this->toDatum->ellipsoid["b"]; // semi-minor axis length of ellipsoid
	  	$precision = 4/$semiMajor;  // results accurate to around 4 metres
		
		// Initial value of latitude
		$eSq = (pow($semiMajor,2) - pow($semiMinor,2)) / pow($semiMajor,2); // eccentricity squared of ellipsoid
	 	$p = sqrt(pow($x2,2) + pow($y2,2));
		$phi = atan2($z2, $p * (1-$eSq)); // Initial value of latitude (before precision improvement)
		$phiP = 2 * pi();

		// Iteratively improve latitude by computing v until change between
		// successive values of $phi is smaller than $precision
	  	while (abs($phi-$phiP) > $precision) {
	    	$v = $semiMajor / sqrt(1 - $eSq * pow(sin($phi),2)); // prime vertical radius of curvature @ $phi
	    	$phiP = $phi;
	    	$phi = atan2($z2 + $eSq * $v * sin($phi), $p);
	  	}

	  	// Longitude
	  	$lambda = atan2($y1, $x1);

	  	// Convert from radians to degrees
	  	$x2 = rad2deg($phi);
	  	$y2 = rad2deg($lambda);
	  	$z2 = $p/cos($phi) - $v;

	  	return array($x2, $y2, $z2);
	}
};