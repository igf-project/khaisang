<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('COMS', 'product');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'detail', 'add', 'edit','block_group','cart','checkout');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    include_once(LIB_PATH.'cls.product.php');
    $obj=new CLS_PRODUCT();
    include_once('tem/'.$viewtype.'.php');
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>

