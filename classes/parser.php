<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Hybrid;

use \FuelException;

/**
 * Hybrid 
 * 
 * A set of class that extends the functionality of FuelPHP without 
 * affecting the standard workflow when the application doesn't actually 
 * utilize Hybrid feature.
 * 
 * @package     Fuel
 * @subpackage  Hybrid
 * @category    Parser
 * @author      Mior Muhammad Zaki <crynobone@gmail.com>
 */

class Parser 
{
	/**
	 * Cache text instance so we can reuse it on multiple request eventhough 
	 * it's almost impossible to happen
	 * 
	 * @static
	 * @access  protected
	 * @var     array
	 */
	protected static $instances = array();

	/**
	 * Initiate a new Parser instance
	 * 
	 * @static
	 * @access  public
	 * @return  object
	 * @throws  \FuelException
	 */
	public static function __callStatic($method, array $arguments)
	{
		if ( ! in_array($method, array('factory', 'forge', 'instance', 'make')))
		{
			throw new FuelException(__CLASS__.'::'.$method.'() does not exist.');
		}

		$name = empty($arguments) ? null : $arguments[0];
		$name = $name ?: '';
		$name = strtolower($name);

		if ( ! isset(static::$instances[$name]))
		{
			$driver = "\Hybrid\Parser_".ucfirst($name);
		
			// instance has yet to be initiated
			if (class_exists($driver))
			{
				static::$instances[$name] = new $driver();
			}
			else
			{
				throw new FuelException("Requested {$driver} does not exist.");
			}
		}

		return static::$instances[$name];
	}

	/**
	 * Hybrid\Parser doesn't support a construct method
	 *
	 * @access  protected
	 */
	protected function __construct() {}

}