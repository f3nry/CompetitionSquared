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

use app\models\Team;

use app\models\wizards\AccountWizard;

/**
 * Controller for any wizards.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminWizards extends \app\controllers\AdminController {
    /**
     * Mass account wizard. Allows the auto-creation of parent accounts.
     */
    public function accounts() {
        $this->_requireAuth("admin/accountwizard");
        
        if($this->request->data) {
            $wizard = new AccountWizard(array('school' => $this->request->data["school"]));

            $wizard->run();

            exit;
        } else {
            $this->set(array("schools" => Team::getSchools()));
        }
    }
}