<?php
//defined('ISHOME') or die('Can not acess this page, please come back!');
// define path to dirs
define('ROOTHOST','http://'.$_SERVER['HTTP_HOST'].'/khaisang/admincp/');
define('ROOTDOCUMENT',$_SERVER['DOCUMENT_ROOT'].'/khaisang/');
define('ROOTHOST_FRONTEND','http://'.$_SERVER['HTTP_HOST'].'/khaisang/');
define('PATH_FILE','../uploads/file/');/* ding nghia url upload file*/
define('DOMAIN',$_SERVER['HTTP_HOST']);
define('BASEVIRTUAL0',ROOTHOST.'images/');
define('ROOT_PATH','');
define('TEM_PATH',ROOT_PATH.'templates/');
define('COM_PATH',ROOT_PATH.'components/');
define('MOD_PATH',ROOT_PATH.'modules/');
define('LAG_PATH',ROOT_PATH.'languages/');
define('EXT_PATH',ROOT_PATH.'extensions/');
define('EDI_PATH',EXT_PATH.'editor/');
define('IMG_PATH',ROOT_PATH.'images/');
define('LIB_PATH',ROOT_PATH.'libs/');
define('JS_PATH',ROOT_PATH.'js/');
define('LOG_PATH',ROOT_PATH.'logs/');
define('INC_PATH',ROOT_PATH.'includes/');
define('MAX_ROWS','20');
define('MAX_ITEM','20'); // số bản ghi trên 1 trang
define('TIMEOUT_LOGIN','6000');
define('URL_REWRITE','1');
define('MAX_ROWS_INDEX',40);

define('THUMB_WIDTH',285);
define('THUMB_HEIGHT',285);

$LANG_CODE='vi';

define('SMTP_SERVER','smtp.gmail.com');
define('SMTP_PORT','465');
define('SMTP_USER','');
define('SMTP_PASS','');
define('SMTP_MAIL','');


define('SHOP_CODE','TD');
define('SITE_NAME',$_SERVER['HTTP_HOST']);
define('SITE_TITLE','');
define('SITE_DESC','');
define('SITE_KEY','');
define('COM_CONTACT','');
/*huandx*/
define('PATH_GALLERY_REVIEW','uploads/gallery/');/* url hiển thị ảnh gallery*/
define('PATH_GALLERY','../uploads/gallery/');/* dinh nghia url upload*/
define('PATH_VIDEO','../uploads/video/');/* dinh nghia url upload*/
define('PATH_VIDEO_VIEW','uploads/video/');/* dinh nghia url upload*/
define('PATH_THUMB','../uploads/thumb/');/* dinh nghia url upload*/
define('PATH_THUMB_VIEW','uploads/thumb/');/* dinh nghia url upload*/
define('LINK_THUMB','uploads/thumb/');/* dinh nghia url upload*/
define('THUMB_DEFAULT','images/thumb_default.png');/* dinh nghia anh mac dinh khi khong load được anh*/
define('PATH_NEWS','uploads/news/');/* */

$IPS_CLIENT=array('210.211.124.39');

$_mnu=array(
	array('icon'=>'fa fa-cutlery','name'=>'Thư viện ảnh','com'=>'gallery','link'=>'?com=gallery','type'=>'parent'
	),
    array('icon'=>'fa fa-newspaper-o','name'=>'Tin tức','com'=>'contents','link'=>'','type'=>'parent',
        'sub_menu'=>array(
            array('icon'=>'','name'=>'Nhóm tin','com'=>'category','link'=>'?com=category'),
            array('icon'=>'','name'=>'Quản lý tin tức','com'=>'contents','link'=>'?com=contents'),
            )
        ),
    array('icon'=>'fa fa-newspaper-o','name'=>'Cảm nhận','com'=>'feedback','link'=>'?com=feedback','type'=>'parent'),
    array('icon'=>'fa fa-newspaper-o','name'=>'Khách hàng','com'=>'client','link'=>'?com=client','type'=>'parent'),
   /* array('icon'=>'fa fa-newspaper-o','name'=>'Team','com'=>'team','link'=>'?com=team','type'=>'parent'),*/
);
