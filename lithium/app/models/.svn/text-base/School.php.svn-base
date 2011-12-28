<?php

namespace app\models;

/**
 * School Model
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class School extends \li3_activerecord\extensions\data\Model {
    public function getStudentCount() {
        return (integer)Team::count(array('conditions' => array('school_id = ?', $this->id)));
    }

    public function calculateUILScore($teams) {
        foreach($teams as $team) {
            if($team->school_id == $this->id && $team->total != 0) {
                switch($team->place) {
                    case 1:
                        $this->score += 15;
                        break;
                    case 2:
                        $this->score += 12;
                        break;
                    case 3:
                        $this->score += 10;
                        break;
                    case 4:
                        $this->score += 8;
                        break;
                    case 5:
                        $this->score += 6;
                        break;
                    case 6:
                        $this->score += 4;
                        break;
                    default:
                        $this->score += 0;
                        break;
                }
            }
        }
    }

    public static function placeSchools($schools) {
        School::sort($schools);

        $currentSchool = null;
        $place = 1;
        $lastPlace = 0;

        for($i = 0; $i < count($schools); $i++) {
            if($currentSchool != null && $schools[$i]->score == $currentSchool->score) {
                $schools[$i]->place = $lastPlace;
            } else {
                $schools[$i]->place = $place;
                $lastPlace = $place;
                $place += 1;
                $currentSchool = $schools[$i];
            }
        }
    }

    public static function sort(&$schools, $field = 'score') {
        $flag = true;
        for($i = 0; $i < count($schools) && $flag; $i++) {
            $flag = false;

            for($j = 0; $j < (count($schools) - 1); $j++) {
                if($schools[$j + 1]->$field > $schools[$j]->$field) {
                    $temp = $schools[$j];
                    $schools[$j] = $schools[$j + 1];
                    $schools[$j + 1] = $temp;
                    $flag = true;
                }
            }
        }
    }

    public static function calculateUILScores($teams) {
        $schools = School::all();
        $events = TeamTypes::all();

        foreach($schools as $school) {
            $school->score = 0;
        }

        foreach($events as $event) {
            $eventsTeams = Team::filterTeamArrayByEvent($teams, $event);
            foreach($schools as $school) {
                $schoolsTeams = Team::filterTeamArrayBySchool($eventsTeams, $school);

                $school->calculateUILScore($schoolsTeams);
            }
        }

        School::placeSchools($schools);

        foreach($schools as $school) {
            $school->save();
        }
    }
}