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
 * ScoreCard
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class ScoreCard extends \li3_activerecord\extensions\data\Model {
    protected static $has_many = array(
        array(
            'score_card_actions',
            'class_name' => '\app\models\ScoreCardAction',
            'order' => 'score_card_actions.index ASC'
        )
    );

    public static function add($data) {
        $actions = FilteredCollection::filterByKey2D("field", $data);

        $scorecard = ScoreCard::create(array('name' => $data["name"]));
        $scorecard->save();

        $id = self::connection()->insert_id();

        $i = 0;

        foreach($actions as $key => $action) {
            $actionAsArray = $action;

            $actionAsArray["score_card_id"] = $id;
            $actionAsArray["index"] = $i++;

            $action = ScoreCardAction::create($actionAsArray);
            $action->save();
        }
    }

    protected function addAction($action, $index) {
        $action['score_card_id'] = $this->id;
        $action['index'] = $index;

        $action = ScoreCardAction::create($action);
        $action->save();
    }

    private function deleteActions($actions) {
        $scoreCardActions = ScoreCardAction::find_all_by_score_card_id($this->id);
        
        foreach($scoreCardActions as $scoreCardAction) {
            $scoreCardAction->delete();
        }
    }

    public function update($data) {
        $actions = FilteredCollection::filterByKey2D("field", $data);
        
        $this->deleteActions($actions);

        foreach($actions as $key => $action) {
            $this->addAction($action, ScoreCardAction::getIdFromFieldName($key));
        }
    }

    public function getForTeamWithID($teamID) {
        $type = TeamTypes::find('first', array('conditions' => array('type = ?', $type)));
    }

    public function get($type) {
        $teamType = TeamTypes::find('first', array('conditions' => array('id = ?', $type)));

        return ScoreCard::find('first', array('conditions' => array('id = ?', $teamType->score_card)));
    }
}