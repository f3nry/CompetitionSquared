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

use lithium\storage\Session;

use app\models\User;

/**
 * The admin controller is used as a base class for all administration actions.
 *
 * @author letuboy
 */
class AdminController extends AppController {

    /**
     * Require user to be logged in, but with a default permission of 'admin'.
     *
     * @param string $permissions The required permissions for the current request.
     */
    protected function _requireAuth($permissions = 'admin') {
        parent::_requireAuth($permissions, 'admin/login');

        $this->set(array('admin' => true));
    }

    /**
     * Administration login action.
     */
    public function login() {
        parent::login("admin", 'admin/');

        $this->_render["template"] = "../app/login";
    }

    /**
     * Administration logout action.
     */
    public function logout() {
        parent::logout("admin", 'admin/');
    }

    /**
     * Administration change password action.
     */
    public function changepassword() {
        parent::changepassword("admin", 'admin/', 'admin/login');

        $this->_render["template"] = "../app/changepassword";
    }

    /**
     * Administration index page. Lists the administration actions available to the user.
     */
    public function index() {
        $this->_requireAuth("admin");
    }
}
