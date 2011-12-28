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

use lithium\data\Connections;

/**
 * Description of Account
 *
 * @author Paul <paulhenry@mphwebsystems.com
 */
class Account extends \li3_activerecord\extensions\data\Model {
    static $account;

    public static function checkName($accountName) {
        $account =  self::first(array('conditions' => array('accountname = ?', $accountName)));

        if($account) {
            self::$account = $account;

            return true;
        } else {
            return false;
        }
    }

    public static function add($accountName) {
        $account = self::create(array("accountname" => $accountName, "status" => "ACTIVE"));

        $account->save();

        return $account->insert_id();
    }

    public static function go($accountName) {
        if(self::$account) {
            $account = self::$account;
        } else {
            $account = self::find('first', array('conditions' => array('accountname = ?', $accountName)));
        }

        if($account) {
            $databaseName = "competitionsquared_" . $account->id;

            try {
                self::connection()->query("USE " . $databaseName);
            } catch(Exception $e) {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    public static function reset() {
        return self::connection()->query("USE competitionsquared_admin");
    }

    public static function doDelete($id) {
        $account = self::find($id);

        if($account) {
            $databaseName = "competitionsquared_" . $account->id;

            try {
                self::connection()->query("DROP DATABASE " . $databaseName);
            } catch (Exception $e) {
                return false;
            }

            return $account->delete();
        }
    }
}
?>
