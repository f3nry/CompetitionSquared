<?php

/**
 * Competition Squared: your competition, simplified
 *
 * Copyright (C) 2010  Paul Henry
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace app\models;

/**
 * ConfigVar
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AppConfig extends \li3_activerecord\extensions\data\Model {

    public static $table_name = "app_config";
    public static $primary_key = "var";
    public static $config_array = array();

    public static function get($var, $asObject = false, $default = false) {

        if (\array_key_exists($var, self::$config_array)) {
            $var = self::$config_array[$var];
        } else {
            $key = $var;
            $var = self::find('first', array('conditions' => array('var = ?', $var)));
            
            self::$config_array[$key] = $var;
        }

        if (!$var) {
            return ($default) ? $default : false;
        } else {
            if ($asObject) {
                return $var;
            } else {
                return unserialize($var->value);
            }
        }
    }

    public static function set($var, $value) {
        if ($configVar = self::get($var, true)) {
            $configVar->value = serialize($value);

            $configVar->save();
        } else {
            $configVar = self::create(array('var' => $var, 'value' => serialize($value)));

            $configVar->save();
        }
    }

}