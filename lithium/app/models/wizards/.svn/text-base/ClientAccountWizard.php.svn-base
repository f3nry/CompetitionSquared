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

use app\models\Account;
use app\models\User;

use lithium\data\Connections;

/**
 * Provides a wizard to create new account databases.
 *
 * @author Paul <paulhenry@mphwebsystems.com
 */
class ClientAccountWizard extends \lithium\core\Object {
    private $_accountName;

    /**
     * Loads the account name from the config
     */
    public function _init() {
        $this->_accountName = $this->_config['accountName'];
        $this->_defaultUsername = $this->_config['defaultUsername'];
        $this->_defaultPassword = $this->_config['defaultPassword'];
    }

    /**
     * Runs the wizard. Will create a new account, account database, and insert a default user.
     */
    public function run() {
        $id = Account::add($this->_accountName);

        $connection = \ActiveRecord\ConnectionManager::get_connection();

        $databaseName = "competitionsquared_" . $id;
        $connection->query("CREATE DATABASE " . $databaseName);
        $connection->query("USE " . $databaseName);

        $sql = \file_get_contents(LITHIUM_APP_PATH . "/resources/sql/newAccount.sql");

        $querys = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/", $sql);

        foreach($querys as $query) {
            if($query != "") {
                try {
                    $connection->query($query);
                } catch(Exception $e) {

                }
            }
        }

        User::connection()->query("USE " . $databaseName);

        $user = User::create(array('username' => $this->_defaultUsername, 'password' => sha1($this->_defaultPassword), 'account_type' => 'ADMIN'));

        $user->save();
    }
}
?>
