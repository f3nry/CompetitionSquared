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
 * TeamTypes
 *
 * A way to categorize teams. Could use it to seperate events, or contests in a competition.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class TeamTypes extends \li3_activerecord\extensions\data\Model {
    public static $_types;

    private static $_isloaded;

    public static function isloaded() {
        return self::$_isloaded;
    }

    public static function load($sort = true) {
        if(self::$_isloaded) {
            return self::$_types;
        }
        
        $types = ($sort) ? self::find('all', array('order' => 'nice_name')) : self::all();

        self::$_types = $types;

        self::$_isloaded = true;

        return self::$_types;
    }

    public static function getType($id) {
        foreach(self::$_types as $type) {
            if($type->id == $id) {
                return $type;
            }
        }
    }

    public static function add($typeText, $scoreCard, $hidden) {
        $type = self::create(array('score_card' => $scoreCard, 'nice_name' => $typeText, 'hidden' => $hidden));
        $type->save();

        self::$_types[] = $type;
    }

    public function update($text, $scorecard, $hidden) {
        $this->nice_name = $text;
        $this->score_card = $scorecard;
        $this->hidden = $hidden;

        $this->save();
    }

    public static function getName($searchType) {
        foreach(self::$_types as $type) {
            if($type->id == $searchType) {
                return $type->nice_name;
            }
        }
    }

    public static function deleteType($id) {
        $type = self::find($id);

        return $type->delete();
    }
}
