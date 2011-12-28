<?php

namespace app\models;

/**
 * A quick permissions class. Allows you to add defined permissions, and then check against those permissions.
 *
 * Examples:
 * Permission::add("USER, ADMIN", "view/teams");
 *
 * Permission:check($user, "view/teams"); // Returns true if user is a user or admin and can view/teams.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class Permission {
    private static $_permissions;

    /**
     * Adds a new permission to the array.
     *
     * @param string $type The user type. Can be in the format of a single type, "USER" or in the format of multi-type seperate by comma, "USER, ADMIN".
     * @param string $permission The specific permission to add.
     */
    public static function add($type, $permission) {
        $types = explode(",", $type);

        if(count($types) > 1) {
            foreach($types as $type) {
                $type = trim($type);
                
                self::$_permissions[$type][] = $permission;
            }
        } else {
            self::$_permissions[$type][] = $permission;
        }
    }

    /**
     * Check a user against the added permissions.
     *
     * @param User $user The user object.
     * @param string $checkPermission The permission to check.
     * @return boolean true if permission is valid for the user, or false.
     */
    public static function check($user, $checkPermission) {
        if(is_object($user)) {
            $userPermissions = $user->permissions;
        } else {
            $userPermissions = $user;
        }

        foreach(self::$_permissions as $key => $type) {
            if($userPermissions == $key && \is_array($type) && count($type) > 0) {
                foreach($type as $permission) {
                    if($permission == $checkPermission) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}