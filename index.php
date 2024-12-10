<?php
/**
 * Plugin Name: Steam Integration
 * Description: Conecta tu WordPress con la API de Steam para mostrar datos de usuarios y permitir inicio de sesión.
 * Version: 0.1
 * Author: c.esteve
 * License: GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Bloquea el acceso directo

// Carga las funciones del plugin
include_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
