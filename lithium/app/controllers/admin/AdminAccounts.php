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

namespace app\controllers\admin;

use app\models\User;
use app\models\Team;
use app\models\UserLink;
use app\models\School;

use lithium\storage\Session;

/**
 * Controller to allow admins to create accounts for parents, and accounts for school administrators.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminAccounts extends \app\controllers\AdminController {

    /**
     * Custom _requireAuth function with the permission required for this controller.
     */
    protected function _requireAuth() {
        parent::_requireAuth("admin/accounts");
    }

    /**
     * Show the current accounts, and provide links to edit and delete them.
     */
    public function index() {
        $this->_requireAuth();
        
        return array(
                'users' => User::get(Session::read('permissions'), Session::read('id')),
                'schools' => School::all()
            );
    }

    /**
     * Create a new user with the correct permissions.
     */
    public function add() {
        $this->_requireAuth();

        if(User::find_by_username($this->request->data["username"])) {
            die('That username is already taken. Please press the \'Back\' button on your web browser to try again.');
        }

        if(Session::read('permissions') != "ADMIN" && $this->request->data["account_type"] == "ADMIN") {
            die("You do not have permissions to add administrators");
        }

        $this->request->data["password"] = sha1($this->request->data["password"]);

        if(!School::count($this->request->data['school_limit'])) {
            $this->request->data['school_limit'] = null;
        }

        $user = User::create($this->request->data + array("created_by" => Session::read('id')));
        $user->save();
        
        $this->redirect($this->accountName .'/admin/accounts');
    }

    /**
     * Edit an existing user, and if the user is a parent, provide tools to add students to the parent.
     */
    public function edit() {
        $this->_requireAuth();
        
        $user = User::find($this->request->id);

        if($this->request->data) {
            if($this->request->data["account_type"] != $user->account_type) {
                $this->set(array('errorMsg' => 'You cannot change your own account type.'));
            } else {
                $user->username = $this->request->data["username"];

                if($this->request->data["password"] != "") {
                    $user->password = sha1($this->request->data["password"]);
                }

                if(!School::count($this->request->data['school_limit'])) {
                    $this->request->data['school_limit'] = null;
                }

                $user->account_type = $this->request->data["account_type"];
                $user->school_limit = $this->request->data["school_limit"];

                $user->save();

                $this->redirect($this->accountName ."/admin/accounts");
                return;
            }
        }

        if($user->account_type == "PARENT") {
            $this->set(
                        array(
                            'teams' => Team::get(null),
                            'currentTeams' => UserLink::getLinks($user, "Team")
                    )
                );
        }
        
        return array('userObj' => $user, 'schools' => School::all());
    }

    /**
     * Delete an existing account.
     */
    public function delete() {
        $this->_requireAuth();

        $user = User::find($this->request->id);

        if($user->id == Session::read('id') && Session::read('permissions') != "ADMIN" && $user->created_by != Session::read('id')) {
            die("You cannot delete this user.");
        }

        $user->delete();

        $this->redirect($this->accountName ."/admin/accounts");
    }

    /**
     * Remove a student/team from a parent.
     */
    public function removeTeam() {
        $this->_requireAuth();

        $user = User::find($this->request->id);

        if($user->id == Session::read('id') && Session::read('permissions') != "ADMIN" && $user->created_by != Session::read('id')) {
            die("You cannot remove teams from this user.");
        }

        $team = Team::find($this->request->team_id);

        if(!$team) {
            die("Could not find that team.");
        } else {
            UserLink::unlink($user, $team);

            $this->redirect($this->accountName ."admin/accounts/edit/" . $user->id);
        }
    }

    /**
     * Add a student/team to a parent.
     */
    public function addTeam() {
        $this->_requireAuth();

        $user = User::find($this->request->id);

        if($user->id == Session::read('id') && Session::read('permissions') != "ADMIN" && $user->created_by != Session::read('id')) {
            die("You cannot add any teams to this account.");
        }

        $team = Team::find($this->request->data["team"]);

        if(!$team) {
            die("Could not find that team.");
        } else {
            UserLink::link($user, $team);

            $this->redirect($this->accountName ."admin/accounts/edit/" . $user->id);
        }
    }
}