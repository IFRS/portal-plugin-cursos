<?php
defined('ABSPATH') or die('No script kiddies please!');
/*
Plugin Name: IFRS Portal Cursos
Plugin URI:  https://github.com/IFRS/portal-plugin-cursos
Description: Plugin para gerenciar Cursos.
Version:     0.0.1
Author:      Ricardo Moro
Author URI:  https://github.com/ricardomoro
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: ifrs-portal-plugin-cursos
Domain Path: /lang
*/

if ( file_exists( dirname( __FILE__ ) . '/vendor/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/vendor/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/CMB2/init.php';
}

require_once('curso.php');
require_once('modalidade.php');
require_once('nivel.php');
require_once('roles.php');

register_activation_hook(__FILE__, function () {
    flush_rewrite_rules();
    ifrs_portal_cursos_addRoles();
});

register_deactivation_hook(__FILE__, function () {
    flush_rewrite_rules();
    ifrs_portal_cursos_removeRoles();
});
