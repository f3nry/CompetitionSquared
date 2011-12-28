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

use app\models\User;
use app\models\Account;
use app\models\Permission;

use app\models\AppConfig;
use lithium\storage\Session;

/**
 * The main application controller. Provides functions to select the correct account, login, logout, and change password.
 *
 * @author Paul <paulhenry@mphwebsystems.com>
 */
class AppController extends \lithium\action\Controller {
    public $accountName;

    protected $is_admin = false;

    /**
     * Init function. Finds the correct client account, and sets some default template variables.
     */
    public function _init() {
        parent::_init();

        if(!$this->is_admin) {
            if(!Account::checkName($this->request->accountName)) {
                die("Sorry, unknown account " . $this->request->accountName);
            }

            if(!Account::go($this->request->accountName)) {
                die("Sorry, unknown account " . $this->request->accountName);
            }

            $this->accountName = $this->request->accountName;
        } else {
            $this->accountName = "admin";
        }

        $this->_render["layout"] = AppConfig::get('default_layout', false, 'default');

        $this->set(array('title' => AppConfig::get('competition_name')));
        $this->set(array("accountName" => $this->accountName));
        $this->set(array("permission" => "app\models\Permission"));
    }

    /**
     * Check if the user is logged in or not with the correct permissions.
     *
     * @param string $permissions The permission to look for.
     * @param string $redirPath Path to redirect to on check session fail.
     * @param string $exists Check if the session exists, or if it doesn't exist.
     */
    public function checkSession($permissions, $redirPath, $exists = false) {
        if ($exists) {
            if (Session::check('user') 
                    && (Session::read('permissions') == 'SUPERADMIN' || Session::read('accountName') == $this->accountName)
                    && Permission::check(Session::read('permissions'), $permissions)) {
                $this->redirect("/" . $this->accountName . "/" . $redirPath);
            }
        } else {
            if (!Session::check('user') || (Session::read('permissions') != 'SUPERADMIN' && Session::read('accountName') != $this->accountName) || !Permission::check(Session::read('permissions'), $permissions)) {
                $this->redirect("/" . $this->accountName . "/" . $redirPath);
            }
        }
    }

    /**
     * Global function to require the user to have a certain set of permissions.
     *
     * @param string $permissions The permissions that the user must have to pass authentication.
     * @param string $redirPath The path to redirect to on auth fail.
     */
    protected function _requireAuth($permissions = "home", $redirPath = "login") {
        $this->checkSession($permissions, $redirPath);

        $this->set(array('user' => Session::read('user'), 'permissions' => Session::read('permissions')));
    }

    /**
     * User Login function.
     *
     * @param string $permissions The required permissions to log in.
     * @param string $redirPath The path to redirect to when auth is successfull.
     */
    public function login($permissions = "home", $redirPath = "/") {
        $this->checkSession($permissions, $redirPath, true);
        
        if (isset($this->request->data["username"])) {
            list($id, $userPermissions) = User::check($this->request->data["username"], $this->request->data["password"], true);

            if ($id && Permission::check($userPermissions, $permissions)) {
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

    /**
     * User logout function. Logs the user out.
     *
     * @param string $permissions Required user permissions to pass auth.
     * @param string $redirPath Path to redirect to on success.
     */
    public function logout($permissions = array('PARENT', 'ADMIN', 'ACCT_CREATOR'), $redirPath = "/") {
        $this->_requireAuth($permissions);

        Session::clear();

        $this->redirect("/" . $this->accountName . "/" . $redirPath);
    }

    /**
     * Change password function. Allows the user to change his/her password.
     *
     * @param string $permissions Required user permissions to change password.
     * @param string $onSuccessRedirPath Path to redirect to when password change is successful.
     * @param string $redirPath The path to redirect to when auth fails.
     */
    public function changepassword($permissions = array('PARENT', 'ADMIN', 'ACCT_CREATOR'), $onSuccessRedirPath = "/", $redirPath = "login") {
        $this->_requireAuth($permissions, $redirPath);

        if (isset($this->request->data["oldpass"])) {
            if (User::check(Session::read('user'), $this->request->data["oldpass"])) {
                if ($this->request->data["newpass"] != "" && ($this->request->data["newpass"] == $this->request->data["newpass2"])) {
                    User::updatePassword(Session::read('user'), $this->request->data["newpass"]);

                    $this->redirect("/" . $this->accountName . "/" . $onSuccessRedirPath);
                } else {
                    return array('error' => 'New passwords do not match.');
                }
            } else {
                return array('error' => 'Old password is not correct.');
            }
        }
    }

    public function finish($json) {
        echo \json_encode($json);
        exit;
    }
}

?>
