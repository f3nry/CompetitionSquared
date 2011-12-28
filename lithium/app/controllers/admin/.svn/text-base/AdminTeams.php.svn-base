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

use app\models\Team;
use app\models\TeamTypes;
use app\models\School;

/**
 * Controller to provide actions to manage students/teams.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminTeams extends \app\controllers\AdminController {

    /**
     * Custom auth for making sure only admins with access to admin/students can access this controller.
     */
    protected function _requireAuth() {
        parent::_requireAuth("admin/students");
    }

    /**
     * Show the current teams, and provide a form to add a new student/team.
     */
    public function index() {
        $this->_requireAuth();

        if($this->request->selectedType != "") {
            $conditions = array('conditions' => array('type = ?', $this->request->selectedType));
            $this->set(array('selectedType' => $this->request->selectedType));
        } else {
            $conditions = null;
        }

        $this->set(array('types' => TeamTypes::load(true)));
        $this->set(array('teams' => Team::get($conditions)));
        $this->set(array('schools' => School::all()));
        $this->set(array('jquery' => true));
    }

    /**
     * Add a new team/student from the form on the index page.
     */
    public function add() {
        $this->_requireAuth();

        if($this->request->data) {
            Team::add($this->request->data);

            $this->redirect($this->accountName .'/admin/teams');
        }
    }

    /**
     * Edit an existing team/student.
     */
    public function edit() {
        $this->_requireAuth();

        $team = Team::find($this->request->id);

        if($this->request->data) {
            $team->first_name = $this->request->data["first_name"];
            $team->last_name = $this->request->data["last_name"];
            $team->type = $this->request->data["type"];
            $team->school_id = $this->request->data["school"];

            $team->save();

            $this->redirect($this->accountName .'/admin/teams');
        } else {       
            return array('team' => $team, 'types' => TeamTypes::load(true), 'schools' => School::all());
        }
    }

    /**
     * Delete an existing team/student.
     */
    public function delete() {
        $this->_requireAuth();

        $team = Team::find($this->request->id);

        $team->delete();

        $this->redirect($this->accountName .'/admin/teams');
    }


    public function getTeams() {
        if($this->request->selectedType == "") {
            $conditions = false;
        } else {
            $conditions = array('conditions' => array('type = ?', $this->request->selectedType));
        }

        $this->_render['layout'] = false;

        TeamTypes::load();

        return array(
                'teams' => Team::get($conditions),
            );
    }
}