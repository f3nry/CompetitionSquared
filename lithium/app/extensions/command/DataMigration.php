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

namespace app\extensions\command;

use app\models\Account;

/**
 * Competition Squared Multi-Account Migration tool
 *
 * Attaches to the li3 command, and aids in managing database revisions of multiple account databases.
 *
 * @author Paul <paulhenry@mphwebsystems.com>
 */
class DataMigration extends \lithium\console\Command {

    /**
     * @var integer Required if $queryfile isn't set, used to specify the revision to update accounts too.
     */
    public $revision;

    /**
     * @var string Optional, used to specify a specific account name.
     */
    public $account;

    /**
     * @var string Optional, used to specifiy a special SQL file
     */
    public $queryfile;

    /**
     * @var array The array of SQL queries
     */
    private $_revision_querys;

    /**
     * Get the path for the SQL file, based on the parameters.
     *
     * @return string The file path
     */
    private function getSQLFile() {
        //Load the correct file path for the query.
        if(!$this->queryfile) {
            $sql_file = LITHIUM_APP_PATH . "/resources/sql/revisions/" . $this->revision . ".sql";
        } else {
            $sql_file = LITHIUM_APP_PATH . "/resources/sql/revisions/" . $this->queryfile;
        }

        return $sql_file;
    }

    /**
     * Load, and split the queries in a file.
     *
     * @param $sql_file The full path to the SQL file
     * @return array The array of queries
     */
    private function getQueries($sql_file) {
        return preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/",
                \file_get_contents($sql_file));
    }

    /**
     * Load all accounts, using the parameters specified on the command line.
     *
     * @return Array of Accounts
     */
    private function getAccounts() {
        //Build the conditions for the query
        if($this->account) {
            if($this->queryfile) {
                $conditions = array("accountname = ?", $this->account);
            } else {
                $conditions = array("accountname = ? AND revision = (? - 1)", $this->account, $this->revision);
            }
        } else {
            if($this->queryfile) {
                $conditions = array();
            } else {
                $conditions = array("revision = (? - 1)", $this->revision);
            }
        }

        Account::reset();

        //Get the accounts.
        return Account::all(array("conditions" => $conditions));
    }

    /**
     * Function to init the parameters for the migration.
     */
    public function _init() {
        parent::_init();
        
        //Do we need a revision number?
        if(!$this->revision && !$this->queryfile) {
            $this->out("You must specifiy a revision, by using --revision=[revision].");
            exit;
        }

        $sql_file = $this->getSQLFile();

        //Does our query file exist?
        if(!\file_exists($sql_file)) {
            if($this->queryfile) {
                $this->out("Can't open SQL file " . $sql_file);
                exit;
            } else {
                $this->out("Can't open revision " . $this->revision . "'s SQL file.");
                exit;
            }
        }

        //Split the queries.
        $this->_revision_querys = $this->getQueries($sql_file);

        $this->accounts = $this->getAccounts();

        //Any accounts?
        if(!$this->accounts) {
            $this->out("No accounts to process.");
            exit;
        }
    }

    /**
     * Run the actual queries on all accounts.
     *
     * @return void
     */
    public function run() {
        foreach($this->accounts as $account) {
            if($this->migrateAccount($account) > 0) {
                return $this->out("Failed to upgrade account '" . $account->accountname . "'.");
            } else {
                $account->revision += 1;
                Account::reset();
                $account->save();
            }
        }

        return $this->out("Successfully upgraded " . count($accounts) . " accounts to revision " . $this->revision . ".");
    }

    /**
     * Run the queries on the specified account.
     *
     * @param Account $account An Account object representing the account to process
     * @return int The number of failed queries
     */
    private function migrateAccount($account) {
        $failedQuerys = 0;

        //Load the account
        Account::go($account->accountname);

        //Loop through the queries
        foreach($this->_revision_querys as $query) {
            //Try to execute the query
            try {
                Account::connection()->query($query);
            } catch(\ActiveRecord\DatabaseException $e) {
                $this->out("Failed to execute query." . $this->nl() . "Reason: " . $e->getMessage());
                $failedQuerys++;
            }
        }

        return $failedQuerys;
    }
}
