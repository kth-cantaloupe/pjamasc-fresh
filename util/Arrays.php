<?php
class Arrays {
	public static function areset($array, $keys) {
		foreach ($keys as $key)
			if (!isset($array[$key]))
				return false;

		return true;
	}
}
