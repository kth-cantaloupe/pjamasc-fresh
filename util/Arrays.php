<?php
class Arrays {

    /**
     * Checks if all entries in an array is set.
     * @param $array - Array of anything
     * @param $keys - Entry in array
     * @return bool - true if all values are set, false if not
     */
	public static function areset($array, $keys) {
		foreach ($keys as $key)
			if (!isset($array[$key]))
				return false;

		return true;
	}
}
