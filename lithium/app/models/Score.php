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

use lithium\util\FilteredCollection;

/**
 * Represents the scores table.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class Score extends \li3_activerecord\extensions\data\Model {

    /**
     * Relationships
     *
     * @var ActiveRecord Relationship Definition
     */
    protected static $belongs_to = array(
        array(
            'team',
            'class_name' => '\app\models\Team',
            'readonly' => true
        ),
        array(
            'score_card',
            'class' => '\app\models\ScoreCard',
            'readonly' => true
        )
    );

    protected static $has_many = array(array('fields', 'class_name' => '\app\models\Field'));

    private $calculated;

    private $ignore;

    /**
     * Loads all fields for the current score from an array.
     *
     * @param array $fields
     */
    public function _loadFields($fields) {
        foreach($fields as $fieldKey => $field) {
            $this->fields[] = Field::create(array('field_name' => $fieldKey, 'total' => (double)$field));
        }
    }

    /**
     * Get's the total for the specified field name.
     *
     * @param string $fieldName The field name to look for.
     * @return int The total for that field.
     */
    public function getField($fieldName) {
        foreach($this->fields as $field) {
            if($field->field_name == $fieldName) {
                return $field->total;
            }
        }
    }

    public function setCalculated($value) {
        $this->calculated = $value;
    }

    public function isCalculated() {
        return $this->calculated;
    }

    public function setIgnore($value) {
        $this->ignore = $value;
    }

    public function ignore() {
        return $this->ignore;
    }

    /**
     * Calculate the score for the attached fields based on the score card definition.
     */
    public function calculateScore() {
        $actions = $this->score_card->score_card_actions;

        $i = 0;

        foreach($this->fields as $field) {
            if($actions[$i]->type == "HIDDEN") {
                $this->displayed_total += 0;
            } else {
                $this->displayed_total += $field->total;
            }

            $this->total += $field->total;

            $i++;
        }
    }

    /**
     * Saves the current score into the database. It also calculates the total for the current score.
     */
    public function save($data = array()) {
       parent::save($data);

       $this->total = 0;

       foreach($this->fields as $field) {
           $field->score_id = $this->id;
           $field->save();
       }

       $this->calculateScore();

       parent::save();
    }

    /**
     * Performs an update operation. Recalculates total for this score, and appends any new fields.
     *
     * @param array $data The POST data to work with.
     */
    public function update($data) {
        $fields = FilteredCollection::filterByKey("field", $data);
        $score = FilteredCollection::filterByKey("score", $data, true);

        $actions = $this->score_card->score_card_actions;

        foreach($this->fields as $field) {
            $field->total = $fields[$field->field_name];

            unset($fields[$field->field_name]);
        }

        if(count($fields) != 0) {
            $this->_loadFields($fields);
        }

        $this->team_id = $score['team_id'];
        $this->round = $score['round'];

        $this->save();
    }

    /**
     * Adds a new Score to the database.
     *
     * @param array $data Array of POST data to work with.
     */
    public static function add($data) {
        $fields = FilteredCollection::filterByKey("field", $data);
        $score = FilteredCollection::filterByKey("score", $data, true);

        $score["isrunoff"] = (isset($score["isrunoff"]) && $score["isrunoff"] == "on") ? "1" : "0";
        $score["total"] = 0.0;

        unset($score["card_id"]);

        $score = Score::create($score);
        $score->_loadFields($fields);
        $score->score_card_id = $data["score_card_id"];

        $score->save();

        if(AppConfig::get('score_type') == 'noscoring') {
            $team = Team::find($data['score_team_id']);

            $team->place = $data['place'];

            $team->save();
        }
        
        $score->query("UPDATE score_cards SET locked = 1 WHERE id = ?", array($score->score_card_id));
    }

    /**
     * Find the maximum score in an array of Score objects.
     *
     * @param Array $scores An array of Score objects.
     * @return array An array with the first index being the numerical score, and the second being the index where that score was found.
     */
    public static function findMax($scores) {
        if(count($scores) == 1) {
            return $scores[0]->total;
        }

        $maxScore = null;
        $index = -1;

        if(count($scores) != 0) {
            for($i = 0; $i < count($scores); $i++) {
                $score = $scores[$i];

                if(!$score->ignore()) {
                    if($maxScore == null || $score->total > $maxScore->total) {
                        $maxScore = $score;
                        $index = $i;
                    }
                }
            }
        }

        return array($maxScore, $index);
    }

    public static function findMin($scores) {
        if(count($scores) == 1) {
            return $scores[0]->total;
        }

        $minScore = null;
        $index = -1;

        if(count($scores) != 0) {
            for($i = 0; $i < count($scores); $i++) {
                $score = $scores[$i];

                if(!$score->ignore()) {
                    if($maxScore == null || $score->total < $maxScore->total) {
                        $maxScore = $score;
                        $index = $i;
                    }
                }
            }
        }

        return array($maxScore, $index);
    }

    public function getType($type) {
        TeamTypes::load();

        return TeamTypes::getName($type);
    }
}