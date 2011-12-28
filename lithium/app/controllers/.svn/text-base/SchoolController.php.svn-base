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

use app\models\School;

class SchoolController extends AppController {
    public function index() {
        $this->_requireAuth();

        if($this->request->is('ajax')) {
            $this->_render['layout'] = false;
            $this->set(array('showBack' => false));
        } else {
            $this->set(array('showBack' => true));
        }

        return array('schools' => School::all(array('order' => 'place ASC')));
    }
}
