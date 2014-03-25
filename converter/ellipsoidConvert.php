<?php
/**
 * 
 * EllipsoidConvert
 * 
 * A class for converting between Airy 1830 and WGS84(GRS80) ellipsoids.
 * Includes:
 * Options to interpolate between Airy 1830 and WGS84(GRS80) ellipsoids
 * Ability to handle various formats for both grid references and Latitude and Longitude 
 * 
 * @author		Geoff Chapman
 * @copyright	Copyright © 2012 Geoff Chapman
 * @since		Version 1.0
 * @link		http://aa-ap032/aamedia/user_guide/libraries/coorConversion.html
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

	public function __construct($lat, $lon, $datum, $height = 0) {
		$this->lat = $lat;
		$this->lon = $lon;
		$this->fromDatum = $datum;
		$this->height = $hight;

		if(!$this->validate()) {
			throw new \Exception("Error Processing Request", 1);
		};
	}

	}
	/**
	 * OSGB36toWGS84
	 * 
	 * Convert a given Lat Lon pair from OSGB36 to WGS84 coordinate reference system
	 * 
	 * @access	public
	 * @param	object	A LatLon pair in decimal degrees
	 * @return	object	LatLon as decimal degrees
	 *  
	 */
	public function OSGB36toWGS84($p1) {
	  	$p2 = $this->convert($p1, self::$e["Airy1830"], self::$h["OSGB36toWGS84"], self::$e["WGS84"]);
	  	return $p2;
		}
	
	/**
	 * WGS84toOSGB36
	 * 
	 * Convert a given Lat Lon pair from WGS84 to OSGB36 coordinate reference system
	 * 
	 * @access	public
	 * @param	object	A LatLon pair in decimal degrees
	 * @return	object	LatLon as decimal degrees
	 * 
	 */	
	//Convert WGS84 to OSGB36
	public function WGS84toOSGB36($p1)
		{
	  	$p2 = $this->convert($p1, self::$e["WGS84"], self::$h["WGS84toOSGB36"], self::$e["Airy1830"]);
	  	return $p2;
		}
	
	//3D Conversion of Ellipsoid 1 to Ellipsoid 2
	/**
	 * convert
	 * 
	 * 3D convertion a set of coordinates from ellipsoid to another
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

		list($x, $y, $z) = $this->toCartesian();



	  	//Convert polar to cartesian coordinates (using ellipse 1)
	  	$p1["lat"] = deg2rad($p->lat);
	  	$p1["lon"] = deg2rad($p->lon);
	  	$p1["height"] = $p->height; 
	
	  	$a = $e1["a"];
	  	$b = $e1["b"];
	
	  	$sinPhi = sin($p1["lat"]);
	  	$cosPhi = cos($p1["lat"]);
	  	$sinLambda = sin($p1["lon"]);
	  	$cosLambda = cos($p1["lon"]);
	  	$H = $p1["height"];
	
	  	$eSq = ($a*$a - $b*$b) / ($a*$a);
	  	$nu = $a / sqrt(1 - $eSq*$sinPhi*$sinPhi);
	
	  	$x1 = ($nu+$H) * $cosPhi * $cosLambda;
	  	$y1 = ($nu+$H) * $cosPhi * $sinLambda;
	  	$z1 = ((1-$eSq)*$nu + $H) * $sinPhi;
	
	
	  	//Apply helmert transform using appropriate params
	  
		$tx = $t["tx"];
		$ty = $t["ty"];
		$tz = $t["tz"];
		$rx = deg2rad($t["rx"]/3600);  // normalise seconds to radians
		$ry = deg2rad($t["ry"]/3600);
		$rz = deg2rad($t["rz"]/3600);
		$s1 = $t["s"]/1e6 + 1;              // normalise ppm to (s+1)
		
		// apply transform
		$x2 = $tx + $x1*$s1 - $y1*$rz + $z1*$ry;
		$y2 = $ty + $x1*$rz + $y1*$s1 - $z1*$rx;
		$z2 = $tz - $x1*$ry + $y1*$rx + $z1*$s1;
	
	
	  	//Convert cartesian to polar coordinates (using ellipse 2)
	
	  	$a = $e2["a"];
	  	$b = $e2["b"];
	  	$precision = 4/$a;  // results accurate to around 4 metres
	
	  	$eSq = ($a*$a -$b*$b) / ($a*$a);
	 	$p = sqrt($x2*$x2 + $y2*$y2);
		$phi = atan2($z2, $p*(1-$eSq));
		$phiP = 2*pi();
	  	while (abs($phi-$phiP) > $precision)
	  		{
	    	$nu = $a/sqrt(1-$eSq*sin($phi)*sin($phi));
	    	$phiP = $phi;
	    	$phi = atan2($z2 + $eSq*$nu*sin($phi), $p);
	  		}
	  	$lambda = atan2($y2, $x2);
	  	$H = $p/cos($phi) - $nu;
	
	  	return new LatLon(rad2deg($phi),rad2deg($lambda), $H);
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
		
		  	$a = $this->datum["a"]; // semi-major axis length of fromDatum
		  	$b = $this->datum["b"]; // eccentricity squared of fromDatum
			
		  	$sinLat = sin($radLat);
		  	$cosLat = cos($radLat);
		  	$sinLon = sin($radLon);
		  	$cosLon = cos($radLon);
		  	$H = $height;
		
		  	$eSq = (pow($a,2) - pow($b,2) / pow($a,2);
		  	$v = $a / sqrt(1 - $eSq*pow($sinLat,2);
		
		  	$x = ($v+$H) * $cosLat * $cosLon;
		  	$y = ($v+$H) * $cosLat * $sinLon;
		  	$z = ((1-$eSq)*$v + $H) * $sinLat;

		  	return array($x, $y, $z);
		}

		private function helmertTransform() {
			//Apply helmert transform using appropriate params
	  
			$tx = $t["tx"];
			$ty = $t["ty"];
			$tz = $t["tz"];
			$rx = deg2rad($t["rx"]/3600);  // normalise seconds to radians
			$ry = deg2rad($t["ry"]/3600);
			$rz = deg2rad($t["rz"]/3600);
			$s1 = $t["s"]/1e6 + 1;              // normalise ppm to (s+1)
			
			// apply transform
			$x2 = $tx + $x1*$s1 - $y1*$rz + $z1*$ry;
			$y2 = $ty + $x1*$rz + $y1*$s1 - $z1*$rx;
			$z2 = $tz - $x1*$ry + $y1*$rx + $z1*$s1;
	
		}

		private function cartesianToPolar() {
			//Convert cartesian to polar coordinates (using ellipse 2)
	
	  	$a = $e2["a"];
	  	$b = $e2["b"];
	  	$precision = 4/$a;  // results accurate to around 4 metres
	
	  	$eSq = ($a*$a -$b*$b) / ($a*$a);
	 	$p = sqrt($x2*$x2 + $y2*$y2);
		$phi = atan2($z2, $p*(1-$eSq));
		$phiP = 2*pi();
	  	while (abs($phi-$phiP) > $precision)
	  		{
	    	$nu = $a/sqrt(1-$eSq*sin($phi)*sin($phi));
	    	$phiP = $phi;
	    	$phi = atan2($z2 + $eSq*$nu*sin($phi), $p);
	  		}
	  	$lambda = atan2($y2, $x2);
	  	$H = $p/cos($phi) - $nu;
		}
	};