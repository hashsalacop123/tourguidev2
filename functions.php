<?php  $files_to_include = array(
  'acf_functions.php',
  'wp_enque_functions.php',
  'wp_settings_function.php',
  'cpt.php',
  'account-settings.php',
  'reuse_functions.php'
);
foreach ( $files_to_include as $file ) {
  if ( !$filepath = locate_template( 'inc/functions/' . $file ) ) {
    trigger_error( sprintf( 'Error locating %s for inclusion', $file ), E_USER_ERROR );
  }
  require_once $filepath;
}?>