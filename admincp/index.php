<?php
session_start();

date_default_timezone_set ("Asia/Saigon");
define('incl_path','../includes/');
define('libs_path','libs/');
require_once('includes/gfconfig.php');
require_once('../includes/gfinnit.php');
require_once(incl_path.'gffunction.php');
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.configsite.php');
require_once(libs_path.'cls.users.php');
require_once(libs_path.'cls.menu.php');
require_once(libs_path.'cls.template.php');
$obj_sql= new CLS_MYSQL();
$UserLogin=new CLS_USERS;
$tmp=new CLS_TEMPLATE;
$tmp->Load_Extension();
define('ISHOME',true);
// echo md5(sha1("123"));
define('THIS_TEM_ADMIN_PATH',TEM_PATH.'default/');
$tmp->WapperTem();
