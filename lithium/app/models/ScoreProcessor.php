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
 * ScoreProcessor
 *
 * Processes and calculates all scores and places for everyone in the system.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class ScoreProcessor extends \lithium\core\Object {

    /**
     * Simple holder for the teams being processed.
     *
     * @var array Array of Team objects being processed.
     */
    private $_teams;

    private $_output;

    private $_starttime;

    private $_endtime;

    /**
     * Load all teams.
     */
    public function _init() {
        $this->say("Loading...");

        $this->_starttime = microtime();

        $this->_teams = Team::getByType();

        $this->say("Loaded!<br/>");
    }

    /**
     * Run the processing.
     */
    public function run() {
        //Loop through all teams
        foreach($this->_teams as $type => $teams) {
            $this->say("Processing all " . TeamTypes::getName($type) . " teams...<br/>");

            $this->calculateScores($teams); //Calculate their scores

            if(AppConfig::get('score_type') != 'noscoring') {
                $this->place($teams); //Place them initially, we'll process ties later.
            }

            //Print all teams, and then save them.
            foreach($teams as $team) {
                $this->say("Team: " . $team->name . " Place:" . $team->place . "<br/>");
                $team->save();
            }
        }

        School::calculateUILScores(Team::all());

        $this->_endtime = microtime();

        $this->say("<br/><br/>Calculation took " . ($this->_endtime - $this->_starttime) * 1000 . " milli-seconds to run.<br/>");

        $this->saveLog();
    }

    private function saveLog() {
        Team::query("INSERT INTO score_debug_log VALUES (0, now(), :output)", array("output" => $this->_output));
    }

    /**
     * Calculates all scores for $teams.
     *
     * @param Array $teams Teams to process.
     */
    private function calculateScores(&$teams) {
        foreach($teams as $team) {
            $this->say("Calculating total score for team " . $team->name . "...<br/>");

            $team->total = $team->getTotalTopTwoScores(); //Get the total top two scores for a team.
            $team->displayed_total = $team->getTotalTopTwoScores(true);

            $this->say("Team '" . $team->getName() . "' has a total of " . $team->total . ".<br/>");
        }
    }

    /**
     * Sort and place all teams.
     *
     * @param array $teams Teams to process.
     */
    private function place(&$teams) {
        //Perform a quick sort of all teams, based on score.
        $this->sort($teams);

        $currentTeam = null;
        $place = 1;
        $lastPlace = 0;

        for($i = 0; $i < count($teams); $i++) {
            if($currentTeam != null && $teams[$i]->total == $currentTeam->total) {
                $teams[$i]->place = $lastPlace;
                $this->say("Not incrementing place... Total = " . $teams[$i]->total ." Current Team Total: (null)<br/>");
            } else {
                $teams[$i]->place = $place;
                $this->say("Incrementing place...<br/>");
                $lastPlace = $place;
                $place += 1;
                $currentTeam = $teams[$i];
            }
        }
    }

    /**
     * Process ties for a set of teams.
     *
     * @param array $teams Array of team objects
     */
    private function processTies(&$teams, $totalToCareAbout = -1, $done = false) {
        if($totalToCareAbout == -1) {
            $totalToCareAbout = count($teams);
        }

        //Loop through all teams
        for($i = 0; $i < $totalToCareAbout && $i < count($teams) && !$done; $i++) {
            //Compare all teams with the current indexed team
            for($j = 0; $j < count($teams) && $j < $totalToCareAbout; $j++) {
                if($teams[$j]->total == $teams[$i]->total) { //We have a tie!
                    
                }
            }
        }
    }

    /**
     * Save all teams.
     *
     * @param array $teams The teams to save.
     */
    private function saveAll(&$teams) {
        foreach($teams as $team) {
            $team->save();
        }
    }

    /**
     * Sorts the specified teams array based on $field, which is the name of a property for the Team object.
     *
     * @param array $teams The teams to sort.
     * @param string $field Optional. The field to sort on. Defaults to 'total'.
     */
    private function sort(&$teams, $field = 'total') {
        $flag = true;
        for($i = 0; $i < count($teams) && $flag; $i++) {
            $flag = false;

            for($j = 0; $j < (count($teams) - 1); $j++) {
                if($teams[$j + 1]->$field > $teams[$j]->$field) {
                    $temp = $teams[$j];
                    $teams[$j] = $teams[$j + 1];
                    $teams[$j + 1] = $temp;
                    $flag = true;
                }
            }
        }
    }

    /**
     * Helper function. If the config var, "verbose" is set, then echo $string.
     *
     * @param string $string The string to print.
     */
    public function say($string) {
        $this->_output .= $string;
    }

    /**
     * Helper function. var_dump($var) if config["verbose"] is true.
     *
     * @param mixed $var The variable to print.
     */
    public function debugSay($var) {
        $this->_output .= var_export($var, true);
    }
}