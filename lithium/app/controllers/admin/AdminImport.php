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

use app\models\importers\JOTImporter;

/**
 * Controller to manage importer wizards from various data formats. Currently only supports Joy Of Tournaments.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminImport extends \app\controllers\AdminController {

    /**
     * Perform and manage a Joy Of Tournaments importer.
     */
    public function jot() {
        parent::_requireAuth();
        
        if ($this->request->data) {
            $importer = new JOTImporter(array('data' => $this->request->data));

            $importer->run();

            $this->redirect($this->accountName .'/admin/teams');
        } else {
            return array('types' => \app\models\TeamTypes::load());
        }
    }

}