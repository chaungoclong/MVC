<?php 
/**
 * This variable contains all configuration values
 */
$_CONF = [];

$list_files_conf = glob(APP_PATH . "/config/[a-z]*_conf\.php");

 foreach ($list_files_conf as $key => $file_path) {
 	$path_split = explode("/", $file_path);

 	$file_name = end($path_split);

 	$index = str_ireplace("_conf.php", "", $file_name);

 	$list_conf = include_once APP_PATH . "/config/" . $file_name;

 	$_CONF[$index] = is_array($list_conf) ? $list_conf : [];
 	
 }

 define("CONF", $_CONF);

 unset($_CONF);
