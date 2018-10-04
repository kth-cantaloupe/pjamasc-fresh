<?php

/**
 * Class Authentication Contains authentication functions for the current user, if present
 */
class Authentication {
	private static $user;

    /**
     * @return null|User Returns null if no user is signed in. Otherwise a user DTO.
     */
	public static function user() {
		if (isset($_SESSION['user'])) {
			$user = Database::getInstance()->getUserById($_SESSION['user']);

			if ($user !== null)
				return $user;
		}

		return null;
	}

    /**
     * @return bool Whether user is an admin or not.
     */
	public static function admin() {
		$user = self::user();

		if ($user !== null)
			return $user->type === 'admin';

		return false;
	}

    /**
     * @return bool Whether user is a customer or not.
     */
	public static function customer() {
	    $user = self::user();

	    if($user !== null)
	        return $user->type === 'customer';

	    return false;
    }
}
