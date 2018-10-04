<?php
class Authentication {
	private static $user;

	public static function user() {
		if (isset($_SESSION['user'])) {
			$user = Database::getInstance()->getUserById($_SESSION['user']);

			if ($user !== null)
				return $user;
		}

		return null;
	}

	public static function admin() {
		$user = self::user();

		if ($user !== null)
			return $user->type === 'admin';

		return false;
	}

	public static function customer() {
	    $user = self::user();

	    if($user !== null)
	        return $user->type === 'customer';

	    return false;
    }
}
