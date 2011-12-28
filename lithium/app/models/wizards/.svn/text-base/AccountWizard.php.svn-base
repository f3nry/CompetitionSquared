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

namespace app\models\wizards;

use app\models\Team;
use app\models\User;
use app\models\UserLink;

use lithium\storage\Session;

/**
 * ScoreProcessor
 *
 * Processes and calculates all scores and places for everyone in the system.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AccountWizard extends \lithium\core\Object {

    public $_teams;
    public $_users;

    public function _init() {
        parent::_init();

        if($this->_config['school'] == '') {
            $this->_teams = Team::get();
        } else {
            $this->_teams = Team::get(
                            array('conditions' =>
                                array(
                                    'school LIKE \'%' . $this->_config['school'] . '%\'',
                                )
                            )
                    );
        }
    }

    public function run() {
        foreach ($this->_teams as $team) {
            $this->_users[] = User::create(
                    array(
                        'username' => $this->generateUsername($team),
                        'password' => $this->generatePassword(),
                        'account_type' => 'PARENT',
                        'created_by' => Session::read('id')
                        )
                    );
        }

        $filename = "users_" . str_replace(" ", "_", $this->_config["school"]);

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename . '.csv');
        header('Pragma: no-cache');

        echo "\"Username\",\"Password\",\"Student\"\r\n";

        $i = 0;
        foreach($this->_users as $user) {
            echo $user->username . "," . $user->password . ",\"" . $this->_teams[$i]->getName() . "\"\r\n";
            
            $user->password = sha1($user->password);
            $user->save();
            
            UserLink::link($user, $this->_teams[$i++]);
        }
    }

    protected function generateUsername($team) {
        $username = strtolower($team->last_name);

        $i = 1;
        while (!$this->checkUsername($username)) {
            $username = strtolow($team->last_name . $i);
        }

        return $username;
    }

    protected function generatePassword($length=7, $level=2) {
        $validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
        $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";

        $password = "";
        $counter = 0;

        while ($counter < $length) {
            $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level]) - 1), 1);

            // All character must be different
            if (!strstr($password, $actChar)) {
                $password .= $actChar;
                $counter++;
            }
        }

        return $password;
    }

    private function checkUsername($username) {
        if(count($this->_users) > 0) {
            foreach ($this->_users as $user) {
                if ($user->username == $username) {
                    return false;
                }
            }
        }

        $count = User::count(array('conditions' => array('username = ?', $username)));

        if ($count > 0) {
            return false;
        }

        return true;
    }

}