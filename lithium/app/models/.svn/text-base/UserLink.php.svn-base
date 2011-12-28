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
 * UserLink
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class UserLink extends \li3_activerecord\extensions\data\Model {
    
    private static function _getRealType($object) {
        return strtoupper(end(explode('\\', get_class($object))));
    }

    public static function link($user, $object) {
        if(\is_object($object)) {
            if(self::linkExists($user, $object)) {
                return true;
            }
            
            $type = self::_getRealType($object);

            $link = self::create(array('type' => $type, 'user_id' => $user->id, 'object_id' => $object->id));

            $link->save();

            return true;
        }

        return false;
    }

    public static function unlink($user, $object) {
        if(\is_object($object)) {
            if(!self::linkExists($user, $object)) {
                return false;
            }

            $type = self::_getRealType($object);

            $link = self::find('first', array('conditions' => array('type = ? AND user_id = ? AND object_id = ?', $type, $user->id, $object->id)));

            $link->delete();

            return true;
        }
    }

    public static function getLinks($user, $type, $conditions = array(), $options = array()) {
        $dbType = strtoupper($type);
        $class = "app\\models\\" . $type;
        $table = strtolower($type) . "s";

        if(isset($conditions[0])) {
            $conditions[0] = $conditions[0] . ' AND l.type = ? AND user_id = ?';
        } else {
            $conditions[0] = 'l.type = ? AND user_id = ?';
        }
        $conditions[] = $dbType;
        $conditions[] = (\is_numeric($user)) ? $user : $user->id;
        
        return $class::find('all', array('conditions' => $conditions, 'joins' => 'LEFT JOIN user_links l ON (' . $table . '.id = l.object_id)') + $options);
    }


    public static function linkExists($user, $object) {
        if(is_object($object)) {
            $type = self::_getRealType($object);

            return (self::count(array('conditions' => array('type = ? AND object_id = ? AND user_id = ?', $type, $object->id, $user->id))) != false) ? true : false;
        }
    }
}