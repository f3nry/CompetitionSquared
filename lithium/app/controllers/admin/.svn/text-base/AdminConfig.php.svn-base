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

use app\models\AppConfig;

/**
 * Controller to allow admins to manage global configuration options.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class AdminConfig extends \app\controllers\AdminController {
    /**
     * Set a configuration variable through POST.
     */
    public function configSet() {
        parent::_requireAuth();

        AppConfig::set($this->request->var, $this->request->data[$this->request->var]);

        $this->redirect($this->request->env("HTTP_REFERER"));

        return false;
    }
}