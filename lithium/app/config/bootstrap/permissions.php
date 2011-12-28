<?php

use app\models\Permission;

Permission::add("SUPERADMIN", "appadmin");

Permission::add("ADMIN, SUPERADMIN, ACCT_CREATOR", "home/adminlink");
Permission::add("ADMIN, SUPERADMIN, ACCT_CREATOR", "admin");
Permission::add("ADMIN, SUPERADMIN, ACCT_CREATOR", "admin/accounts");
Permission::add("ADMIN, SUPERADMIN", "admin/students");
Permission::add("ADMIN, SUPERADMIN", "admin/scorecard");
Permission::add("ADMIN, SUPERADMIN", "admin/score");
Permission::add("ADMIN, SUPERADMIN", "admin/teamtypes");
Permission::add("ADMIN, SUPERADMIN", "admin/schools");
Permission::add("ADMIN, SUPERADMIN, ACCT_CREATOR", "admin/accountwizard");

Permission::add("ADMIN, SUPERADMIN, PARENT, ACCT_CREATOR", "home");
