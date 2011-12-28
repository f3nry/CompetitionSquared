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
use app\models\Score;
use app\models\ScoreCard;
use app\models\TeamTypes;
use app\models\ScoreDebugLog;

use app\models\ScoreProcessor;

use lithium\storage\Session;

/**
 * Controller to allow CRUD of scores.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminScores extends \app\controllers\AdminController {
    /**
     * Override to assign a default permission.
     */
    protected function  _requireAuth() {
        parent::_requireAuth("admin/score");
    }
    
    /**
     * View all scores
     */
    public function index() {
        $this->_requireAuth();

        if($this->request->selectedType != '') {
            $type = $this->request->selectedType;
        } else if(Session::read('filterEventType') != '') {
            $type = Session::read('filterEventType');
        } else {
            $type = 'all';
        }

        if(@$type != 'all') {
            $join = "LEFT JOIN teams t ON(scores.team_id = t.id)";
            $join .= " LEFT JOIN schools s ON (t.school_id = s.id)";
            $conditions = array("t.type = ?", @$type);

            $this->set(array("selectedType" => @$type));

            Session::write('filterEventType', @$type);
        } else if(@$type == "all") {
            $join = "LEFT JOIN teams t ON(scores.team_id = t.id)";
            $join .= " LEFT JOIN schools s ON (t.school_id = s.id)";
            $conditions = array();

            $this->set(array("selectedType" => @$type));

            Session::write('filterEventType', @$type);
        }
        
        return array('scores' => Score::all(
                            array(
                                    'select' => '`scores`.*, `t`.type as team_type,
                                                 `t`.first_name as team_first_name, `t`.last_name as team_last_name,
                                                 `s`.name as school_name',
                                    'conditions' => $conditions,
                                    'joins' => $join,
                                    'order' => 'total DESC'
                                )
                            ),

                    'jquery' => true
                );
    }

    /**
     * Add new score
     */
    public function add() {
        $this->_requireAuth();

        if($this->request->data) {
            if(@$this->request->data["new"] == 1) {
                Session::write('scoreLastSelectedType', $this->request->data["type"]);
                
                $this->set(array(
                            'teams' => Team::get(array("conditions" => array("type = ?", $this->request->data["type"]), "order" => "last_name ASC")),
                            'scorecard' => ScoreCard::get($this->request->data["type"])
                        )
                    );
            } else {
                Score::add($this->request->data);

                $this->redirect($this->accountName .'/admin/scores/process');
            }
        } else {
            $this->set(array('teams' => Team::get(null)));
        }
    }

    /**
     * Edit existing score
     */
    public function edit() {
        $this->_requireAuth();

        if($this->request->data) {
            $score = Score::find($this->request->id);

            $score->update($this->request->data);

            if(\app\models\AppConfig::get("score_type") == "noscoring") {
                $team = Team::find($score->team_id);

                $team->updatePlace($this->request->data["place"]);
            }

            $this->redirect($this->accountName .'/admin/scores/process');
        } else {
            $teams = Team::get(null);
            $score = Score::find($this->request->id);
            $scorecard = ScoreCard::find($score->score_card_id);
            TeamTypes::load(true);

            $this->set(array(
                         'score' => $score,
                         'teams' => $teams,
                         'scorecard' => $scorecard,
                         'team_types' => TeamTypes::$_types,
                         'jquery' => true
                        )
                    );
        }
    }

    /**
     * Delete existing score
     */
    public function delete() {
        $this->_requireAuth();

        $score = Score::find($this->request->id);

        $score->delete();

        $this->redirect($this->accountName ."/admin/scores/process");
    }

    /**
     * Process all scores
     */
    public function process() {
        $this->_requireAuth();
        
        $this->_render['layout'] = false;

        $processor = new ScoreProcessor(array('verbose' => true));

        $processor->run();

        $this->redirect($this->accountName ."/admin/scores");
    }

    /**
     * View score debug log.
     */
    public function log() {
        return array(
            'entries' => ScoreDebugLog::all(array('order' => '`datetime` DESC', 'limit' => '15'))
        );
    }

    public function logEntry() {
        return array(
            'entry' => ScoreDebugLog::find($this->request->id)
        );
    }
}
