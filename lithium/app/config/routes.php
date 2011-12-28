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

use lithium\net\http\Router;
use lithium\core\Environment;

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
Router::connect('/contact', array('controller' => 'app\controllers\PagesController', 'action' => 'contact'));
Router::connect('/pages/{:args}', 'Pages::view');

Router::connect('/', 'Pages::view');

Router::connect('/admin/accounts', array('controller' => 'app\controllers\account_admin\AccountsAdminController', 'action' => 'index'));
Router::connect('/admin/accounts/{:action}', array('controller' => 'app\controllers\account_admin\AccountsAdminController'));
Router::connect('/admin/accounts/{:action}/{:id}', array('controller' => 'app\controllers\account_admin\AccountsAdminController'));

Router::connect('/admin', array('controller' => 'app\controllers\account_admin\AccountAdminController', 'action' => 'index'));
Router::connect('/admin/{:action}', array('controller' => 'app\controllers\account_admin\AccountAdminController'));

/**
 * Connect the root controller..
 */
Router::connect('/{:accountName}', array('controller' => 'app\controllers\MainController'));
Router::connect('/{:accountName}/login', array('controller' => 'app\controllers\AppController', 'action' => 'login'));
Router::connect('/{:accountName}/logout', array('controller' => 'app\controllers\AppController', 'action' => 'logout'));
Router::connect('/{:accountName}/changepassword', array('controller' => 'app\controllers\AppController', 'action' => 'changepassword'));

/**
 * Connect the routes for viewing public team data...
 */
Router::connect('/{:accountName}/teams/type/{:team_type}', array('controller' => 'app\controllers\TeamsController', 'action' => 'index'));
Router::connect('/{:accountName}/teams/type/{:team_type}/page/{:page}', array('controller' => 'app\controllers\TeamsController', 'action' => 'index'));
Router::connect('/{:accountName}/teams/{:action}/{:id:[0-9]+}', array('controller' => 'app\controllers\TeamsController'));
Router::connect('/{:accountName}/slideshow', array('controller' => 'app\controllers\TeamsController', 'action' => 'slideshow'));
Router::connect('/{:accountName}/teams/{:team_id:[0-9]+}/score/{:score_id:[0-9]+}', array('controller' => 'app\controllers\TeamsController', 'action' => 'score'));

/**
 * Connect the routes for viewing schools..
 */
Router::connect('/{:accountName}/schools', array('controller' => 'app\controllers\SchoolController', 'action' => 'index'));

/* --Admin Routes-- */

/**
 * Connect the routes for editing team types..
 */
Router::connect('/{:accountName}/admin/teams/types/{:action}', array('controller' => 'app\controllers\admin\AdminTeamTypes'));
Router::connect('/{:accountName}/admin/teams/types/{:action}/{:id}', array('controller' => 'app\controllers\admin\AdminTeamTypes'));


/**
 * Connect the routes for managing teams..
 */
Router::connect('/{:accountName}/admin/teams/type/{:selectedType}', array('controller' => 'app\controllers\admin\AdminTeams', 'action' => 'index'));
Router::connect('/{:accountName}/admin/teams/get', array('controller' => 'app\controllers\admin\AdminTeams', 'action' => 'getTeams'));
Router::connect('/{:accountName}/admin/teams/get/{:selectedType}', array('controller' => 'app\controllers\admin\AdminTeams', 'action' => 'getTeams'));
Router::connect('/{:accountName}/admin/teams/{:action}', array('controller' => 'app\controllers\admin\AdminTeams'));
Router::connect('/{:accountName}/admin/teams/{:action}/{:id}', array('controller' => 'app\controllers\admin\AdminTeams'));

/**
 * Connect the routes for managing schools..
 */
Router::connect('/{:accountName}/admin/schools/{:action}', array('controller' => 'app\controllers\admin\AdminSchools'));
Router::connect('/{:accountName}/admin/schools/{:action}/{:id}', array('controller' => 'app\controllers\admin\AdminSchools'));

/**
 * Connect the routes for managing scorecards..
 */
Router::connect('/{:accountName}/admin/scorecards/{:action}', array('controller' => 'app\controllers\admin\AdminScoreCards'));
Router::connect('/{:accountName}/admin/scorecards/{:action}/{:id}', array('controller' => 'app\controllers\admin\AdminScoreCards'));

/**
 * Connect the routes for managing scores..
 */
Router::connect('/{:accountName}/admin/scores', array('controller' => 'app\controllers\admin\AdminScores', 'action' => 'index'));
Router::connect('/{:accountName}/admin/scores/type/{:selectedType}', array('controller' => 'app\controllers\admin\AdminScores', 'action' => 'index'));
Router::connect('/{:accountName}/admin/scores/{:action}', array('controller' => 'app\controllers\admin\AdminScores'));
Router::connect('/{:accountName}/admin/scores/{:action}/{:id}', array('controller' => 'app\controllers\admin\AdminScores'));

/**
 * Route for viewing log entry..
 */
Router::connect('/{:accountName}/admin/scores/log/entry/{:id}', array('controller' => 'app\controllers\admin\AdminScores', 'action' => 'logEntry'));

/**
 * Connect the routes for setting configuration variables..
 */
Router::connect('/{:accountName}/admin/config', array('controller' => 'app\controllers\admin\AdminConfig', 'action' => 'index'));
Router::connect('/{:accountName}/admin/config/set/{:var}', array('controller' => 'app\controllers\admin\AdminConfig', 'action' => 'configSet'));

/**
 * Connect the importer routes..
 */
Router::connect('/{:accountName}/admin/import/{:action}', array('controller' => 'app\controllers\admin\AdminImport'));

/**
 * Connect the account admin routes..
 */
Router::connect('/{:accountName}/admin/accounts/{:id}/remove/team/{:team_id}', array('controller' => 'app\controllers\admin\AdminAccounts', 'action' => 'removeTeam'));
Router::connect('/{:accountName}/admin/accounts/{:id}/add/team', array('controller' => 'app\controllers\admin\AdminAccounts', 'action' => 'addTeam'));
Router::connect('/{:accountName}/admin/accounts/{:action}', array('controller' => 'app\controllers\admin\AdminAccounts'));
Router::connect('/{:accountName}/admin/accounts/{:action}/{:id}', array('controller' => 'app\controllers\admin\AdminAccounts'));

/**
 * Connect the wizard routes..
 */
Router::connect('/{:accountName}/admin/wizards/{:action}', array('controller' => 'app\controllers\admin\AdminWizards'));

/**
 * Connect the default administration routes..
 */
Router::connect('/{:accountName}/admin', array('controller' => 'app\controllers\AdminController', 'action' => 'index'));
Router::connect('/{:accountName}/admin/{:action}', array('controller' => 'app\controllers\AdminController'));

/**
 * Connect the testing routes.
 */
if (!Environment::is('production')) {
	//Router::connect('/test/{:args}', array('controller' => 'lithium\test\Controller'));
	//Router::connect('/test', array('controller' => 'lithium\test\Controller'));
}

/**
 * Finally, connect the default routes.
 */
//Router::connect('/{:controller}/{:action}/{:id:[0-9]+}.{:type}', array('id' => null));
//Router::connect('/{:controller}/{:action}/{:id:[0-9]+}');
//Router::connect('/{:controller}/{:action}/{:args}');

?>