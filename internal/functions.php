<?php
# function.php has global functions for all files to use


# require specifc file and if it doesn't exist then require the default
function requireFileOrDefault($f_file, $default) {
	if (is_file(dirname(__FILE__) . '/' . $f_file)) {
		require(dirname(__FILE__) . '/' . $f_file);
	} else {
		require(dirname(__FILE__) . '/' . $default);
	}
}




?>