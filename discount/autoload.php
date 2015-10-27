<?php

$autoload_dirs = array( '.', 'DiscountTypes', 'DiscountItems' );

spl_autoload_register( function ($name) use($autoload_dirs) {
	$name = str_replace( '\\', DIRECTORY_SEPARATOR, $name );
	foreach ( $autoload_dirs as $dir ) {
		if ( is_readable( $dir . "/" . $name . ".php" ) ) {
			include($dir . "/" . $name . ".php");
			return;
		}
	}
} );