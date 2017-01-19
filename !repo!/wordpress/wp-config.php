<?php
// ** MySQL settings ** //
define('DB_NAME', 'usr_web1162_2');

/** MySQL database username */
define('DB_USER', 'web1162');

/** MySQL database password */
define('DB_PASSWORD', 'bX2KARTc');

/** MySQL hostname */
define('DB_HOST', 'localhost');

// You can have multiple installations in one database if you give each a unique prefix
$table_prefix  = 'wp_';   // Only numbers, letters, and underscores please!

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-includes/languages.
// For example, install de.mo to wp-includes/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', '');
//define( 'DB_CHARSET', 'utf8' );
//define( 'DB_COLLATE', 'utf8_general_ci' );

/* That's all, stop editing! Happy blogging. */

define('ABSPATH', dirname(__FILE__).'/');
require_once(ABSPATH.'wp-settings.php');
?>