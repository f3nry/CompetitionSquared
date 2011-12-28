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

use app\models\Account;

use app\models\wizards\ClientAccountWizard;

/**
 * Description of AccountsAdminController
 *
 * @author Paul <paulhenry@mphwebsystems.com
 */
class AccountsAdminController extends AccountAdminController {
    public function index() {
        parent::_requireAuth();

        return array('accounts' => Account::all());
    }

    public function add() {
        parent::_requireAuth();

        if($this->request->data) {
            if($this->request->data['accountname'] != "") {
                if(!Account::checkName($this->request->data['accountname'])) {
                    $clientAccountWizard = new ClientAccountWizard(
                                array(
                                    'accountName'     => $this->request->data['accountname'],
                                    'defaultUsername' => $this->request->data['username'],
                                    'defaultPassword' => $this->request->data['password']
                                )
                            );
                    
                    $clientAccountWizard->run();

                    $this->redirect('admin/');
                } else {
                    $this->set(array("error" => "That account name is already taken."));
                }
            } else {
                $this->set(array("error" => "Account Name cannot be empty."));
            }
        }

        $this->redirect('admin/');
    }

    public function delete() {
        parent::_requireAuth();

        Account::doDelete($this->request->id);

        $this->redirect("admin/");
    }
}
?>
