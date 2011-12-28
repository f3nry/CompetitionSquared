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

use app\models\AppConfig;
use app\models\ScoreCard;

/**
 * Controller to manage score cards in the competition.
 *
 * TODO: Add editing option to score cards.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminScoreCards extends \app\controllers\AdminController {
    /**
     * Custom init.
     */
    public function _init() {
        parent::_init();

        $this->_requireAuth("admin/scorecard");
    }

    /**
     * Show and provide links to existing scorecards.
     */
    public function index() {
        $this->set(array('jquery' => true, 'scorecards' => ScoreCard::all()));
    }

    /**
     * Load editor for creating/adding a new scorecard.
     */
    public function add() {
        if($this->request->data) {
            ScoreCard::add($this->request->data);

            $this->redirect($this->accountName . "/admin/scorecards");
        } else {
            $this->_render['template'] = 'edit';
            $this->set(array('jquery' => true));
        }
    }

    /**
     * Edit an existing scorecard. Not yet implemented.
     */
    public function edit() {
        if($this->request->data) {
            $scorecard = ScoreCard::find($this->request->id);

            $scorecard->update($this->request->data);

            $this->redirect($this->accountName . "/admin/scorecards");
        } else {
            return array('jquery' => true, 'scorecard' => ScoreCard::find($this->request->id));
        }
    }

    /**
     * Delete an existing scorecard.
     */
    public function delete() {
        $scorecard = ScoreCard::find($this->request->id);

        if($scorecard->locked == true) {
            die("Scorecard is locked.");
        } else {
            $scorecard->delete();

            $this->redirect($this->accountName . "/admin/scorecards");
        }
    }
}