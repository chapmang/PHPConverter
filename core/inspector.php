<?php
namespace PHPConverter\Core {
	require 'ArrayMethods.php';
	use PHPConverter\Core\ArrayMethods as ArrayMethods;
	use PHPConverter\Core\StringMethods as StringMethods;

	/**
	 * Inspector
	 * Using PHP Reflection class to build meta data
	 * from Doc Comments. Covers Classes, Properties
	 * and Methods
	 * @version  1.0
	 * @author Geoff Chapman <geoff.chapman@mac.com>
	 * @package PHPConverter\Core
	 */
	class Inspector {

		/**
		 * Class being inspected
		 * @var string
		 */
		protected $_class;

		/**
		 * Meta data of class being inspected
		 * @var array
		 */
		protected $_meta = array(
			"class " => array(),
			"properties" => array(),
			"methods" => array()
			);

		/**
		 * Properties of class being inspected
		 * @var array
		 */
		protected $_properties = array();

		/**
		 * Methods of class being instecpted
		 * @var array
		 */
		protected $_methods = array();


		public function __construct($class) {
			$this->_class = $class;
		}

		/**
		 * Get a string of class Doc Comments
		 * @return string Doc Comments of the class
		 */
		protected function _getClassComment() {
			$reflection = new \ReflectionClass($this->_class);
			return $reflection->getDocComment();
		}

		/**
		 * Get array of proprties of the class
		 * @return array Properties of the class
		 */
		protected function _getClassProperties() {
			$reflection = new \ReflectionClass($this->_class);
			return $reflection->getProperties();
		}

		/**
		 * Get array of Methods of the class
		 * @return array Methods of the class
		 */
		protected function _getClassMethods() {
			$reflection = new \ReflectionClass($this->_class);
			return $reflection->getMethods();
		}
		
		/**
		 * Get a string of a proprties Doc Comments
		 * @param  string $property Property to be inspected
		 * @return string           Doc Comments of property
		 */
		protected function _getPropertyComment($property) {
			$reflection = new \ReflectionProperty($this->_class, $property);
			return $reflection->getDocComment();
		}

		/**
		 * Get a string of methods Doc Comments
		 * @param  string $method Method to be inspected
		 * @return string         Doc Comments of method
		 */
		protected function _getMethodComment($method) {
			$reflection = new \ReflectionMethod($this->_class, $method);
			return $reflection->getDocComment();
		}

		/**
		 * Match Doc Comments to regular expresion to either
		 * set flag (no value in comment) or set value array.
		 * @param  string $comment Comment fto be inspected
		 * @return array          Meta data as Key/Values array
		 */
		protected function _parse($comment) {
            $meta = array();
            $pattern = "(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_]*)";
            $matches = StringMethods::match($comment, $pattern);
            
            if ($matches != null) {
                foreach ($matches as $match) {
                    $parts = ArrayMethods::clean(
                       ArrayMethods::trim(
                            StringMethods::split($match, "[\s]", 2)
                        )
                    );
	                $meta[$parts[0]] = true;
	                if (sizeof($parts) > 1) {
	                    $meta[$parts[0]] = ArrayMethods::clean(
	                        ArrayMethods::trim(
	                            StringMethods::split($parts[1], ",")
	                        )
	                    );
	                }
                }
            }
            return $meta;
        }

        /**
         * Get Metadata for inspected class
         * @return array Metadata for inspected class
         */
		public function getClassMeta() {
			if(!isset($_meta["class"])) {
				$comment = $this->_getClassComment();
				if(!empty($comment)) {
					$_meta["class"] = $this->_parse($comment);
				} else {
					$_meta["class"] = null;
				}
			}
			return $_meta["class"];
		}

		/**
		 * Get Properties for inspected class
		 * @return array Properties of inspected class
		 */
		public function getClassProperties() {
			if (!isset($_properties)) {
				$properties = $this->_getClassProperties();
				foreach ($properties as $property) {
					$_properties[] = $property->getName();
				}
			}
			return $_properties;
		}

		/**
		 * Get Methods of inspected class
		 * @return array Methods of inspected class
		 */
		public function getClassMethods() {
			if(!isset($_methods)) {
				$methods = $this->_getClassMethods();
				foreach ($methods as $method) {
					$_methods[] = $method->getName();
				}
			}
			return $_methods;
		}

		/**
		 * Get metadata of inspected property
		 * @param  string $property Property to be inspected
		 * @return array           Metadata of inspected property
		 */
		public function getPropertyMeta($property) {
			if (!isset($_meta["properties"][$property])) {
				$comment = $this->_getPropertyComment($property);
				if (!empty($comment)) {
					$_meta["properties"]["property"] = $this->_parse($comment);
				} else {
					$_meta["properties"]["property"] = null;
				}
			}
			return $_meta["properties"]["property"];
		}

		/**
		 * Get metadata of inspected method
		 * @param  string $method Method to be inspected
		 * @return array         Metadata of inspected method
		 */
		public function getMethodMeta($method) {
			if (!isset($_meta["action"][$method])) {
				$comment = $this->_getMethodComment($method);
				if (!empty($comment)) {
					$_meta["methods"][$method] = $this->_parse($comment);
				} else {
					$_meta["methods"][$method] = null;
				}
			}
			return $_meta["methods"][$method];
		}
	};
}