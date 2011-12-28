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

namespace app\controllers;

use app\models\Team;
use app\models\TeamTypes;
use app\models\Score;
use app\models\ScoreCard;

use app\models\AppConfig;

use app\models\User;
use app\models\UserLink;

use lithium\storage\Session;

/**
 * ScoreController
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class TeamsController extends AppController {
    public function index() {
        $this->_requireAuth();

        $type = TeamTypes::find($this->request->team_type);

        if($type->hidden == true &&
                (Session::read('permissions') != 'ADMIN' && Session::read('permissions') != 'SUPERADMIN')) {
            $this->redirect('/' . $this->accountName);
        }

        $perPage = 15;
        $count = Team::count(array('conditions' => array('type = ?', $this->request->team_type)));
        $page = (isset($this->request->page)) ? $this->request->page : 1;
        $recordStart = $perPage * ($page - 1);

        if($page > 1) {
            $this->set(array("prevPage" => $page - 1));
        } else {
            $this->set(array("prevPage" => false));
        }

        if($count > ($recordStart + $perPage)) {
            $this->set(array("nextPage" => $page + 1));
        } else {
            $this->set(array("nextPage" => false));
        }

        $this->set(array("page" => $page));

        $totalPages = ceil($count / $perPage);
        $page = 1;
        $pages = array();

        while($page <= $totalPages) {
            $pages[] = $page;
            $page++;
        }

        if(AppConfig::get('competition_status') == "ALLOW_ALL_VIEW" || Session::read('permissions') == 'ADMIN' || Session::read('permissions') == 'ACCT_CREATOR') {
            $this->set(array("hidePlaces" => false));

            if(Session::read('permissions') != 'ADMIN' && Session::read('permissions') != 'ACCT_CREATOR' && Session::read('permissions') != 'SUPERADMIN') {
                $teams = UserLink::getLinks(Session::read('id'), 'Team', array('teams.type = ?', $this->request->team_type), array('order' => 'place', 'limit' => $perPage, 'offset' => $recordStart));
            } else {
                 if(Session::read('permissions') == 'ACCT_CREATOR' && User::getSchool(Session::read('id')) != -1) {
                    $teams = Team::get(array('conditions' => array('type = ? AND teams.school_id = ?', $this->request->team_type, User::getSchool(Session::read('id'))), 'order' => 'place', 'limit' => $perPage, 'offset' => $recordStart));
                } else {
                    $teams = Team::get(array('conditions' => array('type = ?', $this->request->team_type), 'order' => 'place', 'limit' => $perPage, 'offset' => $recordStart));
                }
            }
        } else {

            $this->set(array("hidePlaces" => true));
            
            if((Session::read('permissions') != 'ADMIN' && Session::read('permissions') != 'SUPERADMIN') && Session::read('permissions') != 'ACCT_CREATOR') {
                $teams = UserLink::getLinks(Session::read('id'), 'Team', array('teams.type = ? AND teams.school_id = ?', $this->request->team_type, User::getSchool(Session::read('id'))), array('order' => 'place', 'limit' => $perPage, 'offset' => $recordStart));
            } else {
                if(Session::read('permissions') == 'ACCT_CREATOR') {
                    $teams = Team::get(array('conditions' => array('type = ? AND teams.school_id = ?', $this->request->team_type, User::getSchool(Session::read('id'))), 'order' => 'place', 'limit' => $perPage, 'offset' => $recordStart));
                } else {
                    $teams = Team::get(array('conditions' => array('type = ?', $this->request->team_type), 'order' => 'place', 'limit' => $perPage, 'offset' => $recordStart));
                }
            }
        }

        $this->set(array("pages" => $pages, "team_type" => TeamTypes::getName($this->request->team_type)));

        $this->set(array('teams' => $teams, 'refresh' => true));

        if(@$this->request->data["content_only"]) {
            $this->_render['layout'] = false;
            $this->set(array("content_only" => true));
        }
    }

    public function view() {
        $this->_requireAuth();

        $scores = Score::find('all', array('conditions' => array('team_id = ?', $this->request->id), 'order' => 'total ASC'));

        $this->set(array('scores' => $scores, 'team' => Team::find('first', array('conditions' => array('id = ?', $this->request->id)))));
    }

    public function score() {
        $this->_requireAuth();
        
        TeamTypes::load();
        $score = Score::find('first', array('conditions' => array('id = ?', $this->request->score_id)));
        $scorecard = ScoreCard::find($score->score_card_id);

        $this->set(array('score' => $score, 'scorecard' => $scorecard));
    }

    public function slideshow() {
        $this->_requireAuth();
        
        TeamTypes::load(true);
        $this->set(array('jquery' => true, 'types' => TeamTypes::$_types, 'admin' => true));
    }
}