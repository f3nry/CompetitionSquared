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

use app\models\School;

/**
 * AdminSchools
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminSchools extends \app\controllers\AdminController {
    protected function _requireAuth() {
        parent::_requireAuth("admin/schools");
    }

    public function index() {
        $this->_requireAuth();
        
        return array('schools' => School::all());
    }

    public function add() {
        $this->_requireAuth();

        if($this->request->data) {
            $school = School::create($this->request->data);

            $school->save();

            $this->redirect($this->accountName . "/admin/schools");
        }
    }

    public function edit() {
        $this->_requireAuth();
        
        $school = School::first($this->request->id);
        if($this->request->data) {
            $school->name = $this->request->data['name'];

            $school->save();

            $this->redirect($this->accountName . "/admin/schools");
        }

        return array('school' => School::first($this->request->id));
    }

    public function delete() {
        
    }
}