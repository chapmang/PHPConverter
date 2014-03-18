<?php
namespace PHPConverter\Core {
	require 'StringMethods.php';
	
	use PHPConverter\Core\Inspector as Inspector;
	use PHPConverter\Core\ArrayMethods as ArrayMethods;
	use PHPConverter\Core\StringMethods as StringMethods;

	/**
	 * Base
	 * Utilizing metadata generate Getters/Setters for permitted
	 * child class properties
	 * @author Geoff Chapman <geoff.chapman@mac.com>
	 * @version 1.0
	 * @package PHPConverter\Core
	 */

	class Base {

		/**
		 * Instance of inspector class
		 * @var object
		 */
		private $_inspector;

		/**
		 * Identify properties fo child class and
		 * create any setters requested in instantiation
		 * @param array $options Parameters to have setters created 
		 */
		public function __construct($options = array()) {
			$this->_inspector = new Inspector($this); // Inspector to identify Getter/Setter properties of child
			if (is_array($options) || is_object($options)) {
				foreach ($options as $key => $value) {
					$key = ucfirst($key);
					$method = "set{$key}";
					$this->$method($value);
				}
			}
		}

		/**
		 * Check the Inspector is set and handle and getProperty(),
		 * setProperty() methods based upon metadata of defined properties
		 * @param  string $name      Name of property to be inspected
		 * @param  array $arguments Paramerters to be passed to property
		 */
		public function __call($name, $arguments) {
			// Check class calls parent construct
			if (empty($this->_inspector)) {
				throw new \Exception("Call parent::_construct!");
			}
			
			// If reading permissable return property value
			$getMatches = StringMethods::match($name, "^get([a-zA-Z0-9]+)$");
			if (sizeof($getMatches) > 0) {
				$normalized = lcfirst($getMatches[0]);
				$property = "_{$normalized}";
				if (property_exists($this, $property)) {
					$meta = $this->_inspector->getPropertyMeta($property);
					if(empty($meta["@readwrite"]) && empty($meta["@read"])) {
						throw $this->_getExceptionForWriteonly($normalized);
					}
					if (isset($this->$property)) {
						return $this->$property;
					}

					return null;
				}
			}

			// If writing is permissable set property value
			$setMatches = StringMethods::match($name, "^set([a-zA-Z0-9]+)$");
			if (sizeof($setMatches > 0 )) {
				$normalized = lcfirst($setMatches[0]);
				$property = "_{$normalized}";
				if (property_exists($this, $property)) {
					$meta = $this->_inspector->getPropertyMeta($property);
					if (empty($meta["@readwrite"]) && empty($meta["@write"])) {
						throw $this->_getExceptionForReadonly($normalized);
					}
					$this->$property = $arguments[0];
					return $this;
				}
			}

			// If property does not exist in a class thow exception
			throw $this->_getExceptionForImplementation($name);
		}

		/**
		 * Transparent getter treating protected property as public
		 * @param  string $name Name of property to be got
		 * @return object       The requested property
		 */
		public function __get($name) {
			$function = "get".ucfirst($name);
			return $this->$function();
		}

		/**
		 * Transparent setter treating protected property as public
		 * @param string $name  Name of property to be set
		 * @param string|interger|array|boolean|object $value Value to set to property
		 */
		public function __set($name, $value) {
			$function = "set".ucfirst($name);
			return $this->$function($value);
		}

		
		protected function _getExceptionForReadonly($property) {
			return new \Exception("\"{$property}\" is a read-only property", 500);
		}

		protected function _getExceptionForWriteonly($property) {
			return new \Exception("\"{$property}\" is a write-only property", 500);
		}

		protected function _getExceptionForProperty() {
			return new \Exception("Invlaid property", 500);
		}

		protected function _getExceptionForImplementation($method) {
			return new \Exception("{$method} method not implemented", 500);
		}
	}
}