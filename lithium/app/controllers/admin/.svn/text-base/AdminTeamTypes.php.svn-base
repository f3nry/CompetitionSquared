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

use app\models\TeamTypes;
use app\models\ScoreCard;

/**
 * Manage team types/categories/events.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminTeamTypes extends \app\controllers\AdminController {

    /**
     * Custom init for permissions.
     */
    public function _init() {
        parent::_init();

        $this->_requireAuth("admin/teamtypes");
    }

    /**
     * Load all team types, and provide form for creating a new one.
     */
    public function index() {
        TeamTypes::load();

        $this->set(array('types' => TeamTypes::$_types, 'scorecards' => ScoreCard::all()));
    }

    /**
     * Add a new team type.
     */
    public function add() {
        if($this->request->data) {
            if($this->request->data["hidden"] == "on") {
                $hidden = true;
            } else {
                $hidden = false;
            }

            TeamTypes::add($this->request->data["nice_name"], $this->request->data["score_card"], $hidden);
        }

        $this->redirect($this->accountName . '/admin/teams/types');
    }

    /**
     * Edit an existing type.
     */
    public function edit() {
        TeamTypes::load();
        
        if($this->request->data) {
            $type = TeamTypes::find($this->request->id);

            if($this->request->data["hidden"] == "on") {
                $hidden = true;
            } else {
                $hidden = false;
            }

            $type->update($this->request->data["nice_name"], $this->request->data["score_card"], $hidden);
            
            $this->redirect($this->accountName . '/admin/teams/types');
        } else {
            $this->set(array('type' => TeamTypes::getType($this->request->id), 'scorecards' => ScoreCard::find('all')));
        }
    }

    /**
     * Delete an existing team type.
     */
    public function delete() {
        TeamTypes::deleteType($this->request->id);

        $this->redirect($this->accountName . '/admin/teams/types');
    }
}
?>
