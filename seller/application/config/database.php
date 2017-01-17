<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/5/16 8:40 AM
 * Description: Database configuration
 */

$active_group = 'default';
$query_builder = TRUE;

$useLocal = FALSE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $useLocal == TRUE ? 'localhost':'192.168.100.81',//'tcms.staging.onenow.com',
	'username' => 'root',
	'password' => $useLocal == TRUE ? '':'$cgw1IT2user',//'vshop1ne$now';
	'database' => $useLocal == TRUE ? 'db_catalog_buythai':'db_catalog_dev_v3',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'tbl_',
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
