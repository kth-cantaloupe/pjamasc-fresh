<?php
class Arrays {
	public static function isset($array, $keys) {
		foreach ($keys as $key)
			if (!isset($array[$key]))
				return false;

		return true;
	}
}
