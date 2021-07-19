<?php

function sanitize($array = []):array
{
	foreach($array as $key => $value) {
		if (!is_array($value)) {
			$array[$key] =  htmlspecialchars(strip_tags($value));
		} else {
			for ($i =0; $i < count($value); $i++) {
				$array[$key][$i] =  htmlspecialchars(strip_tags($value[$i]));
			}
		}
		
	}

	return $array;
}
