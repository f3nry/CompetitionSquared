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

/**
 * Team Model
 *
 * Represents the teams table.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class Team extends \li3_activerecord\extensions\data\Model {
    
    protected static $has_many = array(array('scores', 'class_name' => '\app\models\Score'));

    protected static $belongs_to = array(array('school', 'class_name' => '\app\models\School'));

    /**
     * Gets the total of the two top scores for this team.
     *
     * @return int The total of the two top scores for this team.
     */
    public function getTotalTopTwoScores($hide_non_displayed = false) {

        if(count($this->scores) == 0) {
            return 0;
        } else if(count($this->scores) == 1) {
            if($hide_non_displayed) {
                return $this->scores[0]->displayed_total;
            } else {
                return $this->scores[0]->total;
            }
        } else if(count($this->scores) == 2) {
            if($hide_non_displayed) {
                return $this->scores[0]->displayed_total + $this->scores[1]->displayed_total;
            } else {
                return $this->scores[0]->total + $this->scores[1]->total;
            }
        } else {
            $total = 0;
            
            for($i = 0; $i < 2; $i++) {
                list($maxScore, $index) = Score::findMax($this->scores);

                if($hide_non_displayed) {
                    $total += $maxScore->displayed_total;
                } else {
                    $total += $maxScore->total;
                }
                
                $this->scores[$index]->setCalculated(true);
                $this->scores[$index]->setIgnore(true);
            }

            return $total;
        }

        return 0;
    }

    public function getLastScore() {
        return Score::findMin($this->scores);
    }

    /**
     * Get the type for the current team.
     *
     * @return string The name of the current type.
     */
    public function getType() {
        return TeamTypes::getName($this->type);
    }


    public function getName() {
        return $this->last_name . ", " . $this->first_name;
    }

    public function updatePlace($place) {
        $this->place = $place;

        $this->save();
    }

        /**
     * Add a new Team.
     *
     * @param array $data An array of data submitted through a form
     */
    public static function add($data) {
        $team = self::create($data);

        $team->save();
    }

    /**
     * Get a team, using the specified conditions.
     */
    public static function get($conditions = 'all') {
        TeamTypes::load();

        if(!isset($conditions['order'])) {
            $conditions['order'] = 'last_name';
        }
        
        if(is_array($conditions)) {
            return Team::find('all', $conditions + array('select' => '`teams`.*, `schools`.name as school_name', 'joins' => array('school')));
        } else {
            return Team::find('all', array('order' => 'last_name', 'select' => '`teams`.*, `schools`.name as school_name', 'joins' => array('school')));
        }
    }

    /**
     * Gets all teams for a specified type, or all teams seperated by type.
     *
     * @param string $type Optional: The type to look for.
     * @return array Array of teams, seperated by type, unless $type is specified.
     */
    public static function getByType($type = false) {
        TeamTypes::load();

        $teams = array();

        if($type) {
            $teams = Team::find('all', array('conditions' => array('type = ?', $type)));
        } else {
            foreach(TeamTypes::$_types as $type) {
                $teams[$type->id] = Team::find('all', array('conditions' => array('type = ?', $type->id)));
            }
        }

        return $teams;
    }

    public static function getSchools() {
        $query = Team::query("SELECT school FROM teams GROUP BY school");

        $query->execute();

        return array_values($query->fetchAll());
    }

    public function hasScore() {
        if($this->place == -1) {
            return false;
        }

        return Score::count(array('conditions' => array('team_id = ?', $this->id)));
    }

    public static function filterTeamArrayBySchool($teams, $school) {
        $schoolsTeams = array();

        foreach($teams as $team) {
            if($team->school_id == $school->id) {
                $schoolsTeams[] = $team;
            }
        }

        return $schoolsTeams;
    }

    public static function filterTeamArrayByEvent($teams, $event) {
        $eventsTeams = array();

        foreach($teams as $team) {
            if($team->type == $event->id) {
                $eventsTeams[] = $team;
            }
        }

        return $eventsTeams;
    }
}