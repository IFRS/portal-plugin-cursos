<?php
defined('ABSPATH') or die('No script kiddies please!');
/*
Plugin Name: IFRS Portal Cursos
Plugin URI:  https://github.com/IFRS/portal-plugin-cursos
Description: Plugin para gerenciamento de Cursos.
Version:     0.0.1
Author:      Ricardo Moro
Author URI:  https://github.com/ricardomoro
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: ifrs-portal-plugin-cursos
Domain Path: /lang
*/

require_once('curso.php');
require_once('curso-modalidade.php');
require_once('curso-nivel.php');
require_once('curso-turno.php');
require_once('curso-unidade.php');
require_once('roles.php');
require_once('config.php');
require_once('queries.php');
require_once('shortcode-vue.php');

register_activation_hook(__FILE__, function() {
    flush_rewrite_rules();
    ifrs_portal_cursos_addRoles();
});

register_deactivation_hook(__FILE__, function() {
    flush_rewrite_rules();
    ifrs_portal_cursos_removeRoles();
});
