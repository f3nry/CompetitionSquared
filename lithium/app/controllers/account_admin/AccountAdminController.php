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

namespace app\controllers\account_admin;

use app\models\User;

use lithium\storage\Session;

/**
 * Description of AccountAdminController
 *
 * @author Paul <paulhenry@mphwebsystems.com>
 */
class AccountAdminController extends \app\controllers\AppController {

    protected $is_admin = true;

    protected function _requireAuth() {
        parent::_requireAuth('appadmin', 'login');

        $this->set(array('admin' => true));
    }

    public function login() {
        $permissions = array('SUPERADMIN');
        $redirPath = "/";

        parent::checkSession($permissions, $redirPath, true);

        $this->_render["template"] = "../app/login";

        if (isset($this->request->data["username"])) {
            list($id, $userPermissions) = User::check($this->request->data["username"], $this->request->data["password"], true);

            if ($id !== false && ((is_array($permissions) && \array_search($userPermissions, $permissions) !== false
                    || $userPermissions == $permissions))) {
                Session::write('user', $this->request->data["username"]);
                Session::write('id', $id);
                Session::write('permissions', $userPermissions);

                if(Session::read('permissions') == "SUPERADMIN") {
                    Session::write('accountName', 'admin');
                } else {
                    Session::write('accountName', $this->accountName);
                }

                if(!$this->isExt) {
                    $this->redirect("/" . $this->accountName . "/" . $redirPath);
                } else {
                    return array("success" => true);
                }
            } else {
                return array('success' => false, 'error' => 'Incorrect username/password.');
            }
        }
    }

    public function logout() {
        parent::logout('appadmin', 'admin');
    }

    public function changepassword() {
        parent::changepassword('appadmin', 'admin', 'login');

        $this->_render["template"] = "../app/changepassword";
    }

    public function index() {
        $this->_requireAuth();
    }
}

?>
