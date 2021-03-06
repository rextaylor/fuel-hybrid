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

use \Config;
use \Model_Crud;

/**
 * Hybrid 
 * 
 * A set of class that extends the functionality of FuelPHP without 
 * affecting the standard workflow when the application doesn't actually 
 * utilize Hybrid feature.
 * 
 * @package     Fuel
 * @subpackage  Hybrid
 * @category    Auth_Model_Social
 * @deprecated
 * @author      Mior Muhammad Zaki <crynobone@gmail.com>
 */

class Auth_Model_Social extends Model_Crud
{
	protected static $_table_name = 'authentications';

	protected static $_mysql_timestamp;

	protected static $_created_at;

	protected static $_updated_at;

	public static function _init()
	{
		Config::load('autho', 'autho');
		Config::load('hybrid', 'hybrid');

		$config              = Config::get('autho.mysql_timestamp');
		static::$_table_name = Config::get('hybrid.tables.social', static::$_table_name);

		switch ($config)
		{
			case true :
			case false :
				static::$_created_at      = 'created_at';
				static::$_updated_at      = 'updated_at';
				static::$_mysql_timestamp = $config;
			break;

			case null :
			default :
				// don't do anything
		}
	}

}