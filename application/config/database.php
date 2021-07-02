<?php
defined('BASEPATH') or exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;

//date_default_timezone_set('Asia/Kolkata');
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $config['base_url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/';
    //$config['root']   ='https://'.$_SERVER['HTTP_HOST'];
} else {
    $config['base_url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    //$config['root']   ='http://'.$_SERVER['HTTP_HOST'];
}

if ($config['base_url'] == "https://d.ourmainevent.com/") {
	$db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => 'prasanna',
		'password' => 'Prasanna@12',
		'database' => 'demoerp',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);
} elseif ($config['base_url'] == "http://erp.local.com/") {
	$db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'password',
		'database' => 'erp',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);
} else {
	$db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => 'prasanna',
		'password' => 'Prasanna@12',
		'database' => 'erp',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);
}
