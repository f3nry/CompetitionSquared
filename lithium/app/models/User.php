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

use lithium\storage\Session;

/**
 * User model. To represent a simple user.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class User extends \li3_activerecord\extensions\data\Model {
    
    /**
     * Checks a username and password against the database to determine if they are valid.
     *
     * @param string $username The username of the user.
     * @param string $password A plain-text password, that is sha1'ed before being sent to the database.
     * @return boolean true on success, false on failure.
     */
    public static function check($username, $password, $returnPermissions = false, $table = null) {
        if($table != null) {
            self::$table_name = $table;
        }

        $user = self::find('count',
                    array(
                            'conditions' => array(
                                'username' => $username,
                                'password' => sha1($password)
                            )
                        )
                    );

        if($user) {
            if($returnPermissions) {
                return array($user->id, $user->account_type);
            }

            return true;
        } else {
            if($returnPermissions) {
                return array(false, false);
            }
            
            return false;
        }
    }

    public static function get($permissions, $user_id = false) {
        if($permissions == "ADMIN") {
            return User::all();
        } else if($permissions == "ACCT_CREATOR") {
            return User::find_all_by_created_by($user_id);
        } else {
            return false;
        }
    }

    public function getSchoolObj() {
        return School::find($this->school_limit);
    }

    /**
     * Updates the given user's password with a new password.
     *
     * @param string $username The username of the user to update.
     * @param string $newPassword The plain-text new password. Sha1'ed before going into the database.
     */
    public static function updatePassword($username, $newPassword) {
        $user = User::find_by_username($username);

        $user->password = sha1($newPassword);

        $user->save();
    }

    /**
     *
     */
    public static function getSchool($id) {
        if($id == 0) {
            return -1;
        }
        
        $user = User::find($id);

        if($user->school_limit == "" || $user->school_limit == null) {
            return null;
        } else {
            return $user->school_limit;
        }
    }
}